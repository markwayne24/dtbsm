<?php

namespace App\Http\Controllers\Admin\ItemType;

use App\Models\ItemType;
use Illuminate\Http\Request;

use App\Http\Requests\StoreItemTypesRequest;
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

    public function store(StoreItemTypesRequest $request){
        $input = $request->all();
        $data = [
            'categories'=>$input['categories'],
            'name'=>$input['name']
        ];
        $item_type = ItemType::create($data);
        \Session::flash('flash_message','Successfully saved.');

        return response()->json($data);
    }

    public function edit($item_types)
    {
        $items = ItemType::findOrFail($item_types);

        return response()->json($items);
    }

    public function update(StoreItemTypesRequest $request, $item_types)
    {
        $input = $request->all();
        $item_type = ItemType::where('id', $item_types)->update($input);
        \Session::flash('flash_message','Successfully updated.');

        return response()->json($item_type);
    }

    public function destroy($item_types)
    {
        $item_type = ItemType::destroy($item_types);

        return response()->json($item_type);
    }
}
