@extends('layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{ URL::asset('/My/Dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('title')
    إضافة ادوية جديدة
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">إضافة ادوية جديدة</h4>
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
                    <form action="{{ route('Medicine.store') }}" method="post" autocomplete="off">
                        @csrf
                        
                        <div class="row">

                            <div class="col-md-6">
                                <label>كود الدواء</label>
                                <input type="text" dir="ltr" name="Bar_Code" value="{{ old('Bar_Code') }}" class="form-control">
                                @error('Bar_Code')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label>أسم الدواء</label>
                                <input type="text" dir="ltr" name="Name" value="{{ old('Name') }}"
                                    class="form-control">
                                @error('Name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>




                        </div>

                        <br>

                        <div class="row">

                            <div class="col-md-4">
                                <label>أسم المورد</label>
                                <input type="text" name="Supplier" value="{{ old('Supplier') }}" class="form-control">
                                @error('Supplier')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="col-md-4">
                                <label>الوحدة</label>
                                <select name="Unit" class="form-control SlectBox">
                                    {{-- <option value="1" selected >-- إختر من القائمة --</option> --}}
                                    <option value="باكت">باكت</option>
                                    <option value="علبة">علبة</option>
                                    <option value="قلم">قلم</option>

                                </select>
                                @error('Unit')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label>الكمية</label>
                                <input type="number" name="Quantity" value="{{ old('Quantity') }}" class="form-control">
                                @error('Quantity')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>



                        </div><br>

                        <div class="row">

                            <div class="col-md-4">
                                <label>سعر الشراء</label>
                                <input type="number" name="Buy_Price" value="{{ old('Buy_Price') }}" class="form-control">
                                @error('Buy_Price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label>سعر البيع</label>
                                <input type="number" name="Sale_Price" value="{{ old('Sale_Price') }}"
                                    class="form-control">
                                @error('Sale_Price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label>تاريخ إنتهاء الدواء</label>

                                <input type="text"  name="End_Date" class="form-control fc-datepicker"
                                    placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd" value="{{ old('End_Date') }}">
                                @error('End_Date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                        </div>
                        <br>

                        {{-- LANTUS-SOLOSTAR FLEX PEN 300IU 3ML 5 PCS --}}

                        <div class="modal-footer">
                            <button class="btn btn-success btn-block">حفظ البيانات</button>
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
    <script src="{{URL::asset('/My/Dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/My/Dashboard/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection
