@extends('layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{ URL::asset('/My/Dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('/My/Dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('title')
    تعديل فاتورة نقدية
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> تعديل فاتورة نقدية
                </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    الفواتير</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('CashInvoices.update', 'test') }}" method="post">
                        @method('PUT')
                        @csrf

                        <input type="hidden" name="id" value="{{ $Invoices->id }}">

                        <div class="row">

                            <div class="col-md-3">
                                <label>أسم المريض</label>
                                <select name="Patient_id" class="form-control select2">
                                    @foreach ($Patients as $Patient)
                                        <option value="{{ $Patient->id }}"
                                            {{ $Patient->id == $Invoices->patient_id ? 'selected' : '' }}>
                                            {{ $Patient->name }}</option>
                                    @endforeach

                                </select>

                            </div>

                            <div class="col-md-3">
                                <label>أسم الطبيب</label>
                                <select name="Doctor_id" class="form-control select2">
                                    @foreach ($Doctors as $Doctor)
                                        <option value="{{ $Doctor->id }}"
                                            {{ $Doctor->id == $Invoices->user_doctor_id ? 'selected' : '' }}>
                                            {{ $Doctor->name }}</option>
                                    @endforeach

                                </select>

                            </div>

                            <div class="col-md-3">
                                <label>المبلغ</label>
                                <select name="price" class="form-control select2">
                                    <option>{{ $Invoices->price }}</option>
                                </select>

                            </div>

                            <div class="col-md-3">
                                <label>التخفيض</label>
                                <select name="Discount" class="form-control select2">
                                    <option>{{ $Invoices->discount_value }}</option>
                                    <option value="0">0%</option>
                                    <option value="5">5%</option>
                                    <option value="10">10%</option>
                                    <option value="15">15%</option>
                                    <option value="20">20%</option>

                                </select>
                            </div>


                        </div>


                        <br>


                        <div class="modal-footer">
                            <button class="btn btn-success btn-block">تعديل البيانات</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
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
