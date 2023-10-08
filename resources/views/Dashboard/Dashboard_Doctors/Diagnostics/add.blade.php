@extends('layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{ URL::asset('/My/Dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('/My/Dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('title')
    إضافة تشخيص للمريض
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">إضافة تشخيص للمريض</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    <label style="color: cadetblue">{{  $Invoice->Patient->name }}</label>
                    </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('Dashboard.messages_alert')
    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('Diagnostics.store') }}" method="post" autocomplete="off">
                        @csrf

                        <input type="hidden" name="id" value="{{$Invoice->id}}">
                        <input type="hidden" name="Patient_id" value="{{$Invoice->patient_id}}">
        
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">التشخيص</label>
                            <textarea class="form-control" name="Diagnosis" rows="4">{{ old('Diagnosis') }}</textarea>
                            @error('Diagnosis')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>

                        <div class="row">

                            <div class="col-md-6 col-xl-6">
                                <label>أسم الدواء</label>
                                <select name="Medicine_id[]"  multiple="multiple" class="form-control select2" dir="ltr">
                                    @foreach ($Medicines as $Medicine)
                                    <option value=""></option>
                                        <option value="{{ $Medicine->id }}">{{ $Medicine->name }}</option>
                                    @endforeach
                                </select>
                                @error('Medicine_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label>الجرعة</label>
                                <input type="text" name="Dosage"
                                    value="{{ old('Dosage') }}"
                                    class="form-control @error('Dosage') is-invalid @enderror">
                                @error('Dosage')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label>وقت الجرعة</label>
                                <input type="text" name="Use"
                                value="{{ old('Use') }}"
                                class="form-control @error('Use') is-invalid @enderror">

                                @error('Use')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>

                        </div>

                        <br>


                        <div class="row">

                            <div class="col-md-4">
                                <label>الفترة</label>
                                <input type="text" name="Period" value="{{ old('Period') }}"
                                    class="form-control">
                                    @error('Period')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                        <br>

                        <div class="modal-footer">
                            <button class="btn btn-success btn-block">حفظ البيانات</button>
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
