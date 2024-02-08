<?php

use App\Http\Controllers\Components\ChartController;
use App\Http\Controllers\Components\PDF\PreviewController;
use App\Http\Controllers\Components\PDF\ReportController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Components\AuthController;
use App\Http\Controllers\Components\StoreController;

use App\Http\Controllers\Components\Admin\Budgets as AdminBudgets;
use App\Http\Controllers\Components\Admin\RequestBudgets as AdminRequestBudgets;
use App\Http\Controllers\Components\Admin\TravelRequestController;
use App\Http\Controllers\Components\Admin\TravelExpenseController;

use App\Http\Controllers\Components\User\Budgets as UserBudgets;
use App\Http\Controllers\Components\User\RequestBudgets as UserRequestBudgets;

use App\Http\Controllers\Components\PDFController;

/*
|--------------------------------------------------------------------------
| Custom Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return redirect()->route('login');
// })->name('/');


Route::group(['prefix' => '/auth'], function () {

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/reset', [AuthController::class, 'showResetForm'])->name('reset');
    Route::post('/reset', [AuthController::class, 'reset']);

    Route::get('/role', [StoreController::class, 'RoleForm'])->name('role');
    Route::post('/role', [StoreController::class, 'register_role']);

    Route::get('/department', [StoreController::class, 'DepartmentForm'])->name('department');
    Route::post('/department', [StoreController::class, 'register_department']);

});

Route::get('/block', [AuthController::class, 'block']);

// Admin
Route::middleware(['auth', checkRole::class . ':102'])->group(function () {
    Route::view('home', 'layouts.custom.admin.home')->name('home.admin');
    Route::get('/admin/dashboard', [StoreController::class, 'adminDashboard'])->name('admin.dashboard');

    Route::resource('/admin/budgets', AdminBudgets::class)->names('admin.budgets');
    Route::get('admin/budgets/{department_code?}/search', [AdminBudgets::class, 'search'])->name('admin.budgets.search');

    Route::resource('/admin/budget/requests', AdminRequestBudgets::class)->names('admin.budgets.requests');
    Route::get('admin/budget/requests/{department_code?}/search', [AdminRequestBudgets::class, 'search'])->name('admin.budgets.requests.search');

    Route::get('admin/chart', [ChartController::class,'adminchart'])->name('admin.analytics');

    Route::resource('admin/travel-requests', TravelRequestController::class)->names('travel');
    Route::get('admin/travel-requests/search', 'TravelRequestController@search')->name('travel.search');
    Route::resource('admin/travel-expenses', TravelExpenseController::class)->names('travel-expense');

    // Route::get('admin/travel-requests/{request}', TravelRequestController::class, 'find')->name('travel-search');


});

// User
Route::middleware(['auth', checkRole::class . ':103'])->group(function () {
    Route::get('/user/dashboard', [StoreController::class, 'userDashboard'])->name('user.dashboard');

    Route::resource('/user/budgets', UserBudgets::class)->names('user.budgets');
    Route::get('user/budgets/{department_code?}/search', [UserBudgets::class, 'search'])->name('user.budgets.search');

    Route::resource('/user/budget/requests', UserRequestBudgets::class)->names('user.budgets.requests');
    Route::get('user/budget/requests/{department_code?}/search', [UserRequestBudgets::class, 'search'])->name('user.budgets.requests.search');

    Route::get('user/chart', [ChartController::class,'userchart'])->name('user.analytics');


});


Route::group(['prefix' => 'pdf'], function () {

    Route::get('/dashboard', [ReportController::class, 'admin'])->name('admin.pdf');


    Route::get('/budgets', [PreviewController::class, 'budgets'])->name('pdf.budgets.show');
    Route::get('/budget/requests', [PreviewController::class, 'addbudgets'])->name('pdf.addbudgets.show');
    Route::get('/cashflow', [PreviewController::class, 'cashflow'])->name('pdf.cashflow.show');
    Route::get('/balance', [PreviewController::class, 'balance'])->name('pdf.balance.show');
    Route::get('/income', [PreviewController::class, 'income'])->name('pdf.income.show');
    Route::get('/payable', [PreviewController::class, 'payable'])->name('pdf.payable.show');
    Route::get('/recievable', [PreviewController::class, 'receivable'])->name('pdf.receivable.show');
    Route::get('/sales', [PreviewController::class, 'sales'])->name('pdf.sales.show');
    Route::get('/turnover', [PreviewController::class, 'turnover'])->name('pdf.turnover.show');

    Route::get('/budgets/{id}', [ReportController::class, 'budgetPrint'])->name('pdf.budget');
    Route::get('/budget/requests/{id}', [ReportController::class, 'addbudgetPrint'])->name('pdf.addbudget');
    Route::get('/cashflow/{id}', [ReportController::class, 'cashflowPrint'])->name('pdf.cashflow');
    Route::get('/balance/{id}', [ReportController::class, 'balancePrint'])->name('pdf.balance');
    Route::get('/income/{id}', [ReportController::class, 'incomePrint'])->name('pdf.income');
    Route::get('/payable/{id}', [ReportController::class, 'payablePrint'])->name('pdf.payable');
    Route::get('/recievable/{id}', [ReportController::class, 'recievablePrint'])->name('pdf.recievable');
    Route::get('/sales/{id}', [ReportController::class, 'salesPrint'])->name('pdf.sales');
    Route::get('/turnover/{id}', [ReportController::class, 'turnoverPrint'])->name('pdf.turnover');

});
