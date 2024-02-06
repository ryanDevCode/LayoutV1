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
            <div class="col-sm-12 border border-primary bg-white card">
                <div class="card-header row">
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
                    <div class="col-6">
                        <h3>Request Summary</h3>
                    </div>
                    <div class="col-6">
                        {{-- //approve --}}
                        <form action="{{ route('travel.update', ['travel_request' => $view->tr_track_no]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <input type="text" name="status" value="approved" hidden>


                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenter" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Approve Request</h5>
                                            <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="txt-danger">Make sure to have read all the neccessary informations</p>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <input class="form-control" type="text"
                                                            placeholder="Project name *" value="{{ $view->project_title }}"
                                                            data-bs-original-title="" title="" name="project_title"
                                                            hidden>
                                                        <input class="form-control" type="text" placeholder="John Doe"
                                                            value="{{ $view->destination }}" data-bs-original-title=""
                                                            title="" name="destination" hidden>
                                                        <input class="form-control" type="number" placeholder=""
                                                            value="{{ $view->estimated_amount }}" name="estimated_amount"
                                                            hidden>
                                                        <input type="text" name="status" value="approved" hidden>
                                                        <label>Leave a Note</label>
                                                        <textarea class="form-control" id="exampleFormControlTextarea4" rows="3" name="notes" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button"
                                                data-bs-dismiss="modal">Close</button>
                                            <button class="btn btn-primary" type="submit">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        {{-- //rejject --}}
                        <form action="{{ route('travel.update', ['travel_request' => $view->tr_track_no]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <input type="text" name="status" value="approved" hidden>


                            <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenter1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Reject Request</h5>
                                            <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="txt-danger">Are you sure to reejct the request?</p>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <input class="form-control" type="text"
                                                            placeholder="Project name *"
                                                            value="{{ $view->project_title }}" data-bs-original-title=""
                                                            title="" name="project_title" hidden>
                                                        <input class="form-control" type="text" placeholder="John Doe"
                                                            value="{{ $view->destination }}" data-bs-original-title=""
                                                            title="" name="destination" hidden>
                                                        <input class="form-control" type="number" placeholder=""
                                                            value="{{ $view->estimated_amount }}" name="estimated_amount"
                                                            hidden>
                                                        <input type="text" name="status" value="rejected" hidden>
                                                        <label>Leave a note for the reason of rejection</label>
                                                        <textarea class="form-control" id="exampleFormControlTextarea4" rows="3" name="notes" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button"
                                                data-bs-dismiss="modal">Close</button>
                                            <button class="btn btn-primary" type="submit">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <button class="btn btn-outline-primary m-1" type="button" data-bs-toggle="modal"
                            data-bs-target="#exampleModalCenter">Approve</button>
                        <button class="btn btn-outline-warning m-1" type="button" data-bs-toggle="modal"
                            data-bs-target=".bd-example-modal-lg">Revise</button>
                        <button class="btn btn-outline-danger m-1" type="button" data-bs-toggle="modal"
                            data-bs-target="#exampleModalCenter1">Reject</button>


                    </div>

                </div>
                <div class="card-body">
                    <p class="btn btn-outline-success btn-sm">Status: {{ $view->status }}</p>
                    <p>Project Title: {{ $view->project_title }}</p>
                    <p>Destination: {{ $view->destination }}</p>
                    <p>Tracking Code: {{ $view->tr_track_no }}</p>
                    <p>Start Date: {{ $view->start_date }}</p>
                    <p>End Date: {{ $view->end_date }}</p>
                    <p>Purpose: {{ $view->purpose }}</p>
                    <p>Estimated Amount: {{ $view->estimated_amount }}</p>
                    <p>Requestor: {{ $user->first_name }} {{ $user->last_name }}</p>
                    <p>Attachments: {{ $view->attachment }}</p>
                </div>


                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">Travel Request</h4>
                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('travel.update', ['travel_request' => $view->tr_track_no]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form theme-form">
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label>Project Title</label>
                                                    <input class="form-control" type="text"
                                                        placeholder="Project name *" value="{{ $view->project_title }}"
                                                        data-bs-original-title="" title="" name="project_title">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label>Destination</label>
                                                    <input class="form-control" type="text" placeholder="John Doe"
                                                        value="{{ $view->destination }}" data-bs-original-title=""
                                                        title="" name="destination">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label>Adjust Budget Amount</label>
                                                    <input class="form-control" type="number" placeholder=""
                                                        value="{{ $view->estimated_amount }}" name="estimated_amount">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label class="form-label"> Approval Status</label>
                                                    <select class="form-select" name="status" required="">
                                                        <option value="{{ $view->status }}">{{ $view->status }}</option>
                                                        <option value="approve">Approve</option>
                                                        <option value="rejected">Reject</option>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label>Note</label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea4" rows="3" name="notes" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit">Finish</button>
                                        {{-- <button class="btn btn-info" type="button" data-bs-toggle="modal"
                                                data-bs-target="#exampleModalLong">Revise</button> --}}
                                    </div>


                                    {{-- <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Terms and
                                                            Condition</h5>
                                                        <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body col-12">
                                                        <h3>
                                                            Travel Budget Request Portal Policy</h3>
                                                        <h6>1. Introduction</h6>
                                                        <p>This policy outlines the guidelines and procedures for utilizing
                                                            the
                                                            company's travel budget request portal
                                                            for submitting and approving travel budget requests.</p>
                                                        <h6>2. Eligibility</h6>
                                                        <p>All employees employed by [Company Name] who require
                                                            company-funded travel
                                                            for business purposes are eligible
                                                            to submit travel budget requests through the portal.</p>
                                                        <h6>3. Travel Types Covered</h6>
                                                        <p>The portal covers travel requests for:</p>
                                                        <ul>
                                                            <li>Business trips: attending conferences, meetings, client
                                                                visits, and
                                                                other work-related travel.</li>
                                                            <li>Professional development: training courses, workshops, and
                                                                seminars
                                                                directly related to employee's job
                                                                duties.</li>
                                                            <li>Relocations approved by the company.</li>
                                                        </ul>
                                                        <h6>4. Exclusions</h6>
                                                        <p>The following are not covered by the travel budget request
                                                            portal:</p>
                                                        <ul>
                                                            <li>Personal travel.</li>
                                                            <li>Travel for family members or guests.</li>
                                                            <li>Commutes to and from the employee's regular work location.
                                                            </li>
                                                            <li>Travel expenses already reimbursed through another company
                                                                program.</li>
                                                        </ul>
                                                        <h6>5. Budget Limitations</h6>
                                                        <p>Travel budget requests are subject to availability and approval
                                                            based on
                                                            departmental budgets and overall
                                                            company financial considerations.</p>
                                                        <h6>6. Request Process</h6>
                                                        <ul>
                                                            <li>Employees must submit travel budget requests through the
                                                                designated
                                                                portal, providing detailed information about the trip,
                                                                estimated costs,
                                                                and justification for company funding.</li>
                                                            <li>Requests should be submitted at least [Number] days prior to
                                                                the planned
                                                                travel date to allow for proper review and approval.</li>
                                                            <li>Department managers or authorized personnel will review the
                                                                submitted
                                                                requests and make approval decisions based on established
                                                                criteria.</li>
                                                            <li>Applicants will be notified of the approval or denial
                                                                decision via
                                                                email.</li>
                                                        </ul>
                                                        <h6>7. Cost Considerations</h6>
                                                        <p>Employees are expected to:</p>
                                                        <ul>
                                                            <li>Choose cost-effective travel options within reasonable
                                                                limits.</li>
                                                            <li>Adhere to company guidelines for airfare, hotels, meals, and
                                                                other
                                                                expenses.</li>
                                                            <li>Document all travel expenditures with receipts for
                                                                reimbursement.</li>
                                                        </ul>
                                                        <h6>8. Reimbursement Process</h6>
                                                        <p>Approved travel expenses will be reimbursed upon submission of
                                                            valid receipts
                                                            and completion of the designated company reimbursement form.</p>
                                                        <h6>9. Policy Violation</h6>
                                                        <p>Non-compliance with this policy, including misuse of the portal
                                                            or violation
                                                            of expense guidelines, may result in disciplinary action.</p>
                                                        <h6>10. Updates</h6>
                                                        <p>This policy is subject to revision at any time as deemed
                                                            necessary by the
                                                            company. All employees are responsible for staying informed
                                                            about any
                                                            updates to the policy.</p>
                                                        <h6>11. Contact Information</h6>
                                                        <p>For any questions or concerns regarding the travel budget request
                                                            portal or
                                                            this policy, please contact [Department/Person] at [Contact
                                                            Information].
                                                        </p>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button class="btn btn-primary" type="Submit">Agree and
                                                            Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                </form>
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
    <!-- Validation JS -->
    <script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
    <!-- Datepicker JS -->
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
@endsection
