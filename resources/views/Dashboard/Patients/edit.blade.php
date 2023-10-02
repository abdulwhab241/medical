@extends('layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{ URL::asset('/My/Dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('title')
    تعديل بيانات مريض
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المرضي</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل بيانات
                    مريض</span>
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
                <div class="card-body">
                    <form action="{{ route('Patients.update', 'test') }}" method="post" autocomplete="off">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <label>اسم المريض الرباعي</label>
                                <input type="text" name="Name" value="{{ $Patient->name }}"
                                    class="form-control @error('name') is-invalid @enderror " required>
                                <input type="hidden" name="id" value="{{ $Patient->id }}">
                            </div>


                            <div class="col-md-4">
                                <label>عمر المريض</label>
                                <input class="form-control" value="{{ $Patient->age }}" name="Age" type="number"
                                    required>
                            </div>

                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-4">
                                <label>رقم الهاتف</label>
                                <input type="number" name="Phone" value="{{ $Patient->phone }}"
                                    class="form-control @error('Phone') is-invalid @enderror" required>
                            </div>

                            <div class="col-md-4">
                                <label>الجنس</label>
                                <select class="form-control" name="Gender" required>
                                    <option value="{{ $Patient->gender_id }}">{{ $Patient->gender->name }}</option>
                                    @foreach ($Genders as $Gender)
                                        <option value="{{ $Gender->id }}">{{ $Gender->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label>العنوان</label>
                                <textarea rows="2" cols="3" class="form-control" name="Address">{{ $Patient->address }}</textarea>
                            </div>
                        </div>
                        <br>

                        <div class="modal-footer">
                            <button class="btn btn-success btn-block">تعديل البيانات</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('/My/Dashboard/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>
    <script src="{{ URL::asset('/My/Dashboard/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('/My/Dashboard/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
