<?php

namespace App\Http\Controllers\Admin\Request;
use App\Models\ItemRequests;
use App\Models\Requests;
use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Session\SessionManager;
use Illuminate\Http\Request;
use App\Models\User;

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

    public function index($district_id)
    {
        $requests = Requests::with('user')
            ->where('district',$district_id)
            ->get();

        return view('admin.requests.all.index')
            ->with('requests',$requests);
    }

    public function view($id)
    {
        $requests = ItemRequests::with('requests','inventory')
                    ->where('request_id',$id)
                    ->get();
        $requested = Requests::with('user')
                    ->where('id',$id)
                    ->first();
        return view('admin.requests.all.view')->with('requests',$requests)
            ->with('requested', $requested);
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
        $input = $request->all();
        $dataStatus = [
            'status' => $input['status'],
            'reason' => $input['reason'],
            'approved_at' => Carbon::now()
        ];

        $statusUpdate = Requests::where('id',$requests_id)->update($dataStatus);

        \Session::flash('flash_message','Successfully Updated Status');


        return response()->json($statusUpdate);
    }
}