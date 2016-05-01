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
use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use App\Models\Requests;
use App\Models\ItemRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class RequestsController extends Controller
{
    protected $session;
    protected $authId;

    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    public function index()
    {
        $this->authId = Auth::user()->id;
        $id = Auth::user()->id;
        $requests = Requests::where('user_id', $this->authId)
            ->orderBy('created_at', 'ASC')->get();

        return view('users.requests.index')->with('requests',$requests);
    }

    public function add()
    {
        $inventories = Inventory::with('items')->get();

        return view('users.requests.add')->with('inventories',$inventories);
    }


    public function view($id)
    {
        $requests = ItemRequests::with('requests','inventory')
            ->where('request_id',$id)
            ->get();
        $requested = Requests::with('user')
            ->where('id',$id)
            ->first();
        return view('users.requests.view')->with('requests',$requests)
            ->with('requested', $requested);
    }

    public function request()
    {
        $user = Auth()->user()->id;
        $district = Auth::user()->userProfile->district;
        $school = Auth::user()->userProfile->school;

        $data = [
            'user_id'=> $user,
            'district'=> $district,
            'school' => $school
        ];

        $request = Requests::create($data);

        return response()->json($request);
    }

    public function send()
    {
      $input = Input::all();
        $data = [
            'request_id'=> $input['request_id'],
            'inventory_id'=> $input['inventory_id'],
            'quantity'=> $input['quantity'],
            'price'=> $input['price']
        ];

        \Session::flash('flash_message','Successfully created requests');

        $userData = ItemRequests::create($data);

        return response()->json($userData);

    }

    public function pending()
    {
        $user = Auth()->user()->id;
        $requests = Requests::with('user')
            ->where('status','Pending')
            ->where('user_id',$user)
            ->get();
        return view('users.requests.index')->with('requests',$requests);
    }

    public function approved()
    {
        $user = Auth()->user()->id;
        $requests = Requests::with('user')
            ->where('status','Approved')
            ->where('user_id',$user)
            ->get();
        return view('users.requests.index')->with('requests',$requests);
    }
    public function declined()
    {
        $user = Auth()->user()->id;
        $requests = Requests::with('user')
            ->where('status','Declined')
            ->where('user_id', $user)
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