@extends('layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{ URL::asset('/My/Dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('title')
    تعديل دواء
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> تعديل دواء
                </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    الأدوية</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('Medicine.update', 'test') }}" method="post">
                        @method('PUT')
                        @csrf

                        <div class="row">

                            <div class="col-md-6">
                                <label>كود الدواء</label>
                                <input type="hidden" name="id" value="{{ $Medicine->id }}">

                                <input type="text" dir="ltr" name="Bar_Code" required
                                    value="{{ $Medicine->bar_code }}" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label>أسم الدواء</label>
                                <input type="text" dir="ltr" name="Name" required value="{{ $Medicine->name }}"
                                    class="form-control">

                            </div>




                        </div>

                        <br>

                        <div class="row">

                            <div class="col-md-4">
                                <label>أسم المورد</label>
                                <input type="text" name="Supplier" required value="{{ $Medicine->supplier }}"
                                    class="form-control">

                            </div>


                            <div class="col-md-4">
                                <label>الوحدة</label>
                                <select name="Unit" class="form-control SlectBox">
                                    <option> {{ $Medicine->unit }} </option>
                                    <option value="باكت">باكت</option>
                                    <option value="علبة">علبة</option>
                                    <option value="قلم">قلم</option>

                                </select>
                            </div>

                            <div class="col-md-4">
                                <label>الكمية</label>
                                <input type="number" name="Quantity" value="{{ $Medicine->quantity }}"
                                    class="form-control">
                            </div>



                        </div><br>

                        <div class="row">

                            <div class="col-md-4">
                                <label>سعر الشراء</label>
                                <input type="number" name="Buy_Price" required value="{{ $Medicine->buy_price }}"
                                    class="form-control">

                            </div>

                            <div class="col-md-4">
                                <label>سعر البيع</label>
                                <input type="number" name="Sale_Price" required value="{{ $Medicine->sale_price }}"
                                    class="form-control">

                            </div>

                            <div class="col-md-4">
                                <label>تاريخ إنتهاء الدواء</label>

                                <input type="text" name="End_Date" class="form-control fc-datepicker"
                                    placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd"
                                    value="{{ $Medicine->end_date }}">
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
