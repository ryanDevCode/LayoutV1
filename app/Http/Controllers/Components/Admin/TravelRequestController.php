<?php

namespace App\Http\Controllers\Components\Admin;

use App\Http\Controllers\Controller;
use App\Models\TravelRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TravelRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $travel = TravelRequest::with('user')->get();

        return view('dashboard.admin.travel.index', compact('travel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Retrieve the travel request with user relationship
        $view = TravelRequest::with('user')->where('travel_request_id', $id)->first();

        // Check if the request was found
        if (!$view) {
            return abort(404); // Handle the case where the request doesn't exist
        }

        // The user data is already loaded through eager loading
        $user = $view->user;
        return view('dashboard.admin.travel.view-request', compact('view', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'project_title' => 'required', 'string', 'max:255',
            'destination' => 'required', 'string', 'max:50',
            'estimated_amount' => 'required', 'numeric', 'min:0',
            'notes' => 'required', 'string', 'max:255',
            'status' => 'string',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $travelRequest = TravelRequest::where('tr_track_no', $id);
        try {
            if ($travelRequest) {
                $travelRequest->update([
                    'project_title' => $request->input('project_title'),
                    'destination' => $request->input('destination'),
                    'estimated_amount' => $request->input('estimated_amount'),
                    'notes' => $request->input('notes'),
                    'status' => $request->input('status'),
                    'approver' => Auth::user()->first_name,
                ]);
            }
        } catch (Exception $e) {
            dd($e);
            Log::error('An error occurred: ' . $e->getMessage());
            Log::error($request->all());
            return back()->withErrors(['error' => 'Something went wrong.']);
        }

        return redirect()->route('travel.index')->with('success', 'Budget Request Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    // public function search($request){
    //     $data = $request->input('search');
    //     $users = User::all();
    //     $travel = TravelRequest::all();

    //     $travelRequest = TravelRequest::where(function($query)use($data){

    //     })
    //     if (is_null($department_code)) {
    //         $budgets = Budget::where('id', 'like', '%' . $data . '%')->get();
    //     } else {

    //         $travelRequest = TravelRequest::where('budget_department', $department_code)
    //             ->where(function ($query) use ($data) {
    //                 $query->orWhere('budget_name', 'like', '%' . $data . '%')
    //                     ->orWhere('budget_amount', 'like', '%' . $data . '%')
    //                     ->orWhere('budget_description', 'like', '%' . $data . '%')
    //                     ->orWhere('budget_category', 'like', '%' . $data . '%')
    //                     ->orWhere('budget_startDate', 'like', '%' . $data . '%')
    //                     ->orWhere('budget_endDate', 'like', '%' . $data . '%')
    //                     ->orWhere('budget_status', 'like', '%' . $data . '%')
    //                     ->orWhere('budget_approvedBy', 'like', '%' . $data . '%')
    //                     ->orWhere('budget_approvedDate', 'like', '%' . $data . '%')
    //                     ->orWhere('budget_approvedAmount', 'like', '%' . $data . '%')
    //                     ->orWhere('budget_notes', 'like', '%' . $data . '%');
    //             })->get();
    //     }

    //     if ($budgets->isEmpty() && !is_null($department_code)) {

    //         return view('dashboard.admin.budget.show', compact('department_code'))->with('error', 'No matching records found.');
    //     }

    //     return view('dashboard.admin.budget.show', compact('budgets', 'department_code', 'users', 'status', 'categories'));
    // }


    public function search(Request $request)
    {
        $query = TravelRequest::query(); // Start with base query

        // Search for the query string in multiple columns
        if ($request->has('search')) {
            $query->where(function ($query) use ($request) {
                $query->where('destination', 'like', '%' . $request->search . '%')
                    ->orWhere('project_title', 'like', '%' . $request->search . '%')
                    ->orWhere('user_id', $request->search)  // Assuming user_id is an integer
                    ->orWhere('status', $request->search);
            });
        }
        if ($request->has('sort_by') && $request->has('sort_order')) {
            $sortBy = $request->sort_by;
            $sortOrder = $request->sort_order;
            $query->orderBy($sortBy, $sortOrder);
        }

        // Paginate results (if needed)
        $perPage = $request->has('per_page') ? $request->per_page : 10;
        $travelRequests = $query->paginate($perPage);

        return view('dashboard.admin.travel.index', compact('travelRequests'));
    }
}
