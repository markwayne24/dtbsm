<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Requests\StoreInventoryRequest;
use App\Models\Budget;
use App\Models\BudgetHistory;
use App\Models\Items;
use Carbon\Carbon;
use Illuminate\Session\SessionManager;
use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    private $session;

    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    public function index()
    {
        $inventories = Inventory::with('items')->get();
        $items = Items::with('itemTypes')->get();
        $budgetLeft = Budget::all()->first();
        return view('admin.items.inventory.index', compact('inventories','items','budgetLeft'));
    }

    public function store(StoreInventoryRequest $request)
    {
        $input = $request->all();
        $budget = Budget::all()->first();
        $budgetAmount = $budget->amount;
        $amount = $input['price'] * $input['stocks'];

        $budgetLeft = $budgetAmount - $amount;
        if($budgetLeft >= $amount){
            $budget->amount = $budgetLeft;
            $budget->save();

            $dataInventory = [
                'item_id'=> $input['item_id'],
                'price'=> $input['price'],
                'stocks' =>$input['stocks']
            ];

            $budgetHistories = [
                'user_id' => Auth()->user()->id,
                'item_id'=>$input['item_id'],
                'action'=> $input['action'],
                'amount' => $amount,
                'budget_year'=> $budgetLeft
            ];

            BudgetHistory::create($budgetHistories);
            $inventories = Inventory::create($dataInventory);


            $id = $inventories->id;
            $inventories->sku = Carbon::now()->format('mdY'). '-Item-' . $id ;
            $inventories->save();
            \Session::flash('flash_message','Successfully created Inventory.');

                return response()->json($inventories);
        }else{
            \Session::flash('flash_message2','You dont have sufficient amount of budget');

            return response()->json();
        }
    }

    public function edit($inventory)
    {
        $input = Inventory::findOrFail($inventory);

        return response()->json($input);
    }

    public function update(StoreInventoryRequest $request, $inventory)
    {
        $input = $request->all();

        $inventory = Inventory::where('id',$inventory)->first();
        $beforeAmount = $inventory->price * $inventory->stocks;

        $budget = Budget::all()->first();
        $budgetAmount = $budget->amount;
        $amount = $input['price'] * $input['stocks'];

        $budgetCurrentLeft = $budgetAmount + $beforeAmount;
        $budgetLeft = $budgetCurrentLeft - $amount;

        if($budgetCurrentLeft >= $amount){
            $budget->amount = $budgetLeft;
            $budget->save();

            $budgetHistories = [
                'user_id' => Auth()->user()->id,
                'item_id'=>$input['item_id'],
                'action'=> $input['action'],
                'amount' => $amount,
                'budget_year'=> $budgetLeft
            ];

            BudgetHistory::create($budgetHistories);

            $inventory->update($input);

            return response()->json($inventory);
        }else{
            \Session::flash('flash_message2','You dont have sufficient amount of budget');

            return response()->json();
        }
    }

    public function destroy($inventory)
    {
        $inventories = Inventory::where('id',$inventory)->first();
        $amount = $inventories->price * $inventories->stocks;
        $budget = Budget::all()->first();
        $budgetAmount = $budget->amount;

        $budgetLeft = $budgetAmount + $amount;
        $budget->amount = $budgetLeft;
        $budget->save();

        $budgetHistories = [
            'user_id' => Auth()->user()->id,
            'item_id'=> 1,
            'action'=> 'Delete',
            'amount' => $amount,
            'budget_year'=> $budgetLeft
        ];

        BudgetHistory::create($budgetHistories);
        $inventories = Inventory::where('id',$inventory)->delete();

        return response()->json($budgetHistories);
    }

}