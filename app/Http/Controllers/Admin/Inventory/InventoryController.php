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
        $id = $request->only('item_id');

        $id = Items::where('name',$id)->first();
        $type = $id->id;
        $items = Inventory::create($request->all());
        $items->item_id = $type;
        $items->save();

        \Session::flash('flash_message','Successfully created Inventory.');
        return redirect()->back()->with('message',flash_message);
    }

    public function edit()
    {

    }

    public function destroy()
    {

    }

}