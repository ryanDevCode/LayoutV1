@php
    $name = session()->get('name');
    $role = session()->get('role');
@endphp

@extends('layouts.custom.admin.chart')

@section('title', 'Admin Dashboard')

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
    <h3>Admin Dashboard</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Admin</li>
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Details</li>
@endsection

@section('content')
<div class="container mt-4">
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Budget Overview</h5>
                    <div id="budgetChart" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add Budget Requests</h5>
                    <div id="addBudgetChart" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
        </div>

        <!-- Repeat the pattern for other charts -->
        <!-- Sales Chart -->
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Sales Data from Laravel</h5>
                    <div id="salesChart" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
        </div>

        <!-- Turnover Chart -->
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Turnover Chart</h5>
                    <div id="turnoverChart" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
        </div>

        <!-- Receivable Chart -->
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Receivable Chart</h5>
                    <div id="receivableChart" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
        </div>

        <!-- Payable Chart -->
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Payable Chart</h5>
                    <div id="payableChart" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
        </div>

        <!-- Payable and Receivable Chart -->
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Payable and Receivable Chart</h5>
                    <div id="payableAndRecievableChart" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
        </div>

        <!-- Balance Chart -->
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Balance Sheet Composition</h5>
                    <div id="balanceChart" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
        </div>

        <!-- Cashflow Chart -->
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Cashflow Chart</h5>
                    <div id="cashflowChart" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
        </div>

        <!-- Income Chart -->
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Income Chart</h5>
                    <div id="incomeChart" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    // Set the session layout variable
    var session_layout = '{{ session()->get('layout') }}';
    // Budget Chart
    var budgetChart = echarts.init(document.getElementById('budgetChart'));
    var budgetData = @json($budgetData);

    var budgetXAxisData = budgetData.map(item => item.budget_name);
    var budgetSeriesData = budgetData.map(item => item.budget_approvedAmount);

    var budgetOption = {
        xAxis: {
            type: 'category',
            data: budgetXAxisData
        },
        yAxis: {
            type: 'value'
        },
        series: [{
            data: budgetSeriesData,
            type: 'bar'
        }]
    };

    budgetChart.setOption(budgetOption);

    // Add Budget Chart
    var addBudgetChart = echarts.init(document.getElementById('addBudgetChart'));
    var addBudgetData = @json($addBudgetData);

    var addBudgetXAxisData = addBudgetData.map(item => item.request_name);
    var addBudgetSeriesData = addBudgetData.map(item => item.request_approvedAmount);

    var addBudgetOption = {
        xAxis: {
            type: 'category',
            data: addBudgetXAxisData
        },
        yAxis: {
            type: 'value'
        },
        series: [{
            data: addBudgetSeriesData,
            type: 'bar'
        }]
    };

    addBudgetChart.setOption(addBudgetOption);

    // Sales chart
    var salesChart = echarts.init(document.getElementById('salesChart'));

    // Use the data passed from the controller
    var salesData = @json($salesData);

    var xAxisData = salesData.map(item => item.sales_product_name);
    var seriesData = salesData.map(item => item.sales_revenue);

    var salesOption = {
        tooltip: {},
        xAxis: {
            data: xAxisData
        },
        yAxis: {},
        series: [{
            name: 'sales',
            type: 'bar',
            data: seriesData
        }]
    };

    salesChart.setOption(salesOption);

    // Turnover chart
    var turnoverChart = echarts.init(document.getElementById('turnoverChart'));

    // Use the data passed from the controller
    var turnoverData = @json($turnoverData);

    var xAxisData = turnoverData.map(item => item.turnover_product_name);
    var seriesData = turnoverData.map(item => item.turnover_cost_of_goods_sold);

    var turnoverOption = {
        xAxis: {
            type: 'category',
            data: xAxisData
        },
        yAxis: {
            type: 'value'
        },
        series: [{
            data: seriesData,
            type: 'line',
            smooth: true
        }]
    };

    turnoverChart.setOption(turnoverOption);


    //recievable chart
    var recievableChart = echarts.init(document.getElementById('receivableChart'));

    // Use the data passed from the controller
    var recievableData = @json($recievableData);

    var xAxisData = recievableData.map(item => item.recievable_invoice_date);
    var seriesData = recievableData.map(item => item.recievable_amount);

    var recievableOption = {
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: xAxisData
        },
        yAxis: {
            type: 'value'
        },
        series: [{
            data: seriesData,
            type: 'line',
            areaStyle: {}
        }]
    };

    recievableChart.setOption(recievableOption);

    //payable chart
    var payableChart = echarts.init(document.getElementById('payableChart'));

    // Use the data passed from the controller
    var payableData = @json($payableData);

    var xAxisData = payableData.map(item => item.payable_date);
    var seriesData = payableData.map(item => item.payable_amount);

    var payableOption = {
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: xAxisData
        },
        yAxis: {
            type: 'value'
        },
        series: [{
            data: seriesData,
            type: 'line',
            areaStyle: {}
        }]
    };

    payableChart.setOption(payableOption);

    // payable and recievable chart
    var payableAndRecievableChart = echarts.init(document.getElementById('payableAndRecievableChart'));

    // Use the data passed from the controller
    var payableData = @json($payableData);
    var recievableData = @json($recievableData);

    var payableXAxis = payableData.map(item => item.payable_date);
    var payableSeries = payableData.map(item => item.payable_amount);

    var recievableXAxis = recievableData.map(item => item.recievable_invoice_date);
    var recievableSeries = recievableData.map(item => item.recievable_amount);

    var payableAndRecievableOption = {
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: payableXAxis.concat(recievableXAxis)
        },
        yAxis: {
            type: 'value'
        },
        series: [{
                name: 'Payables',
                data: payableSeries,
                type: 'line',
                areaStyle: {}
            },
            {
                name: 'Receivables',
                data: recievableSeries,
                type: 'line',
                areaStyle: {}
            }
        ]
    };

    payableAndRecievableChart.setOption(payableAndRecievableOption);

    //cashflow chart
    var cashflowChart = echarts.init(document.getElementById('cashflowChart'));

    // Use the data passed from the controller
    var cashflowData = @json($cashflowData);

    var xAxisData = cashflowData.map(item => item.cashflow_name);
    var seriesData = cashflowData.map(item => item.cashflow_amount);

    var cashflowOption = {
        xAxis: {
            type: 'category',
            data: xAxisData
        },
        yAxis: {
            type: 'value'
        },
        series: [{
            name: 'Cash Flow',
            type: 'bar',
            stack: 'total',
            label: {
                show: true,
                position: 'inside'
            },
            data: seriesData
        }]
    };

    cashflowChart.setOption(cashflowOption);

    //blance chart
    var balanceChart = echarts.init(document.getElementById('balanceChart'));

    // Use the data passed from the controller
    var balanceData = @json($balanceData);

    // Extract data for the chart
    var legendData = balanceData.map(item => item.balance_name);
    var seriesData = balanceData.map(item => ({
        name: item.balance_name,
        value: item.balance_amount
    }));

    var balanceOption = {
        tooltip: {
            trigger: 'item',
            formatter: '{a} <br/>{b}: {c} USD ({d}%)'
        },
        series: [{
            name: 'Balance Sheet',
            type: 'pie',
            radius: '55%',
            center: ['50%', '60%'],
            data: seriesData,
            emphasis: {
                itemStyle: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
        }]
    };

    balanceChart.setOption(balanceOption);

    // income chart
    var incomeChart = echarts.init(document.getElementById('incomeChart'));

    // Use the data passed from the controller
    var incomeData = @json($incomeData);

    var xAxisData = incomeData.map(item => item.income_date);
    var seriesData = [{
            name: 'Sales Revenue',
            type: 'line',
            stack: 'total',
            data: incomeData.map(item => item.income_amount),
            areaStyle: {}
        },
        {
            name: 'Cost of Goods Sold',
            type: 'line',
            stack: 'total',
            data: incomeData.map(item => -item.income_amount), // Negative values for expenses
            areaStyle: {}
        },
        {
            name: 'Gross Profit',
            type: 'line',
            stack: 'total',
            data: incomeData.map(item => item.income_amount),
            areaStyle: {}
        },
        {
            name: 'Expenses',
            type: 'line',
            stack: 'total',
            data: incomeData.map(item => -item.income_amount), // Negative values for expenses
            areaStyle: {}
        }
    ];

    var incomeOption = {
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: xAxisData
        },
        yAxis: {
            type: 'value'
        },
        series: seriesData
    };

    incomeChart.setOption(incomeOption);
</script>

@endsection

@section('script')
<script src="{{ asset('assets/js/chart/echart/echart-5-4-3.js') }}"></script>
@endsection
