<?php

namespace App\Http\Controllers\Admin\Budget;

use App\Models\BudgetHistory;
use App\Http\Controllers\Controller;
use Illuminate\Session\SessionManager;
class BudgetHistoryController extends Controller
{
    protected $session;

    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    public function index()
    {
        $budgets = BudgetHistory::with('user','inventory')
                ->orderBy('created_at', 'DSC')->get();
        return view('admin.budget.index')->with('budgets',$budgets);
    }
}