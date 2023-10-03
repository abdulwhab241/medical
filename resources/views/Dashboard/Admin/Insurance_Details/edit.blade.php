@extends('layouts.master')
@section('css')
    <!--Internal  Notify -->
    <link href="{{ URL::asset('/My/Dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('title')
    تعديل تفاصيل شركة التأمين
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> تعديل تفاصيل شركة التأمين</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    الإجراءات</span>
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

                    <form action="{{ route('InsuranceDetails.update', 'test') }}" method="post">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id" value="{{ $InsuranceDetails->id }}">
                        <div class="row">

                            <div class="col-md-4">
                                <label>أسم شركة التأمين</label>

                                <select name="Insurance_id" class="SlectBox form-control">
                                    @foreach ($Insurances as $Insurance)
                                        <option value="{{ $Insurance->id }}"
                                            {{ $Insurance->id == $InsuranceDetails->insurance_id ? 'selected' : '' }}>
                                            {{ $Insurance->name }}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="col-md-4">
                                <label> نوع المشترك</label>
                                <input type="text" name="Name" value="{{ $InsuranceDetails->name }}"
                                    class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label>رقم المشترك</label>
                                <input type="text" name="Insurance_code" dir="LTR"
                                    value="{{ $InsuranceDetails->insurance_code }}" class="form-control">
                            </div>

                        </div>

                        <br>


                        <div class="row">

                            <div class="col-md-4">
                                <label>نسبة تحمل المريض</label>
                                <input type="number" name="Discount_percentage"
                                    value="{{ $InsuranceDetails->discount_percentage }}" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label>نسبة تحمل الشركة</label>
                                <input type="number" name="Company_rate" value="{{ $InsuranceDetails->company_rate }}"
                                    class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label>حالة التأمين</label>
                                <select class="form-control" id="status" name="Status">
                                    <option value="{{ $InsuranceDetails->status }}" selected>
                                        {{ $InsuranceDetails->status == 1 ? 'مفعل' : 'موقف' }}</option>
                                    <option value="1">مفعل</option>
                                    <option value="0">موقف</option>
                                </select>
                            </div>

                        </div>

                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>الملاحظات</label>
                                <textarea rows="2" cols="4" class="form-control" name="Notes">{{ $InsuranceDetails->notes }}</textarea>
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
