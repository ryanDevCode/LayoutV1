<?php

namespace App\Http\Controllers\Components\PDF;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Department;
use App\Models\PlanCategories;
use App\Models\Types;
use App\Models\Status;
use App\Models\Categories;
use App\Models\User;
use App\Models\Budget;
use App\Models\AddBudgets;
use App\Models\Cashflow;
use App\Models\Balance;
use App\Models\Income;
use App\Models\Payable;
use App\Models\Recievable;
use App\Models\Sales;
use App\Models\Turnover;


class ReportController extends Controller
{
    public function admin()
    {
        return view('components.pdf.admin');
    }

    public function user()
    {
        return view('components.pdf.user');
    }

    public function budgetPrint($id)
    {
        $budgets = Budget::find($id);
        $departments = Department::all();
        $type = Types::all();
        $status = Status::all();
        $categories = Categories::all();
        $users = User::all();

        $data = [
            'budget' => $budgets,
            'departments' => $departments,
            'type' => $type,
            'status' => $status,
            'categories' => $categories,
            'users' => $users
        ];

        return view('components.pdf.print.budgets', $data);

    }

    public function addbudgetPrint($id)
    {
        $request_code = $id;

        $addbudgets = AddBudgets::findOrFail($request_code);

        $foundBudget = Budget::find($addbudgets->request_budget_code);

        $departments = Department::all();
        $type = Types::all();
        $status = Status::all();
        $categories = Categories::all();
        $users = User::all();

        $data = [
            'requestBudget' => $addbudgets,
            'foundBudget' => $foundBudget,
            'departments' => $departments,
            'type' => $type,
            'status' => $status,
            'categories' => $categories,
            'users' => $users
        ];

        return view('components.pdf.print.budgetsRequest', $data);

    }

    public function cashflowPrint($id)
    {
        // $id = 'cf001';
        $cashflow = Cashflow::where('cashflow_info', $id)->get();
        $departments = Department::all();
        $type = Types::all();
        $categories = PlanCategories::all();

        $data = [
            'cashflows' => $cashflow,
            'departments' => $departments,
            'type' => $type,
            'categories' => $categories
        ];

        return view('components.pdf.print.cashflow', $data);

    }

    public function balancePrint($id)
    {
        $balance = Balance::where('balance_info', $id)->get();
        $departments = Department::all();
        $type = Types::all();
        $categories = PlanCategories::all();

        $data = [
            'balances' => $balance,
            'departments' => $departments,
            'type' => $type,
            'categories' => $categories
        ];

        return view('components.pdf.print.balance', $data);
    }

    public function incomePrint($id)
    {
        $income = Income::where('income_info', $id)->get();
        $departments = Department::all();
        $type = Types::all();
        $categories = PlanCategories::all();

        $data = [
            'incomes' => $income,
            'departments' => $departments,
            'type' => $type,
            'categories' => $categories
        ];

        return view('components.pdf.print.income', $data);
    }

    public function payablePrint($id)
    {
        $payable = Payable::where('payable_info', $id)->get();
        $departments = Department::all();
        $type = Types::all();
        $categories = PlanCategories::all();

        $data = [
            'payables' => $payable,
            'departments' => $departments,
            'type' => $type,
            'categories' => $categories
        ];

        return view('components.pdf.print.payable', $data);
    }

    public function recievablePrint($id)
    {
        $recievable = Recievable::where('recievable_info', $id)->get();
        $departments = Department::all();
        $type = Types::all();
        $categories = PlanCategories::all();

        $data = [
            'recievables' => $recievable,
            'departments' => $departments,
            'type' => $type,
            'categories' => $categories
        ];

        return view('components.pdf.print.recievable', $data);
    }

    public function salesPrint($id)
    {
        $sales = Sales::where('sales_info', $id)->get();
        $departments = Department::all();
        $type = Types::all();
        $categories = PlanCategories::all();

        $data = [
            'sales' => $sales,
            'departments' => $departments,
            'type' => $type,
            'categories' => $categories
        ];

        return view('components.pdf.print.sales', $data);
    }

    public function turnoverPrint($id)
    {
        $turnover = Turnover::where('turnover_info', $id)->get();
        $departments = Department::all();
        $type = Types::all();
        $categories = PlanCategories::all();

        $data = [
            'turnovers' => $turnover,
            'departments' => $departments,
            'type' => $type,
            'categories' => $categories
        ];

        return view('components.pdf.print.turnover', $data);
    }
}
