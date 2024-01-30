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


class PreviewController extends Controller
{
    public function budgets()
    {
        $budgets = Budget::all();
        $departments = Department::all();
        $type = Types::all();
        $status = Status::all();
        $categories = Categories::all();
        $users = User::all();

        $data = [
            'budgets' => $budgets,
            'departments' => $departments,
            'type' => $type,
            'status' => $status,
            'categories' => $categories,
            'users' => $users
        ];

        return view('components.pdf.table.budget', $data);
    }

    public function addbudgets()
    {
        $budgets = Budget::all();
        $addbudgets = AddBudgets::all();
        $departments = Department::all();
        $type = Types::all();
        $status = Status::all();
        $categories = Categories::all();
        $users = User::all();

        $data = [
            'requests' => $addbudgets,
            'budgets' => $budgets,
            'departments' => $departments,
            'type' => $type,
            'status' => $status,
            'categories' => $categories,
            'users' => $users
        ];

        return view('components.pdf.table.addbudget', $data);
    }

    public function cashflow()
    {
        $cashflow = Cashflow::all();
        $type = Types::all();
        $departments = Department::all();
        $categories = PlanCategories::all();

        $data = [
            'cashflows' => $cashflow,
            'type' => $type,
            'departments' => $departments,
            'categories' => $categories
        ];

        return view('components.pdf.table.cashflow', $data);
    }

    public function balance()
    {
        $balance = Balance::all();
        $type = Types::all();
        $departments = Department::all();
        $categories = PlanCategories::all();

        $data =
        [
            'balances' => $balance,
            'type' => $type,
            'departments' => $departments,
            'categories' => $categories
        ];

        return view('components.pdf.table.balance', $data);
    }

    public function income()
    {
        $income = Income::all();
        $type = Types::all();
        $departments = Department::all();
        $categories = PlanCategories::all();

        $data = [
            'incomes' => $income,
            'type' => $type,
            'departments' => $departments,
            'categories' => $categories
        ];

        return view('components.pdf.table.income', $data);
    }

    public function payable()
    {
        $payable = Payable::all();
        $type = Types::all();
        $departments = Department::all();
        $categories = PlanCategories::all();

        $data = [
            'payables' => $payable,
            'type' => $type,
            'departments' => $departments,
            'categories' => $categories
        ];

        return view('components.pdf.table.payable', $data);
    }

    public function receivable()
    {
        $receivable = Recievable::all();
        $type = Types::all();
        $departments = Department::all();
        $categories = PlanCategories::all();

        $data = [
            'receivables' => $receivable,
            'type' => $type,
            'departments' => $departments,
            'categories' => $categories
        ];

        return view('components.pdf.table.recievable', $data);
    }

    public function sales()
    {
        $sales = Sales::all();
        $type = Types::all();
        $departments = Department::all();
        $categories = PlanCategories::all();

        $data = [
            'sales' => $sales,
            'type' => $type,
            'departments' => $departments,
            'categories' => $categories
        ];

        return view('components.pdf.table.sales', $data);
    }

    public function turnover()
    {
        $turnover = Turnover::all();
        $type = Types::all();
        $departments = Department::all();
        $categories = PlanCategories::all();

        $data = [
            'turnovers' => $turnover,
            'type' => $type,
            'departments' => $departments,
            'categories' => $categories
        ];

        return view('components.pdf.table.turnover', $data);
    }


}
