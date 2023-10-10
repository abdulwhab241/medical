@extends('layouts.master')
@section('title')
    تفاصيل العمليات الجراحية
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
                <h4 class="content-title mb-0 my-auto">تفاصيل العمليات الجراحية</h4>
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
                            إضافة عملية جديدة
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example2" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> أسم العملية</th>
                                    <th> سعر العملية</th>
                                    <th> حالة العملية</th>
                                    <th> وصف العملية</th>
                                    <th>تم إنشائه بواسطة</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Surgeries as $Surgery)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $Surgery->name }}</td>
                                        <td>{{ number_format($Surgery->price) }} ريال </td>
                                        <td>
                                            <div
                                                class="dot-label bg-{{ $Surgery->status == 1 ? 'success' : 'danger' }} ml-1">
                                            </div>
                                            {{ $Surgery->status == 1 ? 'متوفر' : 'غير متوفر' }}
                                        </td>
                                        <td> {{ Str::limit($Surgery->description, 50) }}</td>
                                        <td>
                                            {{ $Surgery->create_by }}
                                        </td>
                                        <td>
                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                data-toggle="modal" href="#edit{{ $Surgery->id }}"><i
                                                    class="las la-pen"></i></a>
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-toggle="modal" href="#delete{{ $Surgery->id }}"><i
                                                    class="las la-trash"></i></a>
                                        </td>
                                    </tr>

                                    @include('Dashboard.Admin.Surgery_Services.edit')
                                    @include('Dashboard.Admin.Surgery_Services.delete')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        <!--/div-->

        @include('Dashboard.Admin.Surgery_Services.add')
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
