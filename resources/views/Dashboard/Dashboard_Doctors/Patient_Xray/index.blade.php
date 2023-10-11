@extends('layouts.master')
@section('title')
    قائمة طلبات الأشعة للمرضى
@stop
@section('css')
    <link href="{{ URL::asset('/My/Dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">قائمة طلبات الأشعة للمرضى</h4>
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
                                    <th>الطلب</th>
                                    <th>الشرح</th>
                                    <th>تاريخ الطلب</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($PatientRays as $PatientRay)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $PatientRay->Patient->name }}</td>
                                        <td>{{ $PatientRay->Ray->name }}</td>
                                        <td>{{ $PatientRay->description }}</td>
                                        <td>{{ $PatientRay->date }}</td>

                                        <td>
                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                data-toggle="modal" href="#edit_PatientRay{{ $PatientRay->id }}"><i
                                                    class="las la-pen"></i> تعديل </a>
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-toggle="modal" href="#delet_patient_ray{{ $PatientRay->id }}"><i
                                                    class="las la-trash"></i> حذف </a>
                                        </td>

                                    </tr>
                                    @include('Dashboard.Dashboard_Doctors.Patient_Xray.edit')
                                    @include('Dashboard.Dashboard_Doctors.Patient_Xray.delete')
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
