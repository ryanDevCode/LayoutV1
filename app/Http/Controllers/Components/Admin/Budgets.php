<?php

namespace App\Http\Controllers\Components\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Department;
use App\Models\Categories;
use App\Models\Status;
use App\Models\Budget;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class Budgets extends Controller
{
    public function index($department_code = null)
    {
        $budgets = Budget::all();
        $groupedBudgets = $budgets->groupBy('budget_department');

        $departments = Department::all();
        $status = Status::all();
        $categories = Categories::all();
        $users = User::all();

        return view('dashboard.admin.budget.index   ', compact('department_code', 'budgets', 'status', 'categories', 'users', 'groupedBudgets', 'departments'));
    }

    public function create($department_code = null)
    {
        $departments = Department::all();
        $status = Status::all();
        $categories = Categories::all();
        $users = User::all();

        return view('dashboard.admin.budget.create', compact('department_code', 'departments', 'status', 'categories', 'users'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'budget_name' => 'required|string|max:255|unique:budgets,budget_name',
            'budget_department' => 'required|string|max:255',
            'budget_amount' => 'required|string|max:255',
            'budget_category' => 'required|string|max:255',
            'budget_startDate' => 'required',
            'budget_endDate' => 'required',
            'budget_description' => 'required|string|max:255',

            'budget_status' => 'required|string|max:255',
            'budget_approvedBy' => 'required|string|max:255',
            'budget_approvedDate' => 'required',
            'budget_approvedAmount' => 'required|string|max:255',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $budgets = Budget::create([
            'budget_name' => $request->input('budget_name'),
            'budget_department' => $request->input('budget_department'),
            'budget_amount' => $request->input('budget_amount'),
            'budget_category' => $request->input('budget_category'),
            'budget_startDate' => date('Y-m-d', strtotime($request->input('budget_startDate'))),
            'budget_endDate' => date('Y-m-d', strtotime($request->input('budget_endDate'))),
            'budget_description' => $request->input('budget_description'),

            'budget_status' => $request->input('budget_status'),
            'budget_approvedBy' => $request->input('budget_approvedBy'),
            'budget_approvedDate' => date('Y-m-d', strtotime($request->input('budget_approvedDate'))),
            'budget_approvedAmount' => $request->input('budget_approvedAmount'),
            'budget_notes' => $request->input('budget_notes'),
            'budget_type' => 'T1',
        ]);

        $dprtmnt = $request->input('budget_department');

        if ($budgets) {
            return redirect()->route('admin.budgets.show', $budgets['budget_department'])->with('success', 'Budget added successfully');
        }
    }

    public function show($department_code = null)
    {

        $users = User::all();
        $status = Status::all();
        $categories = Categories::all();
        $budgets = Budget::where('budget_department', $department_code)->get();

        return view('dashboard.admin.budget.show', compact('department_code', 'budgets', 'users', 'status', 'categories'));
    }

    public function edit(string $id)
    {
        $budgets = Budget::findOrFail($id);
        $departments = Department::all();
        $categories = Categories::all();
        $status = Status::all();
        $users = User::all();

        return view('dashboard.admin.budget.edit', compact('budgets', 'departments', 'categories', 'status', 'users'));
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'budget_name' => 'required|string|max:255|unique:budgets,budget_name,' . $id,
            'budget_department' => 'required|string|max:255',
            'budget_amount' => 'required|string|max:255',
            'budget_category' => 'required|string|max:255',
            'budget_startDate' => 'required',
            'budget_endDate' => 'required',
            'budget_description' => 'required|string|max:255',

            'budget_status' => 'required|string|max:255',
            'budget_approvedBy' => 'required|string|max:255',
            'budget_approvedDate' => 'required',
            'budget_approvedAmount' => 'required|string|max:255',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $budget = Budget::find($id);

        if ($budget) {
            $budget->update([
                'budget_name' => $request->input('budget_name'),
                'budget_department' => $request->input('budget_department'),
                'budget_amount' => $request->input('budget_amount'),
                'budget_category' => $request->input('budget_category'),
                'budget_startDate' => date('Y-m-d', strtotime($request->input('budget_startDate'))),
                'budget_endDate' => date('Y-m-d', strtotime($request->input('budget_endDate'))),
                'budget_description' => $request->input('budget_description'),

                'budget_status' => $request->input('budget_status'),
                'budget_approvedBy' => $request->input('budget_approvedBy'),
                'budget_approvedDate' => date('Y-m-d', strtotime($request->input('budget_approvedDate'))),
                'budget_approvedAmount' => $request->input('budget_approvedAmount'),
                'budget_notes' => $request->input('budget_notes'),
                'budget_type' => 'T1',
            ]);
        }

        return redirect()->route('admin.budgets.show', $budget->budget_department)->with('success', 'Budget updated successfully');
    }

    public function destroy($id)
    {
        $budget = Budget::findOrFail($id);

        // Check if the relationship is loaded and not null
        if ($budget->addBudgets && $budget->addBudgets->isNotEmpty()) {
            // Delete associated records in add_budgets_request
            $budget->addBudgets->each(function ($request) {
                $request->delete();
            });
        }

        // Then delete the budget
        $budget->delete();

        return redirect()->route('admin.budgets.show', $budget->budget_department)->with('success', 'Budget deleted successfully');
    }


    public function search(Request $request, $department_code = null)
    {
        $data = $request->input('search');
        $users = User::all();
        $status = Status::all();
        $categories = Categories::all();

        if (is_null($department_code)) {
            $budgets = Budget::where('id', 'like', '%' . $data . '%')->get();
        } else {

            $budgets = Budget::where('budget_department', $department_code)
                ->where(function ($query) use ($data) {
                    $query->orWhere('budget_name', 'like', '%' . $data . '%')
                        ->orWhere('budget_amount', 'like', '%' . $data . '%')
                        ->orWhere('budget_description', 'like', '%' . $data . '%')
                        ->orWhere('budget_category', 'like', '%' . $data . '%')
                        ->orWhere('budget_startDate', 'like', '%' . $data . '%')
                        ->orWhere('budget_endDate', 'like', '%' . $data . '%')
                        ->orWhere('budget_status', 'like', '%' . $data . '%')
                        ->orWhere('budget_approvedBy', 'like', '%' . $data . '%')
                        ->orWhere('budget_approvedDate', 'like', '%' . $data . '%')
                        ->orWhere('budget_approvedAmount', 'like', '%' . $data . '%')
                        ->orWhere('budget_notes', 'like', '%' . $data . '%');
                })->get();
        }

        if ($budgets->isEmpty() && !is_null($department_code)) {

            return view('dashboard.admin.budget.show', compact('department_code'))->with('error', 'No matching records found.');
        }

        return view('dashboard.admin.budget.show', compact('budgets', 'department_code', 'users', 'status', 'categories'));
    }

}
