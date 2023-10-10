@extends('layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{ URL::asset('/My/Dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('title')
    ادوية المرضى
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">ادوية المرضى</h4>
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
                {{-- <div class="card-header">
                    <a href="{{ route('CashPatientMedicines.create') }}" class="btn btn-primary">إضافة فاتورة جديدة</a>
                </div> --}}
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap text-center" id="example1" style="text-algin: center;">
                            <thead>
                                <tr class="table-secondary">
                                    <th>#</th>
                                    <th>أسم المريض</th>
                                    <th>أسم الطبيب </th>
                                    <th> أسم الدواء </th>
                                    <th> الجرعة </th>
                                    <th> وقت الجرعة </th>
                                    <th> الفترة </th>
                                    <th>التاريخ</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($PatientMedicines as $PatientMedicine)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $PatientMedicine->Patient->name }}</td>
                                        <td>{{ $PatientMedicine->Doctor->name }}</td>
                                        <td>{{ $PatientMedicine->Medicine->name }}</td>
                                        <td>{{ $PatientMedicine->dosage }}</td>
                                        <td>{{ $PatientMedicine->use }}</td>
                                        <td>{{ $PatientMedicine->period }}</td>
                                        <td>{{ $PatientMedicine->date }}</td>

                                        <td>
                                            <a href="{{ route('Patient_Medicines.edit', $PatientMedicine->id) }}" style="margin: 3px;"
                                                class="btn btn-sm btn-success"><i class="fas fa-edit"></i> تعديل </a>
                                            {{-- <a href="{{ route('Patient_Medicines.show', $PatientMedicine->id) }}" style="margin: 3px;"
                                                class="btn btn-sm btn-primary"><i class="fas fa-print"></i></a>
                                            <button class="btn btn-sm btn-danger" data-toggle="modal" style="margin: 3px;"
                                                data-target="#Deleted{{ $PatientMedicine->id }}"><i class="fas fa-trash"></i>
                                            </button> --}}
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                            data-toggle="modal" href="#delete{{ $PatientMedicine->id }}"><i
                                                class="las la-trash"></i> حذف </a>

                                        </td>
                                        @include('Dashboard.Dashboard_Doctors.Patient_Medicines.delete')
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
