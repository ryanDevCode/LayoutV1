@extends('layouts.custom.print')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div id="letter-preview">
                    <div class="card">
                        <div class="card-body col-md-12">
                            <div class="text-center">
                                <h4><b>BALANCE SHEET</b></h4>
                            </div>
                            <div class="container mt-5">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Amount</th>
                                            {{-- <th>Department</th> --}}
                                            <th>Category</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($balances as $balance)
                                            <tr>
                                                <td>{{ $balance->balance_name }}</td>
                                                <td>₱{{ number_format($balance->balance_amount,2) }}</td>
                                                {{-- <td>
                                                    @foreach ($departments as $department)
                                                        @if ($balance->balance_department == $department->department_code)
                                                            {{ $department->department_name }}
                                                        @endif
                                                    @endforeach
                                                </td> --}}
                                                <td>
                                                    @foreach ($categories as $category)
                                                        @if ($balance->balance_category == $category->plan_category_code)
                                                            {{ $category->plan_category_name }}
                                                        @endif
                                                    @endforeach
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

    <script>
        function printer() {
            var element = document.getElementById('letter-preview');
            var opt = {
                  margin: 0.5,
                filename: 'balance-sheet.pdf',
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
