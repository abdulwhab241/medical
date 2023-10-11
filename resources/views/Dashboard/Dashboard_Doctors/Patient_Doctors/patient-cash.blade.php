@extends('layouts.master')
@section('css')
    <link href="{{ URL::asset('/My/Dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('/My/Dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">قائمة مرضى النقدية</h4>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('Dashboard.messages_alert')
    <!-- row opened -->
    <div class="row row-sm">
        <!--div-->
        <div class="col-xl-12">
            <div class="card">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>أسم المريض</th>
                                    <th>وصف البند</th>
                                    <th>عُمر المريض</th>
                                    <th>نوع التعامل</th>
                                    <th>إجمالي الفاتورة</th>
                                    <th>المحاسب</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Invoices as $Invoice)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $Invoice->Patient->name }}</td>
                                        <td>{{ $Invoice->Service->name }}</td>
                                        <td>{{ $Invoice->Patient->age }} سنة </td>
                                        <td>
                                            {{ $Invoice->status == 1 ? 'نقدي' : 'اجل' }}
                                        </td>
                                        <td>{{ number_format($Invoice->total) }} </td>

                                        <td>{{ $Invoice->create_by }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                                    type="button">العمليات<i class="fas fa-caret-down mr-1"></i></button>

                                                <div class="dropdown-menu tx-13 text-center">
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#add_diagnosis{{ $Invoice->id }}"><i
                                                            class="text-primary fa fa-stethoscope"></i>&nbsp;&nbsp;اضافة
                                                        تشخيص </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('add_medicines', $Invoice->id) }}"><i
                                                            class="text-warning far fa-file-alt"></i>&nbsp;&nbsp;اضافة
                                                        دواء </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('add_Xray', $Invoice->id) }}"><i
                                                            class="text-primary fas fa-x-ray"></i>&nbsp;&nbsp;تحويل الي
                                                        الاشعة </a>
                                                    {{-- <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#xray_conversion{{ $Invoice->id }}"><i
                                                            class="text-primary fas fa-x-ray"></i>&nbsp;&nbsp;تحويل الي
                                                        الاشعة </a> --}}
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#laboratorie_conversion{{ $Invoice->id }}"><i
                                                            class="text-warning fas fa-syringe"></i>&nbsp;&nbsp;تحويل الي
                                                        المختبر </a>

                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#laboratorie_conversion{{ $Invoice->id }}"><i
                                                            class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp;عرض تفاصيل
                                                        المريض </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @include('Dashboard.Dashboard_Doctors.Patient_Doctors.add_diagnosis')
                                    {{-- @include('Dashboard.Dashboard_Doctors.Patient_Doctors.xray_conversion') --}}
                                    {{-- @include('Dashboard.Dashboard_Doctors.Patient_Doctors.add_review')
                                    @include('Dashboard.Dashboard_Doctors.Patient_Doctors.xray_conversion')
                                    @include('Dashboard.Dashboard_Doctors.Patient_Doctors.Laboratorie_conversion') --}}
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        <!--/div-->
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('/My/Dashboard/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('/My/Dashboard/plugins/notify/js/notifit-custom.js') }}"></script>

    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('/My/Dashboard/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('/My/Dashboard/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('/My/Dashboard/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal Select2.min js -->
    <script src="{{ URL::asset('/My/Dashboard/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Ion.rangeSlider.min js -->
    <script src="{{ URL::asset('/My/Dashboard/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <!--Internal  jquery-simple-datetimepicker js -->
    <script src="{{ URL::asset('/My/Dashboard/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}">
    </script>
    <!-- Ionicons js -->
    <script src="{{ URL::asset('/My/Dashboard/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}">
    </script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('/My/Dashboard/js/form-elements.js') }}"></script>
@endsection
