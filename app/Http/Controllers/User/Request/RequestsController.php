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
use Carbon\Carbon;


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
        $requests = Requests::where('user_id', $this->authId)->get();

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
        return view('users.requests.view')->with('requests',$requests);
    }

    public function send(Request $requests)
    {

        // From a datetime string
        $datetime = Carbon::createFromFormat('Y-m-d H:i:s', '2016-01-23 11:53:20');

// From a date string
        $date = Carbon::createFromFormat('Y-m-d', '2016-01-23 PHT');

// From a time string
        $time = Carbon::createFromFormat('H:i:s', '07:00:00');

      /*  Carbon::create($year, $month, $day, $hour, $minute, $second, $tz);*/
/*
        $user = Auth()->user()->id;
        $userData = Request::all();*/



/*        $requestId = Requests::create([
            'user_id' => $user
        ]);

        $requestIds = $requestId->id;*/


        return response()->json($date);

    }

    public function pending()
    {
        $requests = Requests::with('user')
            ->where('status','Pending')
            ->where('user_id',$this->authId)
            ->get();
        return view('users.requests.index')->with('requests',$requests);
    }

    public function approved()
    {
        $requests = Requests::with('user')
            ->where('status','Approved')
            ->where('user_id',$this->authId)
            ->get();
        return view('users.requests.index')->with('requests',$requests);
    }
    public function declined()
    {
        $requests = Requests::with('user')
            ->where('status','Declined')
            ->where('user_id', $this->authId)
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