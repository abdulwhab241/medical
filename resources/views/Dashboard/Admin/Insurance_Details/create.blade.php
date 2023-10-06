@extends('layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{ URL::asset('/My/Dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('/My/Dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('title')
    إضافة تفاصيل لشركة التأمين
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">إضافة تفاصيل لشركة التأمين</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    شركات التأمين</span>
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
                    <form action="{{ route('InsuranceDetails.store') }}" method="post" autocomplete="off">
                        @csrf
                        <div class="row">

                            <div class="col-md-4">
                                <label>أسم شركة التأمين</label>
                                <select name="Insurance_id" class="form-control select2">
                                    @foreach ($Insurances as $Insurance)
                                    <option value=""></option>
                                        <option value="{{ $Insurance->id }}">{{ $Insurance->name }}</option>
                                    @endforeach
                                </select>
                                @error('Insurance_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label>رقم المشترك</label>
                                <input type="text" name="Insurance_code" dir="LTR"
                                    value="{{ old('Insurance_code') }}"
                                    class="form-control @error('Insurance_code') is-invalid @enderror">
                                @error('Insurance_code')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label>نوع المشترك</label>
                                <select name="Name" class="form-control select2">
                                    <option value="الموظف">الموظف</option>
                                    <option value="الزوجة">الزوجة</option>
                                    <option value="الابناء">الابناء</option>
                                    <option value="الوالدين">الوالدين</option>

                                </select>

                                @error('Name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <br>


                        <div class="row">

                            <div class="col-md-4">
                                <label>نسبة تحمل المريض</label>
                                <input type="number" name="Discount_percentage" value="{{ old('Discount_percentage') }}"
                                    class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label>نسبة تحمل الشركة</label>
                                <input type="number" name="Company_rate" value="{{ old('Company_rate') }}"
                                    class="form-control @error('Company_rate') is-invalid @enderror">
                                @error('Company_rate')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label>الملاحظات</label>
                                <textarea rows="2" cols="4" class="form-control" name="Notes">{{ old('Notes') }}</textarea>
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
