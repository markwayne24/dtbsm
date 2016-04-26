<?php

namespace App\Http\Controllers\Admin\Item;

use App\Http\Requests\Request;
use App\Http\Requests\StoreItemsRequest;
use App\Models\Items;
use App\Models\ItemType;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use illuminate\Session\SessionManager;

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

        return view('admin.items.items.index')->with('items', $items)->with('itemTypes', $itemTypes);
    }

    public function getCategories($categories)
    {
        $categories = ItemType::where('categories',$categories)->get();
        return response()->json($categories);
    }

    public function store(StoreItemsRequest $request)
    {
        $input = $request->all();
        $items = Items::create($input);
        \Session::flash('flash_message','Successfully saved.');

        return response()->json($items);
    }

    public function edit($itemId)
    {
        $items = Items::findOrFail($itemId);

        return response()->json($items);
    }


    public function update(StoreItemsRequest $request, $items)
    {
        $input = $request->all();
        $items = Items::where('id', $items)->update($input);
        \Session::flash('flash_message','Successfully updated.');

        return response()->json($items);
    }

    public function destroy($items)
    {
        $item = Items::destroy($items);

        return response()->json($item);
      /*  return response(['msg' => 'Product deleted', 'status' => 'success']);
        \Session::flash('flash_message', 'Successfully deleted Items.');

        return redirect()->back()->with('message', flash_message);*/
    }
}