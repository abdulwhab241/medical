@extends('layouts.master')
@section('title')
    تفاصيل الأشعة
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
                <h4 class="content-title mb-0 my-auto">تفاصيل الأشعة</h4>
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
                            إضافة أشعة جديدة
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example2" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> أسم الأشعة</th>
                                    <th> سعر الأشعة</th>
                                    <th> حالة الأشعة</th>
                                    <th> وصف الأشعة</th>
                                    <th>تم إنشائه بواسطة</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Rays as $Ray)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $Ray->name }}</td>
                                        <td>{{ number_format($Ray->price) }} ريال </td>
                                        <td>
                                            <div class="dot-label bg-{{ $Ray->status == 1 ? 'success' : 'danger' }} ml-1">
                                            </div>
                                            {{ $Ray->status == 1 ? 'متوفر' : 'غير متوفر' }}
                                        </td>
                                        <td> {{ Str::limit($Ray->description, 50) }}</td>
                                        <td>
                                            {{ $Ray->create_by }}
                                        </td>
                                        <td>
                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                data-toggle="modal" href="#edit{{ $Ray->id }}"><i
                                                    class="las la-pen"></i></a>
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-toggle="modal" href="#delete{{ $Ray->id }}"><i
                                                    class="las la-trash"></i></a>
                                        </td>
                                    </tr>

                                    @include('Dashboard.Admin.Ray_Services.edit')
                                    @include('Dashboard.Admin.Ray_Services.delete')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        <!--/div-->

        @include('Dashboard.Admin.Ray_Services.add')
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
