@php
    $name = session()->get('name');
    $role = session()->get('role');
    $budgets = \App\Models\Budget::all(); // Define $budgets here or in the controller
@endphp

@extends('layouts.custom.user.master')

@section('title', 'User Dashboard')

@section('profile-nav')
    <div class="media profile-media">
        <img class="b-r-10" src="{{ asset('assets/images/dashboard/profile.png') }}" alt="">
        <div class="media-body">
            <span>{{ $name }}</span>
            <p class="mb-0 font-roboto">{{ strtoupper($role) }} <i class="middle fa fa-angle-down"></i></p>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/prism.css') }}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>User Dashboard</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">User</li>
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Details</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-left">
                            <h5>Reporting Details</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('pdf.budgets.show') }}"
                                class="list-group-item justify-content-between d-flex align-items-center">
                                <span class="d-flex align-items-center">
                                    <i data-feather="package"></i>
                                    <div>&nbsp;&nbsp;Budget Report</div>
                                </span>
                            </a>
                            <a href="{{ route('pdf.addbudgets.show') }}"
                                class="list-group-item justify-content-between d-flex align-items-center">
                                <span class="d-flex align-items-center">
                                    <i data-feather="package"></i>
                                    <div>&nbsp;&nbsp;Add Budget Report</div>
                                </span>
                            </a>
                            <a href="{{ route('pdf.cashflow.show') }}"
                                class="list-group-item justify-content-between d-flex align-items-center">
                                <span class="d-flex align-items-center">
                                    <i data-feather="package"></i>
                                    <div>&nbsp;&nbsp;Cash Flow Report</div>
                                </span>
                            </a>
                            <a href="{{ route('pdf.income.show') }}"
                                class="list-group-item justify-content-between d-flex align-items-center">
                                <span class="d-flex align-items-center">
                                    <i data-feather="package"></i>
                                    <div>&nbsp;&nbsp;Income Report</div>
                                </span>
                            </a>
                            <a href="{{ route('pdf.balance.show') }}"
                                class="list-group-item justify-content-between d-flex align-items-center">
                                <span class="d-flex align-items-center">
                                    <i data-feather="package"></i>
                                    <div>&nbsp;&nbsp;Balance Report</div>
                                </span>
                            </a>
                            <a href="{{ route('pdf.payable.show') }}"
                                class="list-group-item justify-content-between d-flex align-items-center">
                                <span class="d-flex align-items-center">
                                    <i data-feather="package"></i>
                                    <div>&nbsp;&nbsp;Account Payable Report</div>
                                </span>
                            </a>
                            <a href="{{ route('pdf.receivable.show') }}"
                                class="list-group-item justify-content-between d-flex align-items-center">
                                <span class="d-flex align-items-center">
                                    <i data-feather="package"></i>
                                    <div>&nbsp;&nbsp;Account Receivable Report</div>
                                </span>
                            </a>
                            <a href="{{ route('pdf.sales.show') }}"
                                class="list-group-item justify-content-between d-flex align-items-center">
                                <span class="d-flex align-items-center">
                                    <i data-feather="package"></i>
                                    <div>&nbsp;&nbsp;Sales Report</div>
                                </span>
                            </a>
                            <a href="{{ route('pdf.turnover.show') }}"
                                class="list-group-item justify-content-between d-flex align-items-center">
                                <span class="d-flex align-items-center">
                                    <i data-feather="package"></i>
                                    <div>&nbsp;&nbsp;Inventory Turnover Report</div>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </script>


@endsection

@section('script')
@endsection
