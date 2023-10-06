@extends('layouts.master')
@section('css')
    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('/My/Dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('/My/Dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('title')
    اضافة راتب جديد
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">اضافة راتب جديد</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    الحسابات</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @include('Dashboard.messages_alert')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('Salary.store') }}" method="post" autocomplete="off"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}


                        <div class="pd-30 pd-sm-40 bg-gray-200">

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-2">
                                    <label>اسم الموظف</label>
                                </div>
                                <div class="col-md-10 mg-t-5 mg-md-t-0">
                                    <select name="User_id" class="form-control select2 ">
                                        @foreach ($Users as $User)
                                            <option value=""></option>
                                            <option value="{{ $User->id }}">{{ $User->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('User_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-2">
                                    <label>الراتب</label>
                                </div>
                                <div class="col-md-10 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="Salary" value="{{ old('Salary') }}" type="number">
                                    @error('Salary')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-2">
                                    <label>الخصومات</label>
                                </div>
                                <div class="col-md-10 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="Discount" value="{{ old('Discount') }}"
                                        type="number">
                                </div>
                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-2">
                                    <label>البدلات</label>
                                </div>
                                <div class="col-md-10 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="Suit" value="{{ old('Suit') }}" type="number">
                                </div>
                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-2">
                                    <label>البيان</label>
                                </div>
                                <div class="col-md-10 mg-t-5 mg-md-t-0">
                                    <textarea class="form-control" name="Disc" rows="3">{{ old('Disc') }}</textarea>
                                    @error('Disc')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5 btn-block">حفظ
                                البيانات</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
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
