@extends('layouts.master')
@section('title')
    قائمة تشخيصات المرضى
@stop
@section('css')
    <link href="{{ URL::asset('/My/Dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">قائمة تشخيصات المرضى</h4>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('Dashboard.messages_alert')
    <!-- row opened -->
    <div class="row row-sm">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>أسم المريض</th>
                                    <th>أسم الطبيب</th>
                                    <th>تاريخ الزيارة</th>
                                    <th>التشخيص</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Diagnostics as $Diagnostic)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $Diagnostic->Patient->name }}</td>
                                        <td>{{ $Diagnostic->Doctor->name }}</td>
                                        <td>{{ $Diagnostic->date }}</td>
                                        <td>{{ $Diagnostic->diagnosis }}</td>

                                        <td>
                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                            data-toggle="modal" href="#edit{{ $Diagnostic->id }}"><i
                                                class="las la-pen"></i> تعديل </a>

                                            {{-- <a class="modal-effect btn btn-sm btn-primary" data-effect="effect-scale"
                                                data-toggle="modal"
                                                href="{{ route('Diagnostics.edit', $Diagnostic->id) }}"><i class="fa fa-eye"
                                                    aria-hidden="true"></i>&nbsp;&nbsp; عرض البيانات </a> --}}
                                        </td>

                                    </tr>
                                    @include('Dashboard.Dashboard_Doctors.Diagnostics.edit')

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('/My/Dashboard/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('/My/Dashboard/plugins/notify/js/notifit-custom.js') }}"></script>




@endsection
