<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Budget;
use App\Models\Inventory;
use App\Models\ItemType;
use App\Models\Items;
use App\Models\Requests;
use App\Models\User;
use Illuminate\Session\SessionManager;

class DashboardController extends Controller
{
    protected $session;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('userGroup')->get();
        $itemTypes = ItemType::all();
        $items = Items::all();
        $inventories = Inventory::all();
        $requests = Requests::all();
        $budgets = Budget::all()->first();

        return view('admin.dashboard.index', compact('users','itemTypes','items','inventories','requests','budgets'),[$budgets]);
    }

}
