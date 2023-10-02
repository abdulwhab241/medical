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
                <h4 class="content-title mb-0 my-auto">الإجراءات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ شركات
                    التامين</span>
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
                    <a href="{{ route('insurance.create') }}" class="btn btn-primary">إضافة شركة تأمين جديدة</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap text-center" id="example1" style="text-algin: center;">
                            <thead>
                                <tr class="table-secondary">
                                    <th>#</th>
                                    <th>أسم الشركة</th>
                                    <th>كود الشركة</th>
                                    <th>الحالة</th>
                                    <th>الملاحظات</th>
                                    <th>تم إنشائها بواسطة</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($insurances as $insurance)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $insurance->name }}</td>
                                        <td>{{ $insurance->insurance_code }}</td>
                                        <td>
                                            <div
                                            class="dot-label bg-{{ $insurance->status == 1 ? 'success' : 'danger' }} ml-1">
                                        </div>
                                        {{ $insurance->status == 1 ? 'مفعلة' : 'موقفة' }}
                                        <td>{{ $insurance->notes }}</td>
                                        <td>{{ $insurance->create_by }}</td>
                                        <td>
                                            <a href="{{ route('insurance.edit', $insurance->id) }}"
                                                class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                            <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#Deleted{{ $insurance->id }}"><i class="fas fa-trash"></i>
                                            </button>

                                        </td>
                                        @include('Dashboard.insurance.Deleted')
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
