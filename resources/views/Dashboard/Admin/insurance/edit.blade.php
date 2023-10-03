@extends('layouts.master')
@section('css')
    <!--Internal    Notify -->
    <link href="{{ URL::asset('/My/Dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('title')
    تعديل شركة التأمين
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">تعديل شركة التأمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
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

                    <form action="{{ route('insurance.update', 'test') }}" method="post">
                        @method('PUT')
                        @csrf

                        <input type="hidden" name="id" value="{{ $insurances->id }}">

                        <div class="row">

                            <div class="col-md-6">
                                <label>أسم الشركة</label>
                                <input type="text" name="name" value="{{ $insurances->name }}"
                                    class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label>كود الشركة</label>
                                <input type="text" name="insurance_code" value="{{ $insurances->insurance_code }}"
                                    class="form-control @error('insurance_code') is-invalid @enderror">
                                @error('insurance_code')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <br>


                        <div class="row">
                            <div class="col-md-4">
                                <label>حالة الشركة</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="{{ $insurances->status }}" selected>
                                        {{ $insurances->status == 1 ? 'مفعلة' : 'موقفة' }}</option>
                                    <option value="1">مفعلة</option>
                                    <option value="0">موقفة</option>
                                </select>
                            </div>

                            <div class="col-md-8">
                                <label>الملاحظات</label>
                                <textarea rows="2" cols="4" class="form-control" name="notes">{{ $insurances->notes }}</textarea>
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
