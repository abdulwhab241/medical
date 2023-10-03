@extends('layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{ URL::asset('/My/Dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('title')
    الفواتير النقدية
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير النقدية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
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
                    <a href="{{ route('CashInvoices.create') }}" class="btn btn-primary">إضافة فاتورة جديدة</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap text-center" id="example1" style="text-algin: center;">
                            <thead>
                                <tr class="table-secondary">
                                    {{-- <th>#</th> --}}
                                    <th>رقم الفاتورة</th>
                                    <th>أسم المريض</th>
                                    <th>أسم الإجراء</th>
                                    <th>أسم الطبيب </th>
                                    <th>تاريخ الزيارة</th>
                                    <th>نوع التعامل</th>
                                    <th>المبلغ</th>
                                    <th>التخفيض</th>
                                    <th>الإجمالي</th>
                                    <th>تم إنشائها بواسطة</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Invoices as $Invoice)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $Invoice->Patient->name }}</td>
                                        <td>{{ $Invoice->Service->name }}</td>
                                        <td>{{ $Invoice->Doctor->name }}</td>
                                        <td>{{ $Invoice->created_at }}</td>
                                        <td>
                                            {{ $Invoice->status == 1 ? 'نقدي' : 'اجل'  }}
                                        </td>
                                        <td>{{ number_format($Invoice->price) }} ريال </td>
                                        <td>{{ $Invoice->discount_value }} % </td>
                                        <td>{{ number_format($Invoice->total) }} ريال </td>
                                        <td>{{ $Invoice->create_by }}</td>
                                        <td>
                                            <a href="{{ route('CashInvoices.edit', $Invoice->id) }}" style="margin: 3px;"
                                                class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                            <button class="btn btn-sm btn-danger" data-toggle="modal" style="margin: 3px;"
                                                data-target="#Deleted{{ $Invoice->id }}"><i class="fas fa-trash"></i>
                                            </button>

                                        </td>
                                        @include('Dashboard.Admin.Cash_Invoice.Deleted')
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
