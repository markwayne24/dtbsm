<?php

namespace App\Http\Controllers\User\Request;
/**
 * Created by PhpStorm.
 * User: MarkWayne
 * Date: 3/31/2016
 * Time: 7:26 PM
 */
use App\Models\Inventory;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use App\Models\Requests;
use App\Models\ItemRequests;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class RequestsController extends Controller
{
    protected $session;

    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    public function index()
    {
        $id = Auth::user()->id;
        $requests = Requests::where('user_id', $id)->get();

        return view('users.requests.index')->with('requests',$requests);
    }

    public function add()
    {
        $id = Auth::user()->id;
        $inventories = Inventory::with('items')->get();

        return view('users.requests.add')->with('inventories',$inventories);
    }


    public function view($id)
    {
        $requests = ItemRequests::with('requests','inventory')
            ->where('request_id',$id)
            ->get();
        return view('users.requests.view')->with('requests',$requests);
    }

    public function send(Requests $requests)
    {

        $user = Auth()->user()->id;

/*        $requestId = Requests::create([
            'user_id' => $user
        ]);

        $requestIds = $requestId->id;*/

        $userData = json_decode($requests->all(), true);
/*        foreach ($requests as $key => $value)
        {
            $request = $value['quantity'];

        }*/

        return response()->json($userData);

    }

    public function pending($request)
    {
        $requests = Requests::with('user')
            ->where('status','Pending')
            ->get();
        return view('users.requests.index')->with('requests',$requests);
    }

    public function approved()
    {
        $requests = Requests::with('user')
            ->where('status','Approved')
            ->get();
        return view('users.requests.index')->with('requests',$requests);
    }
    public function declined()
    {
        $requests = Requests::with('user')
            ->where('status','Declined')
            ->get();
        return view('users.requests.index')->with('requests',$requests);
    }

    public function update(Request $request, $requests_id)
    {
        $status = $request->only('status');
        $statusUpdate = Requests::where('id',$requests_id)->update($status);

        \Session::flash('flash_message','Successfully Updated Status');


        return response()->json($status);
    }
}