@extends('layouts.master')
@section('title')
    الأدوية
@stop
@section('css')
    <style>
        @media print {
            #print_Button {
                display: none;
            }
        }
    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الأدوية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ طباعه
                    الأدوية</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice" id="print">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h1 class="invoice-title">الأدوية</h1>
                            <div class="billed-from">
                                <h6>مركز رواد القلب </h6>
                                <p>201 المهندسين<br>
                                    Tel No: 011111111<br>
                                    Email: Hospital@gmail.com</p>
                            </div><!-- billed-from -->
                        </div><!-- invoice-header -->
                        <div class="row mg-t-20">
                            <div class="col-md">
                                <label class="tx-gray-600">معلومات مشتريات الأدوية</label>
                                <p class="invoice-info-row"><span>التاريخ </span>
                                    <span>{{ date('y-m-d') }}</span>
                                </p>

                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table" border="2"
                                style="text-align: center; font-size: 12px; font-weight: bolder; color: black;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>كود الدواء</th>
                                        <th>أسم الدواء</th>
                                        <th>أسم المورد</th>
                                        <th>الكمية </th>
                                        <th>الوحدة</th>
                                        <th>سعر الشراء</th>
                                        <th>سعر البيع</th>
                                        <th>الإجمالي</th>
                                        <th>تاريخ الشراء</th>
                                        <th>المحاسب</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Medicines as $Medicine)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $Medicine->bar_code }}</td>
                                            <td>{{ $Medicine->name }}</td>
                                            <td>{{ $Medicine->supplier }}</td>
                                            <td>{{ $Medicine->quantity }}</td>
                                            <td>{{ $Medicine->unit }}</td>
    
                                            <td>{{ number_format($Medicine->buy_price) }} </td>
                                            <td>{{ number_format($Medicine->sale_price) }} </td>
    
                                            <td>{{ number_format($Medicine->total) }} </td>
                                            <td>{{ $Medicine->date }}</td>
                                            <td>{{ $Medicine->create_by }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <hr class="mg-b-40">
                        <a href="#" class="btn btn-danger float-left mt-3 mr-2" id="print_Button"
                            onclick="printDiv()">
                            <i class="mdi mdi-printer ml-1"></i>طباعه
                        </a>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('/My/Dashboard/plugins/chart.js/Chart.bundle.min.js') }}"></script>


    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
@endsection
