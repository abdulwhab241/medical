@extends('layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{ URL::asset('/My/Dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
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
                                <select name="Company_id" class="form-control SlectBox">
                                    <option value="s" selected>---إختر من القائمة---</option>
                                    @foreach ($Companies as $Company)
                                        <option value="{{ $Company->id }}">{{ $Company->name }}</option>
                                    @endforeach
                                </select>
                                @error('Company_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="col-md-3">
                                <label>أسم المريض</label>
                                <select name="Patient_id" class="form-control SlectBox">
                                    <option value="s" selected>---إختر من القائمة---</option>
                                    @foreach ($Patients as $Patient)
                                        <option value="{{ $Patient->id }}">{{ $Patient->name }}</option>
                                    @endforeach
                                </select>
                                @error('Patient_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label>نوع المشترك</label>
                                <select name="Employee" class="form-control SlectBox">
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
                                <select name="Doctor_id" class="form-control SlectBox">
                                    <option value="s" selected>---إختر من القائمة---</option>
                                    @foreach ($Doctors as $Doctor)
                                        <option value="{{ $Doctor->id }}">{{ $Doctor->name }}</option>
                                    @endforeach
                                </select>
                                @error('Doctor_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label>الإجراء</label>
                                <select name="Service_id" class="form-control SlectBox">
                                    <option value="s" selected>---إختر من القائمة---</option>
                                    @foreach ($Services as $Service)
                                        <option value="{{ $Service->id }}">{{ $Service->name }}</option>
                                    @endforeach
                                </select>
                                @error('Service_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label>المبلغ</label>
                                <select name="price" class="form-control SlectBox">

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
    <script src="{{ URL::asset('/My/Dashboard/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('/My/Dashboard/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
