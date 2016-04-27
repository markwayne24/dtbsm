<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Requests\StoreInventoryRequest;
use App\Models\Budget;
use App\Models\BudgetHistory;
use App\Models\Items;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;
use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Support\Facades\Validator;
use App\Models\ItemType;
use App\Http\Requests\InventoryReasonRequest;
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
        $inventories = Inventory::with('items')
            ->orderBy('created_at','ASC')
            ->get();
        $items = Items::with('itemTypes')->get();
        $budgetLeft = Budget::all()->first();
        return view('admin.items.inventory.index', compact('inventories','items','budgetLeft'));
    }

    public function getCategories($categories)
    {
        $categories = ItemType::with('items')
            ->where('categories',$categories)
            ->get();
        return response()->json($categories);
    }

    public function getItemNames($names)
    {
        $name = Items::where('item_type_id',$names)->get();
        return response()->json($name);
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
                'item_id'=>$input['item_id'],
                'price'=> $input['price'],
                'stocks' =>$input['stocks']
            ];

            $inventories = Inventory::create($dataInventory);
            $id = $inventories->id;
            $inventories->sku = Carbon::now()->format('mdY'). '-Item-' . $id ;
            $inventories->save();

            $budgetHistories = [
                'user_id' => Auth()->user()->id,
                'inventory_id'=> $input['item_id'],
                'action'=> $input['action'],
                'amount' => $amount,
                'budget_year'=> $budgetLeft
            ];

            BudgetHistory::create($budgetHistories);

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
                'inventory_id'=> $inventory->item_id,
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

    public function destroy(Request $request, $inventory_id)
    {
        $reason = $request->all();
        $inventories = Inventory::where('id',$inventory_id)->first();
        $saveReason = $this->delReason($reason,$inventories->item_id);

        $amount = $inventories->price * $inventories->stocks;
        $budget = Budget::all()->first();
        $budgetAmount = $budget->amount;

        $budgetLeft = $budgetAmount + $amount;
        $budget->amount = $budgetLeft;
        $budget->save();

        $budgetHistories = [
            'action'=> 'Delete',
            'amount' => $amount,
            'budget_year'=> $budgetLeft
        ];

        BudgetHistory::findOrFail($saveReason->id)->update($budgetHistories);
        Inventory::where('id',$inventory_id)->delete();
        \Session::flash('flash_message2','Successfully deleted');

        return response()->json($budgetLeft);
    }

    private function delReason($reason,$item_id)
    {
        $data = [
            'user_id'=>Auth()->user()->id,
            'inventory_id'=> $item_id,
            'reason'=>$reason['reason']
        ];

        $saveReason = BudgetHistory::create($data);

        return $saveReason;
    }

}