@extends('layouts.custom.print')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div id="letter-preview">
                    <div class="card">
                        <div class="card-body col-md-12">
                            <div class="text-center">
                                <h4><b>REQUEST INFORMATION</b></h4>
                            </div>
                            <div class="container mt-5">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td colspan="5" class="text-center"><b>Budget Information</b></td>
                                        </tr>
                                        <tr>
                                            <td><b>ID</b></td>
                                            <td>{{ $foundBudget->id }}</td>
                                            <td></td>
                                            <td><b>Category</b></td>
                                            <td>
                                                @foreach ($categories as $category)
                                                    @if ($category->category_code == $foundBudget->budget_category)
                                                        {{ $category->category_name }}
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><b>Name</b></td>
                                            <td>{{ $foundBudget->budget_name }}</td>
                                            <td></td>
                                            <td><b>Amount</b></td>
                                            <td>{{ $foundBudget->budget_amount }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Description</b></td>
                                            <td colspan="4">{{ $foundBudget->budget_description }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Start Date</b></td>
                                            <td>{{ $foundBudget->budget_startDate }}</td>
                                            <td></td>
                                            <td><b>End Date</b></td>
                                            <td>{{ $foundBudget->budget_endDate }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                                <br>
                                <table class="table">
                                    <tbody>

                                        <tr>
                                            <td colspan="5" class="text-center"><b>Budget Approval Information</b></td>
                                        </tr>
                                        <tr>
                                            <td><b>Status</b></td>
                                            <td>
                                                @foreach ($status as $stat)
                                                    @if ($foundBudget->budget_status == $stat->status_code)
                                                        {{ $stat->status_name }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td></td>
                                            <td><b>Approved Date</b></td>
                                            <td>{{ $foundBudget->budget_approvedDate }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Approver</b></td>
                                            <td>
                                                @foreach ($users as $user)
                                                    @if ($user->username == $foundBudget->budget_approvedBy)
                                                        {{ $user->first_name . ' ' . $user->last_name }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td></td>
                                            <td><b>Approved Amount</b></td>
                                            <td>{{ $foundBudget->budget_approvedAmount }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Notes</b></td>
                                            <td colspan="4">{{ $foundBudget->budget_notes }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-body col-md-12">
                            <div class="container mt-5">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td colspan="5" class="text-center"><b>Addional Budget
                                                Information</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>ID</b></td>
                                        <td>{{ $requestBudget->request_code }}</td>
                                        <td></td>
                                        <td><b>Category</b></td>
                                        <td>
                                            @foreach ($categories as $category)
                                                @if ($category->category_code == $requestBudget->request_category)
                                                    {{ $category->category_name }}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><b>Budget Code</b></td>
                                        <td>{{ $requestBudget->request_budget_code }}</td>
                                        <td></td>
                                        <td><b>Budget Name</b></td>
                                        <td>
                                            @if ($foundBudget)
                                                {{ $foundBudget->budget_name }}
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><b>Name</b></td>
                                        <td>{{ $requestBudget->request_name }}</td>
                                        <td></td>
                                        <td><b>Amount</b></td>
                                        <td>{{ $requestBudget->request_amount }}</td>
                                    </tr>

                                    <tr>
                                        <td><b>Description</b></td>
                                        <td colspan="4">{{ $requestBudget->request_description }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <br>
                            <table class="table">
                                <tbody>

                                    <tr>
                                        <td colspan="5" class="text-center"><b>Request Approval Information</b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Status</b></td>
                                        <td>
                                            @foreach ($status as $stat)
                                                @if ($requestBudget->request_status == $stat->status_code)
                                                    {{ $stat->status_name }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td></td>
                                        <td><b>Approved Date</b></td>
                                        <td>{{ $requestBudget->request_approvedDate }}</td>
                                    </tr>

                                    <tr>
                                        <td><b>Approver</b></td>
                                        <td>
                                            @foreach ($users as $user)
                                                @if ($user->username == $requestBudget->request_approvedBy)
                                                    {{ $user->first_name . ' ' . $user->last_name }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td></td>
                                        <td><b>Approved Amount</b></td>
                                        <td>{{ $requestBudget->request_approvedAmount }}</td>
                                    </tr>

                                    <tr>
                                        <td><b>Notes</b></td>
                                        <td colspan="4">{{ $requestBudget->request_notes }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function printer() {
            var element = document.getElementById('letter-preview');
            var opt = {
                margin: 1,
                filename: 'budget-request-plan.pdf',
                image: {
                    type: 'png',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'a4',
                    orientation: 'landscape'
                }
            };

            // New Promise-based usage:
            html2pdf().set(opt).from(element).save();
        }
    </script>
@endsection
