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
                    'status' =>$request->input('status'),
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
}
