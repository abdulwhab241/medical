@extends('layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{ URL::asset('/My/Dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('/My/Dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('title')
    تعديل دواء المريض
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> تعديل دواء المريض
                </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    <label style="color: cadetblue">{{  $PatientMedicine->Patient->name }}</label></span>
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

                    <form action="{{ route('Patient_Medicines.update', 'test') }}" method="post">
                        @method('PUT')
                        @csrf

                        <input type="hidden" name="id" value="{{ $PatientMedicine->id }}">
                        <input type="hidden" name="Patient_id" value="{{ $PatientMedicine->patient_id }}">

                        <div class="row">

                            <div class="col-md-6 col-xl-6">
                                <label>أسم الدواء</label>
                                <select name="Medicine_id" class="form-control select2"
                                    dir="ltr">
                                    @foreach ($Medicines as $Medicine)
                                    <option value="{{ $Medicine->id }}"
                                        {{ $Medicine->id == $PatientMedicine->medicine_id ? 'selected' : '' }}>
                                        {{ $Medicine->name }}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="col-md-3">
                                <label>الجرعة</label>
                                <input type="text" name="Dosage" value="{{ $PatientMedicine->dosage }}"
                                    class="form-control">

                            </div>

                            <div class="col-md-3">
                                <label>وقت الجرعة</label>
                                <input type="text" name="Use" value="{{ $PatientMedicine->use }}"
                                    class="form-control">

                            </div>


                        </div>

                        <br>

                        <div class="row">

                            <div class="col-md-4">
                                <label>الفترة</label>
                                <input type="text" name="Period" value="{{ $PatientMedicine->period }}" class="form-control">
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
