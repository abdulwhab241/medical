@extends('layouts.master')
@section('title')
    الرواتب
@stop
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('/My/Dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('/My/Dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />

    <link href="{{ URL::asset('/My/Dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal  Datetimepicker-slider css -->
    <link href="{{ URL::asset('/My/Dashboard/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css') }}"
        rel="stylesheet">
    <link href="{{ URL::asset('/My/Dashboard/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css') }}"
        rel="stylesheet">
    <link href="{{ URL::asset('/My/Dashboard/plugins/pickerjs/picker.min.css') }}" rel="stylesheet">
    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{ URL::asset('/My/Dashboard/plugins/spectrum-colorpicker/spectrum.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> الرواتب</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    الحسابات</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('Dashboard.messages_alert')
    <!-- row -->
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">

                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('Salary.create') }}" class="btn btn-primary" role="button"
                                aria-pressed="true">اضافة راتب جديد</a>
                        </div>

                        <div class="col-md-6">

                            <a href="{{ route('Print_Salary') }}" class="btn btn-info" role="button"
                                aria-pressed="true">طباعة الرواتب</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table text-md-nowrap" id="example1" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم الموظف</th>
                                    <th>الوظيفة</th>
                                    <th>البدلات</th>
                                    <th>الخصومات</th>
                                    <th>الراتب</th>
                                    <th>الوصف</th>
                                    <th>الإجمالي</th>
                                    <th>تاريخ الصرف</th>
                                    <th>المحاسب</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Salaries as $Salary)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $Salary->User->name }}</td>
                                        <td>{{ $Salary->the_job }}</td>
                                        <td>{{ number_format($Salary->suits) }}</td>
                                        <td>{{ number_format($Salary->discounts) }}</td>
                                        <td>{{ number_format($Salary->the_salary) }}</td>
                                        <td>{{ \Str::limit($Salary->disc, 50) }}</td>
                                        <td>{{ number_format($Salary->total) }}</td>
                                        <td>{{ $Salary->date }}</td>
                                        <td>{{ $Salary->create_by }}</td>
                                        <td>
                                            <a href="{{ route('Salary.edit', $Salary->id) }}" style="margin: 3px;"
                                                class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                            <a class="modal-effect btn btn-sm btn-danger" style="margin: 3px;"
                                                data-effect="effect-scale" data-toggle="modal"
                                                href="#delete{{ $Salary->id }}"><i class="las la-trash"></i></a>

                                        </td>
                                    </tr>
                                    @include('Dashboard.Admin.Salaries.delete')
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        <!--/div-->

        <!-- /row -->

    </div>
    <!-- row closed -->

    <!-- Container closed -->

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
    <!--Internal  pickerjs js -->
    <script src="{{ URL::asset('/My/Dashboard/plugins/pickerjs/picker.min.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('/My/Dashboard/js/form-elements.js') }}"></script>

@endsection
