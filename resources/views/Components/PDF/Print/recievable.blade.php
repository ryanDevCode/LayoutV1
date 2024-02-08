@extends('layouts.custom.print')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div id="letter-preview">
                    <div class="card">
                        <div class="card-body col-md-12">
                            <div class="text-center">
                                <h4><b>RECIEVABLE INFORMATION</b></h4>
                            </div>
                            <div class="container mt-5">

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Invoice Date</th>
                                            <th>Amount</th>
                                            <th>Due Date</th>
                                            <th>Type</th>
                                            <th>Department</th>
                                            <th>Category</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recievables as $recievable)
                                            <tr>
                                                <td>{{ $recievable->recievable_code }}</td>
                                                <td>{{ $recievable->recievable_name }}</td>
                                                <td>{{ $recievable->recievable_invoice_date }}</td>
                                                <td>₱{{ number_format($recievable->recievable_amount,2) }}</td>
                                                <td>{{ $recievable->recievable_due_date }}</td>
                                                <td>{{ $recievable->type->type_name }}</td>
                                                <td>{{ $recievable->department->department_name }}</td>
                                                <td>{{ $recievable->category->plan_category_name }}</td>
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

    <script>
        function printer() {
            var element = document.getElementById('letter-preview');
            var opt = {
                  margin: 0.5,
                filename: 'account-recievable-report.pdf',
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
