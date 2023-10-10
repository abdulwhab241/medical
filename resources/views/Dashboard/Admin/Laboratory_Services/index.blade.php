@extends('layouts.master')
@section('title')
    تفاصيل الفحوصات
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
                <h4 class="content-title mb-0 my-auto">تفاصيل الفحوصات</h4>
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
                            إضافة فحص جديد
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example2" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> أسم الفحص</th>
                                    <th> سعر الفحص</th>
                                    <th> حالة الفحص</th>
                                    <th> وصف الفحص</th>
                                    <th>تم إنشائه بواسطة</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($LaboratoryServices as $LaboratoryService)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $LaboratoryService->name }}</td>
                                        <td>{{ number_format($LaboratoryService->price) }} ريال </td>
                                        <td>
                                            <div
                                                class="dot-label bg-{{ $LaboratoryService->status == 1 ? 'success' : 'danger' }} ml-1">
                                            </div>
                                            {{ $LaboratoryService->status == 1 ? 'متوفر' : 'غير متوفر' }}
                                        </td>
                                        <td> {{ Str::limit($LaboratoryService->description, 50) }}</td>
                                        <td>
                                            {{ $LaboratoryService->create_by }}
                                        </td>
                                        <td>
                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                data-toggle="modal" href="#edit{{ $LaboratoryService->id }}"><i
                                                    class="las la-pen"></i></a>
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-toggle="modal" href="#delete{{ $LaboratoryService->id }}"><i
                                                    class="las la-trash"></i></a>
                                        </td>
                                    </tr>

                                    @include('Dashboard.Admin.Laboratory_Services.edit')
                                    @include('Dashboard.Admin.Laboratory_Services.delete')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        <!--/div-->

        @include('Dashboard.Admin.Laboratory_Services.add')
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
