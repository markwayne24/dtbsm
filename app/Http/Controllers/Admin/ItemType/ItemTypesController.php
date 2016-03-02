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
        $items = $request->all();
        ItemType::create($items);
        \Session::flash('flash_message','Successfully Saved.');
        return redirect()->back()->with('message',flash_message);
    }
}
