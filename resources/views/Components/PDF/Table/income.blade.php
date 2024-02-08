@php
    $name = session()->get('name');
    $role = session()->get('role');
@endphp

@extends('layouts.custom.admin.master')

@section('title', 'Admin Budget Details')

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
    <h3>Company Budget</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Admin</li>
    <li class="breadcrumb-item">Budget</li>
    <li class="breadcrumb-item active">Details</li>
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
                        <div class="row g-3">


                            <div class="table-responsive">
                                <div class="table-container">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="sortable">ID</th>
                                                <th class="sortable">Name</th>
                                                <th class="sortable">Amount</th>
                                                <th class="sortable">Date</th>
                                                <th class="sortable">Type</th>
                                                <th class="sortable">Department</th>
                                                <th class="sortable">Category</th>
                                                <th class="sortable">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($incomes as $income)
                                                <tr>
                                                    <td>{{ $income->income_code }}</td>
                                                    <td>{{ $income->income_name }}</td>
                                                    <td>₱{{ number_format($income->income_amount,2) }}</td>
                                                    <td>{{ $income->income_date }}</td>
                                                    <td>{{ $income->type->type_name }}</td>
                                                    <td>{{ $income->department->department_name }}</td>
                                                    <td>{{ $income->category->plan_category_name }}</td>
                                                    <td>
                                                        <form action="{{ route('pdf.income', ['id' => 'IN001']) }}"
                                                            method="GET" style="display: inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-primary btn-sm"><i
                                                                    class="icon-printer"></i></button>
                                                        </form>
                                                    </td>
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
