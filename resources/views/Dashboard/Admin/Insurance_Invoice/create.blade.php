@extends('layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{ URL::asset('/My/Dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('/My/Dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

@endsection
@section('title')
    إضافة فاتورة تأمين جديدة
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">إضافة فاتورة تأمين جديدة</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    الفواتير</span>
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
                    <form action="{{ route('InsuranceInvoice.store') }}" method="post" autocomplete="off">
                        @csrf
                        <div class="row">

                            <div class="col-md-3">
                                <label>شركة التأمين</label>
                                <select name="Company_id" class="form-control select2">
                                    @foreach ($Companies as $Company)
                                    <option value=""></option>
                                        <option value="{{ $Company->id }}">{{ $Company->name }}</option>
                                    @endforeach
                                </select>
                                @error('Company_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="col-md-3">
                                <label>أسم المريض</label>
                                <select name="Patient_id" class="form-control select2">
                                    @foreach ($Patients as $Patient)
                                    <option value=""></option>
                                        <option value="{{ $Patient->id }}">{{ $Patient->name }}</option>
                                    @endforeach
                                </select>
                                @error('Patient_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label>نوع المشترك</label>
                                <select name="Employee" class="form-control select2">
                                    {{-- <option  selected>---إختر من القائمة---</option> --}}
                                    <option value="الموظف">الموظف</option>
                                    <option value="الزوجة">الزوجة</option>
                                    <option value="الابناء">الابناء</option>
                                    <option value="الوالدين">الوالدين</option>

                                </select>
                                @error('Employee')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label>رقم المشترك</label>
                                <input type="text" name="Number" class="form-control">
                                @error('Number')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>





                        </div>

                        <br>

                        <div class="row">

                            <div class="col-md-4">
                                <label>أسم الطبيب</label>
                                <select name="Doctor_id" class="form-control select2">
                                    @foreach ($Doctors as $Doctor)
                                    <option value=""></option>
                                        <option value="{{ $Doctor->id }}">{{ $Doctor->name }}</option>
                                    @endforeach
                                </select>
                                @error('Doctor_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label>الإجراء</label>
                                <select name="Service_id" class="form-control select2">
                                    @foreach ($Services as $Service)
                                    <option value=""></option>
                                        <option value="{{ $Service->id }}">{{ $Service->name }}</option>
                                    @endforeach
                                </select>
                                @error('Service_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label>المبلغ</label>
                                <select name="price" class="form-control select2">

                                </select>
                                @error('price')
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
