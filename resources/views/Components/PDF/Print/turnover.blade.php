@extends('layouts.custom.print')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div id="letter-preview">
                    <div class="card">
                        <div class="card-body col-md-12">
                            <div class="text-center">
                                <h4><b>TURNOVER INFORMATION</b></h4>
                            </div>
                            <div class="container mt-5">

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product Name</th>
                                            <th>Cost of Goods Sold</th>
                                            <th>Inventory Turnover Ratio</th>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>Department</th>
                                            <th>Category</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($turnovers as $turnover)
                                            <tr>
                                                <td>{{ $turnover->turnover_code }}</td>
                                                <td>{{ $turnover->turnover_product_name }}</td>
                                                <td>{{ $turnover->turnover_cost_of_goods_sold }}</td>
                                                <td>{{ $turnover->turnover_inventory_turnover_ratio }}</td>
                                                <td>{{ $turnover->turnover_date }}</td>
                                                <td>{{ $turnover->type->type_name }}</td>
                                                <td>{{ $turnover->department->department_name }}</td>
                                                <td>{{ $turnover->category->plan_category_name }}</td>
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
                filename: 'inventory-turnover-report.pdf',
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
