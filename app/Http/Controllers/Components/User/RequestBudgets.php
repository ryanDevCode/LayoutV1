<?php

namespace App\Http\Controllers\Components\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


use App\Models\AddBudgets;
use App\Models\Department;
use App\Models\Categories;
use App\Models\Status;
use App\Models\Budget;
use App\Models\User;


class RequestBudgets extends Controller
{

    public function index()
    {
        $budgets = AddBudgets::all();
        $groupedBudgets = $budgets->groupBy('request_department');

        $departments = Department::all();

        return view('dashboard.user.request.index', compact('groupedBudgets', 'departments'));
    }

    public function create($department_code = null)
    {
        $departments = Department::all();
        $categories = Categories::all();
        $users = User::all();
        $budgets = Budget::all();
        $status = Status::all();

        return view('dashboard.user.request.create', compact('department_code', 'departments', 'status', 'categories', 'users', 'budgets'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'request_name' => 'required|string|max:255|unique:add_budgets_request,request_name',
            'request_department' => 'required|string|max:255',
            'request_amount' => 'required|string|max:255',
            'request_category' => 'required|string|max:255',
            'request_description' => 'required|string|max:255',
            'request_budget_code' => 'required|string|max:255',
            'request_actualSpending' => 'required|string|max:255',
            'request_variance' => 'required|string|max:255',
            'request_varianceReason' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $budget = AddBudgets::create([
            'request_name' => $request->input('request_name'),
            'request_department' => $request->input('request_department'),
            'request_amount' => $request->input('request_amount'),
            'request_category' => $request->input('request_category'),
            'request_description' => $request->input('request_description'),
            'request_budget_code' => $request->input('request_budget_code'),
            'request_actualSpending' => $request->input('request_actualSpending'),
            'request_variance' => $request->input('request_variance'),
            'request_varianceReason' => $request->input('request_varianceReason'),
            'request_status' => 'S2',
            'request_type' => 'T2',
        ]);

        return redirect()->route('user.budgets.requests.show', $budget['request_department'])->with('success', 'Budget added successfully');
    }

    public function show($department_code = null)
    {

        $users = User::all();
        $status = Status::all();
        $categories = Categories::all();
        $budgets = Budget::all();

        $requests = AddBudgets::where('request_department', $department_code)->get();

        return view('dashboard.user.request.show', compact('department_code', 'budgets', 'users', 'status', 'categories', 'requests'));
    }

    public function edit(string $id)
    {
        $requests = AddBudgets::findOrFail($id);
        $departments = Department::all();
        $categories = Categories::all();
        $status = Status::all();
        $users = User::all();
        $budgets = Budget::all();

        return view('dashboard.user.request.edit', compact('budgets', 'departments', 'categories', 'status', 'requests', 'users', ));
    }

    public function update(Request $request, string $request_code)
    {
        $validator = Validator::make($request->all(), [
            'request_name' => 'required|string|max:255|unique:add_budgets_request,request_name,' . $request_code . ',request_code',
            'request_department' => 'required|string|max:255',
            'request_amount' => 'required|string|max:255',
            'request_category' => 'required|string|max:255',
            'request_budget_code' => 'required|string|max:255',
            'request_description' => 'required|string|max:255',
            'request_actualSpending' => 'required|string|max:255',
            'request_variance' => 'required|string|max:255',
            'request_varianceReason' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $requests = AddBudgets::find($request_code);

        if ($requests) {
            $requests->update([
                'request_name' => $request->input('request_name'),
                'request_department' => $request->input('request_department'),
                'request_amount' => $request->input('request_amount'),
                'request_category' => $request->input('request_category'),
                'request_budget_code' => $request->input('request_budget_code'),
                'request_description' => $request->input('request_description'),
                'request_actualSpending' => $request->input('request_actualSpending'),
                'request_variance' => $request->input('request_variance'),
                'request_varianceReason' => $request->input('request_varianceReason'),
                'request_type' => 'T2',

            ]);
        }

        return redirect()->route('user.budgets.requests.show', $requests->request_department)->with('success', 'Budget updated successfully');
    }

    public function destroy(string $request_code)
    {
        $requests = AddBudgets::findOrFail($request_code);
        $requests->delete();

        return redirect()->route('user.budgets.requests.show', $requests->request_department)->with('success', 'Budget deleted successfully');
    }

    public function search(Request $request, $department_code = null)
    {
        $data = $request->input('search');
        $users = User::all();
        $status = Status::all();
        $categories = Categories::all();
        $budgets = Budget::all();

        if (is_null($department_code)) {
            $requests = AddBudgets::where('request_code', 'like', '%' . $data . '%')->get();
        } else {

            $requests = AddBudgets::where('request_department', $department_code)
                ->where(function ($query) use ($data) {
                    $query->orWhere('request_name', 'like', '%' . $data . '%')
                        ->orWhere('request_amount', 'like', '%' . $data . '%')
                        ->orWhere('request_description', 'like', '%' . $data . '%')
                        ->orWhere('request_category', 'like', '%' . $data . '%')
                        ->orWhere('request_budget_code', 'like', '%' . $data . '%')
                        ->orWhere('request_status', 'like', '%' . $data . '%')
                        ->orWhere('request_approvedBy', 'like', '%' . $data . '%')
                        ->orWhere('request_approvedDate', 'like', '%' . $data . '%')
                        ->orWhere('request_approvedAmount', 'like', '%' . $data . '%')
                        ->orWhere('request_notes', 'like', '%' . $data . '%');
                })->get();
        }

        if ($requests->isEmpty() && !is_null($department_code)) {

            return view('dashboard.user.request.show', compact('department_code'))->with('error', 'No matching records found.');
        }

        return view('dashboard.user.request.show', compact('requests', 'budgets', 'department_code', 'users', 'status', 'categories'));
    }
}
