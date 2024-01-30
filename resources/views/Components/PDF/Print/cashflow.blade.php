@extends('layouts.custom.print')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div id="letter-preview">
                    <div class="card">
                        <div class="card-body col-md-12">
                            <div class="text-center">
                                <h4><b>CASH FLOW SHEET</b></h4>
                            </div>
                            <div class="container mt-5">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            {{-- <th>ID</th> --}}
                                            <th>Name</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            {{-- <th>Type</th> --}}
                                            {{-- <th>Department</th> --}}
                                            <th>Category</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cashflows as $cashflow)
                                            <tr>
                                                {{-- <td>{{ $cashflow->cashflow_code }}</td> --}}
                                                <td>{{ $cashflow->cashflow_name }}</td>
                                                <td>{{ $cashflow->cashflow_amount }}</td>
                                                <td>{{ $cashflow->cashflow_date }}</td>
                                                {{-- <td>{{ $cashflow->type->type_name }}</td> --}}
                                                {{-- <td>{{ $cashflow->department->department_name }}</td> --}}
                                                <td>{{ $cashflow->category->plan_category_name }}</td>
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
                filename: 'cashflow-statement.pdf',
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
