@extends('layouts.master')
@section('title')
    الإجراءات
@stop
@section('css')
    <!--Internal   Notify -->
    <link href="{{ URL::asset('/My/Dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الإجراءات</h4>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('Dashboard.messages_alert')
    <!-- row -->
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
                            إضافة إجراء جديد
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example2" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> أسم الإجراء</th>
                                    <th> سعر الإجراء</th>
                                    <th> حالة الإجراء</th>
                                    <th> وصف الإجراء</th>
                                    <th>تم إنشائه بواسطة</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $service)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $service->name }}</td>
                                        <td>{{ number_format($service->price) }} ريال </td>
                                        <td>
                                            <div
                                                class="dot-label bg-{{ $service->status == 1 ? 'success' : 'danger' }} ml-1">
                                            </div>
                                            {{ $service->status == 1 ? 'متوفر' : 'غير متوفر' }}
                                        </td>
                                        <td> {{ Str::limit($service->description, 50) }}</td>
                                        <td>
                                            {{ $service->create_by }}
                                        </td>
                                        <td>
                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                data-toggle="modal" href="#edit{{ $service->id }}"><i
                                                    class="las la-pen"></i></a>
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-toggle="modal" href="#delete{{ $service->id }}"><i
                                                    class="las la-trash"></i></a>
                                        </td>
                                    </tr>

                                    @include('Dashboard.Admin.Services.edit')
                                    @include('Dashboard.Admin.Services.delete')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        <!--/div-->

        @include('Dashboard.Admin.Services.add')
        <!-- /row -->

    </div>
    <!-- row closed -->

    <!-- Container closed -->

    <!-- main-content closed -->
@endsection
@section('js')
    <script src="{{ URL::asset('/My/Dashboard/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('/My/Dashboard/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
