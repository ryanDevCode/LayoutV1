@php
    $name = session()->get('name');
    $role = session()->get('role');
@endphp

@extends('layouts.custom.admin.master')

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
            overflow-y: scroll;
        }
    </style>
@endsection

@section('breadcrumb-title')
    <h3>Travel Request</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Admin</li>
    <li class="breadcrumb-item">Travel</li>
    <li class="breadcrumb-item active">Requests</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">

                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h3 class="mb-3">Rkive Travel Management</h3>
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
                                <a href="{{ route('admin.budgets.create') }}" class="btn btn-primary">Add Travel Request</a>
                            </div>
                            <div class="col-md-6 text-end">
                                <form action="{{ route('travel.search') }}" method="get"
                                    class="d-flex justify-content-end mb-">
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
                                            <th colspan="7">
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
                                            <th class="sortable">Title</th>
                                            <th class="sortable">Purpose</th>
                                            <th class="sortable">Destination</th>
                                            <th class="sortable">Start</th>
                                            <th class="sortable">End</th>
                                            <th class="sortable">Attachments</th>

                                            <th class="sortable">Status</th>
                                            <th class="sortable">Approver</th>
                                            <th class="sortable">Review</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($error))
                                            <tr>
                                                <td colspan="18" class=" text-center">
                                                    {{ $error }}
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($travel as $item)
                                                <tr class="text-center">

                                                    <td>{{ $item->travel_request_id }}</td>
                                                    <td>{{ $item->user->first_name }}</td>
                                                    <td>₱{{ number_format((float) $item->estimated_amount, 2) }}</td>
                                                    <td>{{ $item->project_title }}</td>
                                                    <td>{{ \Illuminate\Support\Str::words($item->purpose, 3, '...') }}</td>
                                                    <td>{{ $item->destination }}</td>
                                                    <td>{{ $item->start_date }}</td>
                                                    <td>{{ $item->end_date }}</td>
                                                    <td>Keneme</td>
                                                    <td>{{ $item->status }}</td>
                                                    <td>{{ $item->approver ? $item->approver : 'N/A' }}</td>
                                                    <td>
                                                        <a href="{{ route('travel.show', ['travel_request' => $item->travel_request_id]) }}"
                                                            class="btn btn-primary">View</a>

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
    <script>
        const table = document.querySelector('.table');

        const handleSort = (event) => {
            const element = event.target;
            const sortBy = element.textContent.toLowerCase(); // Get clicked column
            let sortOrder = 'asc';

            if (element.classList.contains('desc')) {
                sortOrder = 'desc';
                element.classList.remove('desc');
            } else {
                element.classList.add('desc');
            }

            // Redirect to the search page with updated sort parameters
            window.location.href =
                `{{ route('travel.search') }}?search={{ request()->search }}&sort_by=${sortBy}&sort_order=${sortOrder}`;
        };

        table.querySelectorAll('.sortable').forEach(element => {
            element.addEventListener('click', handleSort);
        });
    </script>
    {{-- <script type="text/javascript">
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
    </script> --}}
    <!-- Validation JS -->
    <script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
    <!-- Datepicker JS -->
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
@endsection
