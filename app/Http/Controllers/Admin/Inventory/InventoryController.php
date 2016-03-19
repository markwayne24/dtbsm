<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Requests\StoreInventoryRequest;
use App\Models\Items;
use Illuminate\Session\SessionManager;
use App\Http\Controllers\Controller;
use App\Models\Inventory;

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
        return view('admin.items.inventory.index', compact('inventories','items'));
    }

    public function store(StoreInventoryRequest $request)
    {
        $input = $request->all();
        $inventories = Inventory::create($input);
        \Session::flash('flash_message','Successfully created Inventory.');

        return response()->json($inventories);
    }

    public function edit($inventory)
    {
        $input = Inventory::findOrFail($inventory);

        return response()->json($input);
    }

    public function update(StoreInventoryRequest $request, $inventory)
    {
        $input = $request->all();
        $inventory = Inventory::where('id',$inventory)->update($input);

        return response()->json($inventory);
    }

    public function destroy($inventory)
    {
        $inventories = Inventory::destroy($inventory);

        return response()->json($inventories);
    }

}