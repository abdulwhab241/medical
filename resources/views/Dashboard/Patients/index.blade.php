@extends('layouts.master')
@section('css')
    <link href="{{ URL::asset('/My/Dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المرضى</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة
                    المرضى</span>
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
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('Patients.create') }}" class="btn btn-primary">اضافة مريض جديد</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم المريض</th>
                                    <th>عمر المريض</th>
                                    <th>رقم الهاتف</th>
                                    <th>الجنس</th>
                                    <th>العنوان</th>
                                    <th>تاريخ الإضافة</th>
                                    <th>عرض معلومات المريض</th>
                                    <th>تم إضافتة بواسطة</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Patients as $Patient)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $Patient->name }}</td>
                                        <td>{{ $Patient->age }} سنة </td>
                                        <td>{{ $Patient->phone }}</td>
                                        <td>{{ $Patient->gender->name }}</td>
                                        <td>{{ $Patient->address }}</td>
                                        <td>{{ $Patient->date }}</td>
                                        <td style="font-weight: bolder;">
                                            <a href="{{ route('Patients.show', $Patient->id) }}">عرض </a>
                                        </td>
                                        <td>{{ $Patient->create_by }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                                    type="button">العمليات<i class="fas fa-caret-down mr-1"></i></button>

                                                <div class="dropdown-menu tx-13 text-center">
                                                    <a href="{{ route('Patients.edit', $Patient->id) }}"
                                                        class=" dropdown-item">تعديل
                                                    </a>
                                                    <button class=" dropdown-item" data-toggle="modal"
                                                        data-target="#Deleted{{ $Patient->id }}">حذف
                                                    </button>
                                                    <a href="{{ route('Patients.show', $Patient->id) }}"
                                                        class="dropdown-item">عرض بيانات المريض
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @include('Dashboard.Patients.Deleted')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- bd -->
            </div><!-- bd -->
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
