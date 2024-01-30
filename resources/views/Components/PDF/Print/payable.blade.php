@extends('layouts.custom.print')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div id="letter-preview">
                    <div class="card">
                        <div class="card-body col-md-12">
                            <div class="text-center">
                                <h4><b>PAYABLE INFORMATION</b></h4>
                            </div>
                            <div class="container mt-5">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>Department</th>
                                            <th>Category</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payables as $payable)
                                            <tr>
                                                <td>{{ $payable->payable_code }}</td>
                                                <td>{{ $payable->payable_name }}</td>
                                                <td>{{ $payable->payable_amount }}</td>
                                                <td>{{ $payable->payable_date }}</td>
                                                <td>{{ $payable->type->type_name }}</td>
                                                <td>{{ $payable->department->department_name }}</td>
                                                <td>{{ $payable->category->plan_category_name }}</td>
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

        <script>
            function printer() {
                var element = document.getElementById('letter-preview');
                var opt = {
                      margin: 0.5,
                    filename: 'account-payable-report.pdf',
                    image: {
                        type: 'png',
                        quality: 0.98
                    },
                    html2canvas: {
                        scale: 2
                    },
                    jsPDF: {
                        unit: 'in',
                        format: 'letter',
                        orientation: 'landscape'
                    }
                };

                // New Promise-based usage:
                html2pdf().set(opt).from(element).save();
            }
        </script>
    @endsection
