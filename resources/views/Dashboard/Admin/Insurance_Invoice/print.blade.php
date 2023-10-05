@extends('layouts.master')
@section('title')
    طباعه فاتورة التأمين
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
                <h4 class="content-title mb-0 my-auto">طباعة فاتورة التأمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    طباعه
                    الفواتير</span>
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
                            <h1 class="invoice-title">مركز رواد القلب</h1>
                            <div class="billed-from">
                                <h6>مركز رواد القلب</h6>
                                <p>201 المهندسين<br>
                                    Tel No: 0111111111<br>
                                    Email: Admin@gmail.com</p>
                            </div><!-- billed-from -->
                        </div><!-- invoice-header -->
                        <div class="row mg-t-20">

                            <div class="col-md">
                                <label class="tx-gray-600 ">تفاصيل فاتورة التأمين</label><br>
                                <p class="invoice-info-row "> <span class="text-center">{{ $Invoice->created_at }}</span></p>
                                <p class="invoice-info-row">
                                    <span> {{ $Invoice->Doctor->section->name }} </span>
                                </p>
                                <p class="invoice-info-row"><span>رقم الفاتورة</span>
                                    <span></span>{{ $Invoice->id }}
                                </p>
                                <p class="invoice-info-row"><span>تاريخ الفاتورة</span>
                                    <span></span>{{ $Invoice->date }}
                                </p>
                                <p class="invoice-info-row"><span>أسم الطبيب</span>
                                    <span></span>{{ $Invoice->Doctor->name }}
                                </p>
                                <p class="invoice-info-row"><span>أسم المريض</span>
                                    <span></span>{{ $Invoice->Patient->name }}
                                </p>
                                <p class="invoice-info-row"><span>شركة التأمين</span>
                                    <span></span>{{ $Invoice->Insurance->name }}
                                </p>
                                <p class="invoice-info-row"><span>رقم المشترك</span>
                                    <span></span>{{ $Invoice->subscriber_number }}
                                </p>
                                <p class="invoice-info-row"><span>نوع التعامل</span>
                                    <span></span> {{ $Invoice->status == 1 ? 'تأمين' : 'اجل' }}
                                </p>
                                <p class="invoice-info-row"><span>تاريخ الزيارة</span>
                                    <span></span>{{ $Invoice->created_at }}
                                </p>

                            </div>

                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0" border="1"
                                style="text-align: center;">
                                <thead>
                                    <tr>
                                        <th>وصف البند</th>
                                        <th>المبلغ</th>
                                        <th>نسبة التحمل</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $Invoice->Service->name }}</td>
                                        <td>{{ number_format($Invoice->price) }} </td>
                                        <td>{{ $Invoice->discount_percentage }} </td>
                                    </tr>
                                <tfoot>
                                    <tr>
                                        <th colspan="2">مجموع الفاتورة</th>
                                        <td> {{ number_format($Invoice->price) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">مبلغ المريض</td>
                                        <td>{{ number_format($Invoice->total_patient) }}</td>

                                    </tr>
                                </tfoot>

                                </tbody>
                            </table>
                            <hr>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label>المحاسب:</label>
                                </div>
                                <div class="col-md-4 mg-t-5 mg-md-t-0">
                                    <input class="form-control text-center tx-primary" readonly value=" {{ $Invoice->create_by }}"
                                        type="text">
                                </div>
                            </div>

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
