<?php

namespace App\Http\Controllers\Components\Admin;

use App\Http\Controllers\Controller;
use App\Models\TravelExpense;
use App\Models\TravelRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
class TravelExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $keneme = TravelExpense::all();
        // dd($keneme);
//         $expenses = TravelExpense::with('trackRequests')->where('travel_request_id', 3)->get();
// dd($expenses);

        // dd($expense->travelRequests);

        //of you want espicidif specific
        // $travelRequestId = 123; // Replace with the actual ID
        // $expenses = TravelExpense::where('travel_request_id', $travelRequestId)->get();
        //total transportation

        //total accomodation

        //total meal
        $expenses = TravelExpense::with(['trackRequests','user'])->get();

        //total of each travel request with the same travel_id
        $groupedExpenses = $expenses->groupBy('travel_request_id');
        $userTransportation = 0;
        $userAccommodation = 0;
        $userMeal = 0;
        $userOther = 0;

        foreach ($expenses as $expense) {
            $trackRequests = $expense->trackRequests;

            // Calculate and accumulate values based on the relationship
            $userTransportation += $trackRequests->total_transportation ?? 0;
            $userAccommodation += $trackRequests->total_accommodation ?? 0;
            $userMeal += $trackRequests->total_meal ?? 0;
            $userOther += $trackRequests->total_other_expenses ?? 0;
        }


        $totalTransportation = 0;
        $totalAccommodation = 0;
        $totalMeal = 0;
        $totalOther = 0;


        foreach ($expenses as $expense) {
            $totalTransportation += $expense->transportation;
            $totalAccommodation += $expense->accommodation;
            $totalMeal += $expense->meal;
            $totalOther += $expense->other_expenses_amount;
        }
        $data = [
            'totalTransportation' => $totalTransportation,
            'totalAccommodation' => $totalAccommodation,
            'totalMeal' => $totalMeal,
            'totalOther' => $totalOther,
            'expenses' => $expenses,



        ];
        return view('dashboard.admin.travel_expense.index', $data, compact('groupedExpenses'));

    }
    // public function index()
    // {


    //     $expenses = TravelExpense::with('travelRequests')->get();
    //     $expenses->each(function ($expense) use ($expenses) {
    //         $expenses->totalTransportation += $expense->transportation;
    //         $expenses->totalAccommodation += $expense->accommodation;
    //         $expenses->totalMeal += $expense->meal;
    //         $expenses->totalOtherExpenses += $expense->other_expenses_amount;
    //     });

    //     // Ensure initial values for totals (in case of empty collection):
    //     $expenses->totalTransportation = $expenses->totalTransportation ?? 0;
    //     $expenses->totalAccommodation = $expenses->totalAccommodation ?? 0;
    //     $expenses->totalMeal = $expenses->totalMeal ?? 0;
    //     $expenses->totalOtherExpenses = $expenses->totalOtherExpenses ?? 0;

    //     return view('dashboard.admin.travel_expense.index', compact('expenses'));
    // }

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
        $view = TravelExpense::with('user')->where('travel_request_id', $id)->get();

        $totalTransportation = 0;
        $totalAccommodation = 0;
        $totalMeal = 0;
        $totalOther = 0;

        foreach ($view as $expense) {
            $totalTransportation += $expense->transportation;
            $totalAccommodation += $expense->accommodation;
            $totalMeal += $expense->meal;
            $totalOther += $expense->other_expenses_amount;
        }
        $data = [
            'totalTransportation' => $totalTransportation,
            'totalAccommodation' => $totalAccommodation,
            'totalMeal' => $totalMeal,
            'totalOther' => $totalOther,



        ];
        return view('dashboard.admin.travel_expense.show', $data, compact('view'));
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
