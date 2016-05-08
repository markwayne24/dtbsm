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

        $total_price = 0;

        foreach ($requests as $request) {
            $requestId = $request['id'];

            $totals = ItemRequests::where('request_id',$requestId)
                ->where('status','Approved')
                ->get();

            foreach($totals as $total){
                $total_price += $total['quantity'] * $total['price'] ;
            }
        }


        return view('admin.requests.all.index')
            ->with('requests',$requests)
            ->with('district_id',$district_id)
            ->with('total_price',$total_price);
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
        ];

        $approveStatus =[
            'approved_at' => Carbon::now()
        ];

        $statusUpdate = ItemRequests::where('id',$requests_id)->update($dataStatus);
        Requests::where('id',$input['id'])->update($approveStatus);

        \Session::flash('flash_message','Successfully Updated Status');


        return response()->json($statusUpdate);
    }
}