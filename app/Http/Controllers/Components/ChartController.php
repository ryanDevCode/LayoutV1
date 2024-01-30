<?php

namespace App\Http\Controllers\Components;

use App\Http\Controllers\Controller;
use App\Models\AddBudgets;
use App\Models\Balance;
use App\Models\Budget;
use App\Models\Cashflow;
use App\Models\Income;
use App\Models\Payable;
use App\Models\Recievable;
use App\Models\Sales;
use App\Models\Turnover;
use Illuminate\Http\Request;



class ChartController extends Controller
{

    public function userchart()
    {
        $budgets = Budget::all();
        $addbudgets = AddBudgets::all();
        $cashflow = Cashflow::all();
        $balance = Balance::all();
        $income = Income::all();
        $payable = Payable::all();
        $recievable = Recievable::all();
        $sales = Sales::all();
        $turnover = Turnover::all();

        $data = [
            'budgetData' => $budgets,
            'addBudgetData' => $addbudgets,
            'cashflowData' => $cashflow,
            'balanceData' => $balance,
            'incomeData' => $income,
            'payableData' => $payable,
            'recievableData' => $recievable,
            'salesData' => $sales,
            'turnoverData' => $turnover
        ];

        return view('components.charts.user', $data);
    }

    public function adminchart()
    {
        $budgets = Budget::all();
        $addbudgets = AddBudgets::all();
        $cashflow = Cashflow::all();
        $balance = Balance::all();
        $income = Income::all();
        $payable = Payable::all();
        $recievable = Recievable::all();
        $sales = Sales::all();
        $turnover = Turnover::all();

        $data = [
            'budgetData' => $budgets,
            'addBudgetData' => $addbudgets,
            'cashflowData' => $cashflow,
            'balanceData' => $balance,
            'incomeData' => $income,
            'payableData' => $payable,
            'recievableData' => $recievable,
            'salesData' => $sales,
            'turnoverData' => $turnover
        ];

        return view('components.charts.admin', $data);
    }
}
