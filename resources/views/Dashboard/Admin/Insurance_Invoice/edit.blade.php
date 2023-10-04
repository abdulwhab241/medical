@extends('layouts.master')
@section('css')
    <!--Internal    Notify -->
    <link href="{{ URL::asset('/My/Dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('title')
    تعديل فاتورة تأمين
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> تعديل فاتورة تأمين
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

                    <form action="{{ route('InsuranceInvoice.update', 'test') }}" method="post">
                        @method('PUT')
                        @csrf

                        <input type="hidden" name="id" value="{{ $Invoices->id }}">

                        <div class="row">

                            <div class="col-md-3">
                                <label>شركة التأمين</label>
                                <select name="Company_id" class="form-control SlectBox">
                                    @foreach ($Companies as $Company)
                                    <option value="{{ $Company->id }}"
                                        {{ $Company->id == $Invoices->insurance_id ? 'selected' : '' }}>
                                        {{ $Company->name }}</option>
                                    @endforeach

                                </select>

                            </div>


                            <div class="col-md-3">
                                <label>أسم المريض</label>
                                <select name="Patient_id" class="form-control SlectBox">
                                    @foreach ($Patients as $Patient)
                                        <option value="{{ $Patient->id }}"
                                            {{ $Patient->id == $Invoices->patient_id ? 'selected' : '' }}>
                                            {{ $Patient->name }}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="col-md-3">
                                <label>نوع المشترك</label>
                                <select name="Employee" class="form-control SlectBox">
                                    <option>{{ $Invoices->subscriber_gender }}</option>
                                    <option value="الموظف">الموظف</option>
                                    <option value="الزوجة">الزوجة</option>
                                    <option value="الابناء">الابناء</option>
                                    <option value="الوالدين">الوالدين</option>

                                </select>

                            </div>

                            <div class="col-md-3">
                                <label>رقم المشترك</label>
                                <input type="text" name="Number" value="{{ $Invoices->subscriber_number }}" class="form-control">

                            </div>

                        </div>

                        <br>

                        <div class="row">

                            <div class="col-md-4">
                                <label>أسم الطبيب</label>
                                <select name="Doctor_id" class="form-control SlectBox">
                                    @foreach ($Doctors as $Doctor)
                                    <option value="{{ $Doctor->id }}"
                                        {{ $Doctor->id == $Invoices->user_doctor_id ? 'selected' : '' }}>
                                        {{ $Doctor->name }}</option>
                                    @endforeach

                                </select>

                            </div>

                            <div class="col-md-4">
                                <label>الإجراء</label>
                                <select name="Service_id" class="form-control SlectBox">
                                    @foreach ($Services as $Service)
                                    <option value="{{ $Service->id }}"
                                        {{ $Service->id == $Invoices->service_id ? 'selected' : '' }}>
                                        {{ $Service->name }}</option>
                                    @endforeach

                                </select>

                            </div>

                            <div class="col-md-4">
                                <label>المبلغ</label>
                                <select name="price" class="form-control SlectBox">
                                    <option>{{ $Invoices->price }}</option>
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
@endsection
