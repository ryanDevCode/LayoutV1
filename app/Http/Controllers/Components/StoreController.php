<?php

namespace App\Http\Controllers\Components;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    public function RoleForm()
    {
        $roles = Roles::all();
        return view('components.role', compact('roles'));
    }

    public function register_role(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_name' => 'required|string|max:255|unique:roles,role_name',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $role = Roles::create([
            'role_code' => $request->role_code,
            'role_name' => $request->role_name,
        ]);

        return redirect()->back()->with('success', 'Role added successfully');

    }

    public function DepartmentForm()
    {
        $departments = Department::all();
        return view('components.department', compact('departments'));
    }

    public function register_department(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'department_name' => 'required|string|max:255|unique:departments,department_name',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $department = Department::create([
            'department_code' => $request->department_code,
            'department_name' => $request->department_name,
        ]);

        return redirect()->back()->with('success', 'Department added successfully');
    }

    public function userDashboard()
    {
        return view('dashboard.user.dashboard');
    }

    public function adminDashboard()
    {
        return view('dashboard.admin.dashboard');
    }

}
