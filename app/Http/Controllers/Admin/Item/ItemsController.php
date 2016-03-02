<?php

namespace App\Http\Controllers\Admin\Item;

use App\Http\Requests\Request;
use App\Http\Requests\StoreItemsRequest;
use App\Models\Items;
use App\Models\ItemType;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\MessageBag;
use illuminate\Session\SessionManager;
use Illuminate\Validation\Validator;

class ItemsController extends Controller
{
    protected $session;

    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    public function index()
    {
        $itemTypes = ItemType::orderBy('name', 'ASC')->get();
        $items = Items::with('itemTypes')->get();
        return view('admin.items.items.index')->with('items',$items)->with('itemTypes',$itemTypes);
    }

    public function store(StoreItemsRequest $request)
    {
        $id = $request->only('item_type_id');

        $id = ItemType::where('name',$id)->first();
        $type = $id->id;
        $items = Items::create($request->all());
        $items->item_type_id = $type;
        $items->save();

        \Session::flash('flash_message','Successfully created Items.');
        return redirect()->back()->with('message',flash_message);
    }
}