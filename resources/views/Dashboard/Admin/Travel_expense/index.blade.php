@php
    $name = session()->get('name');
    $role = session()->get('role');
@endphp

@extends('layouts.custom.admin.chart')

@section('title', 'Admin Budget')

@section('profile-nav')
    <div class="media profile-media"><img class="b-r-10" src="{{ asset('assets/images/dashboard/profile.png') }}"
            alt="">
        <div class="media-body"><span>{{ $name }}</span>
            <p class="mb-0 font-roboto">{{ strtoupper($role) }} <i class="middle fa fa-angle-down"></i></p>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/prism.css') }}">
    <!-- Datepicker CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css') }}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Travel Expenses</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Admin</li>
    <li class="breadcrumb-item">Travel</li>
    <li class="breadcrumb-item active">Expenses</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Travel Expense Breakdown
                        </div>
                        <div class="card-body justify-content-center">
                            {{-- <h5>Travel Expense Breakdown</h5> --}}
                            <div id="chart-container" style="width: 100%; height: 400px;" class="mb-3 p-2"></div>
                            <div class="bg-primary rounded p-3">
                                <ul>
                                    <li>Total Transportation: ₱{{ number_format((float) $totalTransportation, 2) }}</li>
                                    <li>Total Accommodation: ₱{{ number_format((float) $totalAccommodation, 2) }}</li>
                                    <li>Total Meal: ₱{{ number_format((float) $totalMeal, 2) }}</li>
                                    <li>Total Other Expenses: ₱{{ number_format((float) $totalOther, 2) }}</li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h3 class="mb-3">Travel Expenses</h3>
                        @if ($errors->any() || session('success'))
                            <div class="alert alert-float" role="alert">
                                <ul>
                                    @if ($errors->any())
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    @else
                                        {{ session('success') }}
                                    @endif
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <a href="{{ route('admin.budgets.create') }}" class="btn btn-primary">Add Travel
                                    Request</a>
                            </div>
                            <div class="col-md-6 text-end">
                                <form action="#" method="get" class="d-flex justify-content-end mb-">
                                    @csrf
                                    <label for="search" class="visually-hidden">Search</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control w-25" name="search" placeholder="Search">
                                        <button type="submit" class="btn btn-primary"><i class="icon-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class="table-responsive">
                            <div class="table-container">
                                <table class="table">
                                    <thead class="text-center">

                                        <tr>
                                            <th class="sortable">Travel Request ID</th>
                                            <th class="sortable">Name</th>
                                            <th class="sortable">Total Transportation</th>
                                            <th class="sortable">Total Accommodation</th>
                                            <th class="sortable">Total Meal</th>
                                            <th class="sortable">Total Other Expenses</th>
                                            <th class="sortable">Review</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($groupedExpenses as $travelId => $expenseGroup)
                                            <tr>
                                                <td>{{ $travelId }}</td>
                                                <td>{{ $expenseGroup->first()->user->first_name }}</td>
                                                <td>₱{{ number_format((float) $expenseGroup->pluck('transportation')->sum(), 2) }}
                                                </td>
                                                <td>₱{{ number_format((float) $expenseGroup->pluck('accommodation')->sum(), 2) }}
                                                </td>
                                                <td>₱{{ number_format((float) $expenseGroup->pluck('meal')->sum(), 2) }}
                                                </td>
                                                <td>₱{{ number_format((float) $expenseGroup->pluck('other_expenses_amount')->sum(), 2) }}
                                                </td>

                                                <td><a href="{{ route('travel-expense.show', ['travel_expense' => $travelId]) }}"
                                                        class="btn btn-primary">View</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var session_layout = '{{ session()->get('layout') }}';
        var chart = echarts.init(document.getElementById('chart-container'));
        var option = {
            // title: {
            //     text: 'Travel Expense Breakdown'
            // },
            tooltip: {
                trigger: 'item',
                formatter: '{a} <br/>{b}: {c} PHP ({d}%)'
            },
            legend: {
                data: ['Transportation', 'Accommodation', 'Meal', 'Other Expenses']
            },
            series: [{
                name: 'Expenses',
                type: 'pie',
                radius: '80%',
                center: ['50%', '60%'],
                data: [{
                        value: {{ $totalTransportation }},
                        name: 'Transportation'
                    },
                    {
                        value: {{ $totalAccommodation }},
                        name: 'Accommodation'
                    },
                    {
                        value: {{ $totalMeal }},
                        name: 'Meal'
                    },
                    {
                        value: {{ $totalOther }},
                        name: 'Other Expenses'
                    }
                ],
                emphasis: {
                    itemStyle: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }],
            grid: {
                left: '5%',
                right: '5%',
                top: '15%',
                bottom: '15%'
            },
        };
        chart.setOption(option);



    </script>
@endsection

@section('script')
    <script src="{{ asset('assets/js/chart/echart/echart-5-4-3.js') }}"></script>

    <!-- Validation JS -->
    <script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
    <!-- Datepicker JS -->
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>

@endsection
