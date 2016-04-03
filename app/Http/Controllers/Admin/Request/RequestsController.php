<?php

namespace App\Http\Controllers\Admin\Request;
use App\Models\ItemRequests;
use App\Models\Requests;
use Illuminate\Routing\Controller;
use Illuminate\Session\SessionManager;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: MarkWayne
 * Date: 3/25/2016
 * Time: 7:59 PM
 */
class RequestsController extends Controller
{
    protected $session;

    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    public function index()
    {
        $requests = Requests::with('user')
            ->whereNotNull('status')
            ->get();
        return view('admin.requests.all.index')->with('requests',$requests);
    }

    public function view($id)
    {
        $requests = ItemRequests::with('requests','inventory')
                    ->where('request_id',$id)
                    ->get();
        return view('admin.requests.all.view')->with('requests',$requests);
    }

    public function pending()
    {
        $requests = Requests::with('user')
                    ->where('status','Pending')
                    ->get();
        return view('admin.requests.all.index')->with('requests',$requests);
    }

    public function approved()
    {
        $requests = Requests::with('user')
            ->where('status','Approved')
            ->get();
        return view('admin.requests.all.index')->with('requests',$requests);
    }
    public function declined()
    {
        $requests = Requests::with('user')
            ->where('status','Declined')
            ->get();
        return view('admin.requests.all.index')->with('requests',$requests);
    }

    public function update(Request $request, $requests_id)
    {
        $status = $request->only('status');
        $statusUpdate = Requests::where('id',$requests_id)->update($status);

        \Session::flash('flash_message','Successfully Updated Status');


        return response()->json($status);
    }
}