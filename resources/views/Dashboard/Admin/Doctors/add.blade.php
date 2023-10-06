@extends('layouts.master')
@section('css')
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('/My/Dashboard/plugins/sumoselect/sumoselect-rtl.css') }}">
    <link href="{{ URL::asset('/My/Dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />

    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('/My/Dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal  Datetimepicker-slider css -->
    <link href="{{ URL::asset('/My/Dashboard/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css') }}"
        rel="stylesheet">
    <link href="{{ URL::asset('/My/Dashboard/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css') }}"
        rel="stylesheet">
    <link href="{{ URL::asset('/My/Dashboard/plugins/pickerjs/picker.min.css') }}" rel="stylesheet">
    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{ URL::asset('/My/Dashboard/plugins/spectrum-colorpicker/spectrum.css') }}" rel="stylesheet">

@section('title')
    إضافة طبيب
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto"> الأطباء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                إضافة طبيب</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

{{-- @include('Dashboard.messages_alert') --}}

<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('Doctors.store') }}" method="post" autocomplete="off"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="pd-30 pd-sm-40 bg-gray-200">

                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-1">
                                <label for="exampleInputEmail1">
                                    اسم الطبيب</label>
                            </div>
                            <div class="col-md-11 mg-t-5 mg-md-t-0">
                                <input class="form-control" name="name" type="text" autofocus>
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>


                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-1">
                                <label for="exampleInputEmail1">
                                    رقم الهاتف</label>
                            </div>
                            <div class="col-md-11 mg-t-5 mg-md-t-0">
                                <input class="form-control" name="phone" type="number">
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>

                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-1">
                                <label for="exampleInputEmail1">
                                    العنوان</label>
                            </div>
                            <div class="col-md-11 mg-t-5 mg-md-t-0">
                                <textarea class="form-control" name="address" rows="2"></textarea>
                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>


                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-1">
                                <label for="exampleInputEmail1">
                                    القسم</label>
                            </div>

                            <div class="col-md-11 mg-t-5 mg-md-t-0">
                                <select name="section_id" class="form-control SlectBox">
                                    @foreach ($sections as $section)
                                    <option value=""></option>
                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                                @error('section_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>

                        </div>

                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-1">
                                <label for="exampleInputEmail1">
                                    ايام الدوام</label>
                            </div>

                            <div class="col-md-11 mg-t-5 mg-md-t-0">

                                <select multiple="multiple" class="testselect2" name="day_id[]">
                                    <option value="1" selected >-- حدد المواعيد --</option>
                                    @foreach ($Days as $Day)
                                        <option value="{{ $Day->name }}">{{ $Day->name }}</option>
                                    @endforeach
                                </select>

                            </div>

                        </div>

                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-1">
                                <label for="exampleInputEmail1">
                                    صورة الطبيب</label>
                            </div>
                            <div class="col-md-11 mg-t-5 mg-md-t-0">
                                <input type="file" accept="image/*" name="photo" onchange="loadFile(event)">
                                <img style="border-radius:50%" width="150px" height="150px" id="output" />
                            </div>
                        </div>

                        <button type="submit" class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">حفظ البيانات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /row -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')

<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>

<!--Internal  Form-elements js-->
<script src="{{ URL::asset('/My/Dashboard/js/select2.js') }}"></script>
<script src="{{ URL::asset('/My/Dashboard/js/advanced-form-elements.js') }}"></script>

<!--Internal Sumoselect js-->
<script src="{{ URL::asset('/My/Dashboard/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
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
