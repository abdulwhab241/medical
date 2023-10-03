@extends('layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{ URL::asset('/My/Dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('title')
    إضافة شركة تأمين جديدة
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الإجراءات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    شركة التأمين</span>
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
                    <form action="{{ route('insurance.store') }}" method="post" autocomplete="off">
                        @csrf
                        <div class="row">

                            <div class="col-md-6">
                                <label>أسم الشركة</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label>كود الشركة</label>
                                <input type="text" name="insurance_code" value="{{ old('insurance_code') }}"
                                    class="form-control @error('insurance_code') is-invalid @enderror">
                                @error('insurance_code')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <br>


                        <div class="row">
                            <div class="col">
                                <label>الملاحظات</label>
                                <textarea rows="2" cols="4" class="form-control" name="notes">{{ old('notes') }}</textarea>
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
