@extends('layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{ URL::asset('/My/Dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('title')
    إضافة فاتورة جديدة
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">إضافة فاتورة جديدة</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
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
                    <form action="{{ route('CashInvoices.store') }}" method="post" autocomplete="off">
                        @csrf
                        <div class="row">

                            <div class="col-md-4">
                                <label>أسم المريض</label>
                                <select name="Patient_id" class="form-control SlectBox">
                                    <option value="" selected disabled>---إختر من القائمة---</option>
                                    @foreach ($Patients as $Patient)
                                        <option value="{{ $Patient->id }}">{{ $Patient->name }}</option>
                                    @endforeach
                                </select>
                                @error('Patient_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label>أسم الطبيب</label>
                                <select name="Doctor_id" class="form-control SlectBox">
                                    <option value="" selected disabled>---إختر من القائمة---</option>
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
                                    <option value="" selected disabled>---إختر من القائمة---</option>
                                    @foreach ($Services as $Service)
                                        <option value="{{ $Service->id }}">{{ $Service->name }}</option>
                                    @endforeach
                                </select>
                                @error('Service_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <br>

                        <div class="row">
                            
                            <div class="col-md-4">
                                <label>المبلغ</label>
                                <select name="price" class="form-control SlectBox">

                                </select>

                            </div>

                            <div class="col-md-4">
                                <label>التخفيض</label>
                                <select name="Discount" class="form-control SlectBox">
                                    <option value="0"></option>
                                    <option value="5">5%</option>
                                    <option value="10">10%</option>
                                    <option value="15">15%</option>
                                    <option value="20">20%</option>

                                </select>
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
