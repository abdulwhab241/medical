@extends('layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{ URL::asset('/My/Dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('title')
    الأدوية
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الأدوية</h4>
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
                <div class="card-header">

                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('Medicine.create') }}"  style="margin: 6px;" class="btn btn-primary">إضافة دواء جديدة</a>
                        </div>

                        <div class="col-md-6">

                            <a href="{{ route('Print_Medicine') }}" class="btn btn-info"  style="margin: 6px;"
                                >طباعة الأدوية</a>
                        </div>
                    </div>


                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap text-center" id="example1" style="text-algin: center;">
                            <thead>
                                <tr class="table-secondary">
                                    <th>#</th>
                                    <th>كود الدواء</th>
                                    <th>أسم الدواء</th>
                                    <th>أسم المورد</th>
                                    <th>الكمية </th>
                                    <th>الوحدة</th>
                                    <th>سعر الشراء</th>
                                    <th>سعر البيع</th>
                                    <th>الإجمالي</th>
                                    <th>المحاسب</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Medicines as $Medicine)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $Medicine->bar_code }}</td>
                                        <td>{{ $Medicine->name }}</td>
                                        <td>{{ $Medicine->supplier }}</td>
                                        <td>{{ $Medicine->quantity }}</td>
                                        <td>{{ $Medicine->unit }}</td>

                                        <td>{{ number_format($Medicine->buy_price) }} </td>
                                        <td>{{ number_format($Medicine->sale_price) }} </td>

                                        <td>{{ number_format($Medicine->total) }} </td>
                                        <td>{{ $Medicine->create_by }}</td>
                                        <td>
                                            <a href="{{ route('Medicine.edit', $Medicine->id) }}" style="margin: 3px;"
                                                class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>

                                            <button class="btn btn-sm btn-danger" data-toggle="modal" style="margin: 3px;"
                                                data-target="#Deleted{{ $Medicine->id }}"><i class="fas fa-trash"></i>
                                            </button>

                                        </td>
                                        @include('Dashboard.Admin.Medicines.Deleted')
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
