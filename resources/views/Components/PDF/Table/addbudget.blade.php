@php
    $name = session()->get('name');
    $role = session()->get('role');
@endphp

@extends('layouts.custom.admin.master')

@section('profile-nav')
    <div class="media profile-media"><img class="b-r-10" src="{{ asset('assets/images/dashboard/profile.png') }}"
            alt="">
        <div class="media-body"><span>{{ $name }}</span>
            <p class="mb-0 font-roboto">{{ strtoupper($role) }} <i class="middle fa fa-angle-down"></i></p>
        </div>
    </div>
@endsection
@section('title', 'Budget')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/prism.css') }}">

@endsection

@section('style')
    <style>
        th.sortable {
            cursor: pointer;
        }

        th.sortable:hover {
            background-color: #f2f2f2;
        }

        th.sortable::after {
            content: '\25B4';
            color: #000;

        }

        th.sorted-asc::after {
            content: '\25BE';
            color: #000;
        }

        th.sorted-desc::after {
            content: '\25B4';
            color: #000;
        }

        .table-container {
            height: 500px;
            /* Adjust the height as needed */
            overflow-y: scroll;
        }
    </style>
@endsection

@section('breadcrumb-title')
    <h3>Budget Request Report</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Admin</li>
    <li class="breadcrumb-item">Budget</li>
    <li class="breadcrumb-item">Request</li>
    <li class="breadcrumb-item active">Report</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                @if (Session::has('success'))
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        </div>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h3 class="mb-3">Rkive Budget Record</h3><span>Rkive Administrative Solution is a company that
                            provides efficient and reliable administrative services to businesses of all sizes. We offer a
                            range of solutions, such as bookkeeping, payroll, invoicing, data entry, and more. Our goal is
                            to help our clients save time and money by outsourcing their administrative tasks to us. We have
                            a team of experienced and qualified professionals who can handle any project with accuracy and
                            professionalism. Whether you need a one-time service or a long-term partnership, we are here to
                            serve you.</span>
                    </div>
                    <div class="card-body">


                        <div class="table-responsive">
                            <div class="table-container">
                                <table class="table">
                                    <thead class="text-center">
                                        <tr>
                                            <th colspan="7">
                                                <b>Plan</b>
                                            </th>
                                            <th colspan="3">
                                                <b>Request</b>
                                            </th>
                                            <th colspan="5">
                                                <b>Approvals</b>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="sortable">ID</th>
                                            <th class="sortable">Name</th>
                                            <th class="sortable">Amount</th>
                                            <th class="sortable">Description</th>
                                            <th class="sortable">Category</th>
                                            <th class="sortable">Budget Name</th>

                                            <th class="sortable">Spending</th>
                                            <th class="sortable">Variance</th>
                                            <th class="sortable">Reason</th>

                                            <th class="sortable">Status</th>
                                            <th class="sortable">Approver</th>
                                            <th class="sortable">Date</th>
                                            <th class="sortable">Amount</th>
                                            <th class="sortable">Notes</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- if error is present don't show the table row, and if the error is not present, show the table row --}}
                                        @if (isset($error))
                                            <tr>
                                                <td colspan="18" class=" text-center">
                                                    {{ $error }}
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($requests as $request)
                                                <tr class="text-center">
                                                    <td>{{ $request->request_code }}</td>
                                                    <td>{{ $request->request_name }}</td>
                                                    <td>{{ $request->request_amount }}</td>
                                                    <td>{{ $request->request_description }}</td>
                                                    <td>
                                                        @foreach ($categories as $category)
                                                            @if ($category->category_code == $request->request_category)
                                                                {{ $category->category_name }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($budgets as $budget)
                                                            @if ($budget->id == $request->request_budget_code)
                                                                {{ $budget->budget_name }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $request->request_actualSpending }}</td>
                                                    <td>{{ $request->request_variance }}</td>
                                                    <td>{{ $request->request_varianceReason }}</td>
                                                    <td>
                                                        @foreach ($status as $stat)
                                                            @if ($stat->status_code == $request->request_status)
                                                                {{ $stat->status_name }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($users as $user)
                                                            @if ($user->username == $request->request_approvedBy)
                                                                {{ $user->first_name . ' ' . $user->last_name }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $request->request_approvedDate }}</td>
                                                    <td>{{ $request->request_approvedAmount }}</td>
                                                    <td>{{ $request->request_notes }}</td>
                                                    <td>
                                                        <form
                                                            action="{{ route('admin.budgets.requests.edit', ['request' => $request->request_code]) }}"
                                                            method="GET" style="display: inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-warning btn-sm"><i
                                                                    class="icon-pencil-alt"></i></button>
                                                        </form>

                                                        <form
                                                            action="{{ route('pdf.addbudget', ['id' => $request->request_code]) }}"
                                                            method="GET" style="display: inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-primary btn-sm"><i
                                                                    class="icon-printer"></i></button>
                                                        </form>

                                                        <form
                                                            action="{{ route('admin.budgets.requests.destroy', ['request' => $request->request_code]) }}"
                                                            method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure you want to delete this item?')">
                                                                <i class="icon-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
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
    </script>
@endsection

@section('script')
    {{-- Column sorting --}}
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const getCellValue = (row, index) => row.children[index].innerText || row.children[index].textContent;

            const comparer = (index, asc) => (a, b) => {
                const valA = getCellValue(asc ? a : b, index);
                const valB = getCellValue(asc ? b : a, index);
                return isNaN(valA) || isNaN(valB) ? valA.localeCompare(valB) : valA - valB;
            };

            document.querySelectorAll('th.sortable').forEach(headerCell => {
                headerCell.addEventListener('click', () => {
                    const table = headerCell.closest('table');
                    const thIndex = Array.prototype.indexOf.call(headerCell.parentNode.children,
                        headerCell);
                    const isAsc = headerCell.classList.contains('sorted-asc');
                    const isDesc = headerCell.classList.contains('sorted-desc');
                    const direction = isAsc ? 'desc' : 'asc';

                    table.querySelectorAll('th').forEach(th => th.classList.remove('sorted-asc',
                        'sorted-desc'));
                    headerCell.classList.toggle(`sorted-${direction}`);

                    Array.from(table.querySelectorAll('tbody tr'))
                        .sort(comparer(thIndex, isAsc))
                        .forEach(tr => table.querySelector('tbody').appendChild(tr));
                });
            });
        });
    </script>
@endsection
