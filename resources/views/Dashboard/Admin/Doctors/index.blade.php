@extends('layouts.master')
@section('title')
    الاطباء
@stop
@section('css')
    <link href="{{ URL::asset('/My/Dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاطباء</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    قائمة الاطباء</span>
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
                <div class="card-header pb-0">

                    <a href="{{ route('Doctors.create') }}" class="btn btn-primary" role="button" aria-pressed="true">إضافة
                        طبيب</a>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap" style="text-align:center;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>أسم الطبيب</th>
                                    <th>صورة الطبيب</th>
                                    <th>القسم</th>
                                    <th>رقم هاتف الطبيب</th>
                                    <th>ايام دوام الطبيب</th>
                                    <th>الحاله</th>
                                    <th>تاريخ الإضافة</th>
                                    <th>تم إضافة الطبيب بواسطة</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($doctors as $doctor)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $doctor->name }}</td>
                                        <td>
                                            @if ($doctor->image)
                                                <img src="{{ asset('/My/Dashboard/img/doctors/' . $doctor->image->filename) }}"
                                                    height="50px" width="50px" alt="{{ $doctor->name }}">
                                            @else
                                                <img src="{{ Url::asset('/My/Dashboard/img/doctor_default.png') }}"
                                                    height="50px" width="50px" alt="">
                                            @endif
                                        </td>
                                        <td>{{ $doctor->section->name }}</td>
                                        <td>{{ $doctor->phone }}</td>
                                        <td>
                                            {{ $doctor->day }}
                                        </td>
                                        <td>
                                            <div
                                                class="dot-label bg-{{ $doctor->status == 1 ? 'success' : 'danger' }} ml-1">
                                            </div>
                                            {{ $doctor->status == 1 ? 'متوفر' : 'غير متوفر' }}
                                        </td>

                                        <td>{{ $doctor->date }}</td>
                                        <td>{{ $doctor->create_by }}</td>
                                        <td>

                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                                    type="button">العمليات<i class="fas fa-caret-down mr-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    <a class="dropdown-item"
                                                        href="{{ route('Doctors.edit', $doctor->id) }}"><i
                                                            style="color: #0ba360"
                                                            class="text-success ti-user"></i>&nbsp;&nbsp;تعديل البيانات</a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#update_password{{ $doctor->id }}"><i
                                                            class="text-primary ti-key"></i>&nbsp;&nbsp;تغير كلمة المرور</a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#update_status{{ $doctor->id }}"><i
                                                            class="text-warning ti-back-right"></i>&nbsp;&nbsp;تغير
                                                        الحالة</a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#delete{{ $doctor->id }}"><i
                                                            class="text-danger  ti-trash"></i>&nbsp;&nbsp;حذف الطبيب</a>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    @include('Dashboard.Admin.Doctors.delete')
                                    {{-- @include('Dashboard.Doctors.delete_select') --}}
                                    @include('Dashboard.Admin.Doctors.update_password')
                                    @include('Dashboard.Admin.Doctors.update_status')
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

    <script>
        $(function() {
            jQuery("[name=select_all]").click(function(source) {
                checkboxes = jQuery("[name=delete_select]");
                for (var i in checkboxes) {
                    checkboxes[i].checked = source.target.checked;
                }
            });
        })
    </script>


    <script type="text/javascript">
        $(function() {
            $("#btn_delete_all").click(function() {
                var selected = [];
                $("#example input[name=delete_select]:checked").each(function() {
                    selected.push(this.value);
                });

                if (selected.length > 0) {
                    $('#delete_select').modal('show')
                    $('input[id="delete_select_id"]').val(selected);
                }
            });
        });
    </script>



@endsection
