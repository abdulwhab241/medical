@extends('layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{ URL::asset('/My/Dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('title')
    فواتير التأمين
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">فواتير التأمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
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
                <div class="card-header">
                    <a href="{{ route('InsuranceInvoice.create') }}" class="btn btn-primary">إضافة فاتورة جديدة</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap text-center" id="example1" style="text-algin: center;">
                            <thead>
                                <tr class="table-secondary">
                                    {{-- <th>#</th> --}}
                                    <th>رقم الفاتورة</th>
                                    <th>شركة التأمين</th>
                                    <th>رقم المشترك</th>
                                    <th>أسم المريض</th>
                                    <th>أسم الإجراء</th>
                                    <th>أسم الطبيب </th>
                                    <th>تاريخ الزيارة</th>
                                    <th>نوع التعامل</th>
                                    <th>المبلغ</th>
                                    <th>نسبة التحمل</th>
                                    <th>مبلغ المريض</th>
                                    <th>المحاسب</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Insurances as $Insurance)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $Insurance->Insurance->name }}</td>
                                        <td>{{ $Insurance->subscriber_number }}</td>
                                        <td>{{ $Insurance->Patient->name }}</td>
                                        <td>{{ $Insurance->Service->name }}</td>
                                        <td>{{ $Insurance->Doctor->name }}</td>
                                        <td>{{ $Insurance->created_at }}</td>
                                        <td>
                                            {{ $Insurance->status == 1 ? 'تأمين' : 'اجل' }}
                                        </td>
                                        <td>{{ number_format($Insurance->price) }} </td>
                                        <td>{{ $Insurance->discount_percentage }} </td>
                                        <td>{{ number_format($Insurance->total_patient) }} </td>
                                        <td>{{ $Insurance->create_by }}</td>
                                        <td>
                                            <a href="{{ route('InsuranceInvoice.edit', $Insurance->id) }}"
                                                style="margin: 3px;" class="btn btn-sm btn-success"><i
                                                    class="fas fa-edit"></i></a>
                                            <button class="btn btn-sm btn-danger" data-toggle="modal" style="margin: 3px;"
                                                data-target="#Deleted{{ $Insurance->id }}"><i class="fas fa-trash"></i>
                                            </button>

                                        </td>
                                        @include('Dashboard.Admin.Insurance_Invoice.Deleted')
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
