<?php

namespace App\Http\Controllers\Admin\ItemType;

use App\Models\ItemType;
use Illuminate\Http\Request;

use App\Http\Requests\StoreItemsRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\MessageBag;
use Illuminate\Session\SessionManager;

class ItemTypesController extends Controller
{
    protected $session;

    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    public function index(){
        $types = ItemType::all();
        return view('admin.items.itemTypes.index')->with('types', $types);
    }

    public function store(StoreItemsRequest $request){
        $input = $request->all();
        $item_type = ItemType::create($input);

        return response()->json($item_type);

        \Session::flash('flash_message','Successfully Saved.');
        return redirect()->back()->with('message',flash_message);
    }

    public function edit($item_types)
    {
        $items = ItemType::findOrFail($item_types);

        return response()->json($items);
    }

    public function update(StoreItemsRequest $request, $item_types)
    {
        $input = $request->all();
        $item_type = ItemType::where('id', $item_types)->update($input);

        return response()->json($item_type);
    }

    public function destroy($item_types)
    {
        $item_type = ItemType::destroy($item_types);
        return response()->json($item_type);
    }
}
