@extends('layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{ URL::asset('/My/Dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('title')
    تفاصيل شركات التامين
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> تفاصيل شركات التامين</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ شركات التأمين</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('Dashboard.messages_alert')

    <!-- row -->
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('InsuranceDetails.create') }}" class="btn btn-primary">إضافة تفاصيل لشركة تأمين </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap text-center" id="example1" style="text-algin: center;">
                            <thead>
                                <tr class="table-secondary">
                                    <th>#</th>
                                    <th>أسم شركة التأمين</th>
                                    <th>نوع المشترك</th>
                                    <th>رقم المشترك</th>
                                    <th>نسبة تحمل المريض</th>
                                    <th>نسبة تحمل الشركة</th>
                                    <th>حالة التأمين</th>
                                    <th>الملاحظات</th>
                                    <th>تم إنشائها بواسطة</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($InsuranceDetails as $InsuranceDetail)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $InsuranceDetail->Insurance->name }}</td>
                                        <td>{{ $InsuranceDetail->name }}</td>
                                        <td dir="LTR">{{ $InsuranceDetail->insurance_code }}</td>
                                        <td>{{ $InsuranceDetail->discount_percentage }} % </td>
                                        <td>{{ $InsuranceDetail->company_rate }} % </td>
                                        <td>
                                            <div
                                                class="dot-label bg-{{ $InsuranceDetail->status == 1 ? 'success' : 'danger' }} ml-1">
                                            </div>
                                            {{ $InsuranceDetail->status == 1 ? 'مفعل' : 'موقف' }}
                                        </td>
                                        <td>{{ $InsuranceDetail->notes }}</td>
                                        <td>{{ $InsuranceDetail->create_by }}</td>
                                        <td>
                                            <a href="{{ route('InsuranceDetails.edit', $InsuranceDetail->id) }}"
                                                style="margin:3px;" class="btn btn-sm btn-success"><i
                                                    class="fas fa-edit"></i></a>
                                            <button class="btn btn-sm btn-danger" data-toggle="modal" style="margin:3px;"
                                                data-target="#Deleted{{ $InsuranceDetail->id }}"><i
                                                    class="fas fa-trash"></i>
                                            </button>

                                        </td>
                                        @include('Dashboard.Admin.Insurance_Details.Deleted')
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
