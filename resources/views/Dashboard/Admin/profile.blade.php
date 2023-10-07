@extends('layouts.master')
@section('css')
    <link href="{{ URL::asset('/My/Dashboard/plugins/morris.js/morris.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/My/Dashboard/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الملف الشخصي</h4>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="card-body">

        <!-- row opened -->
        <div class="row row-sm">

            <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="card text-center">
                    <div>
                        @if ($Users->image)
                            <img src="{{ Url::asset('/My/Dashboard/img/Users/' . $Users->image->filename) }}"
                                class="card-img-top w-100" alt="{{ $Users->name }}">
                        @else
                            <img src="{{ URL::asset('/My/Dashboard/img/photos/8.jpg') }}" class="card-img-top w-100"
                                alt="">
                        @endif
                    </div>
                    <div class="card-body">

                        <div class="row row-xs mg-b-20">
                            <div class="col-md-4">
                                <label>
                                    أسم المستخدم</label>
                            </div>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                <input class="form-control" readonly type="text"
                                    style="font-weight: bolder; color: black; font-size: 18px; text-align: center"
                                    value="{{ $Users->name }}">
                            </div>
                        </div>

                        <div class="row row-xs mg-b-20">
                            <div class="col-md-4">
                                <label>
                                    رقم الهاتف</label>
                            </div>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                <input class="form-control" readonly type="text"
                                    style="font-weight: bolder; color: black; font-size: 18px; text-align: center"
                                    value="{{ $Users->phone }}">
                            </div>
                        </div>

                        <div class="row row-xs mg-b-20">
                            <div class="col-md-4">
                                <label>
                                    الوظيفة</label>
                            </div>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                <input class="form-control" readonly type="text"
                                    style="font-weight: bolder; color: black; font-size: 18px; text-align: center"
                                    value="{{ $Users->job }}">
                            </div>
                        </div>

                        <div class="row row-xs mg-b-20">
                            <div class="col-md-4">
                                <label>
                                    العنوان</label>
                            </div>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                <textarea class="form-control" readonly style="font-weight: bolder; color: black; font-size: 18px; text-align: center"
                                    rows="1">{{ $Users->address }}</textarea>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="card text-center">
                    <form action="{{ route('Admin_Profile.update', 'test') }}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <img class="card-img-top w-100" id="output" />
                        <div class="card-body">
                            <h4 class="card-title mb-3">تعديل البيانات</h4>

                            <div class="row row-xs mg-b-20">
                                <div class="col-md-4">
                                    <label>
                                        رقم الهاتف</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                                    <input class="form-control" required name="phone" type="number" autofocus>

                                </div>
                            </div>

                            <div class="row row-xs mg-b-20">
                                <div class="col-md-4">
                                    <label>
                                        العنوان</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <textarea class="form-control" required name="address" rows="1"></textarea>

                                </div>
                            </div>

                            <div class="row row-xs mg-b-20">
                                <div class="col-md-4">
                                    <label>
                                        كلمة المرور</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" required name="password" type="password">
                                </div>
                            </div><br>

                            <div class="row row-xs mg-b-20">
                                <div class="col-md-4">
                                    <label>
                                        صورة المستخدم</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input type="file" accept="image/*" name="photo" onchange="loadFile(event)">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">تعديل
                                البيانات</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- row closed -->
    </div>
    <!-- Container closed -->

@endsection
@section('js')
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
@endsection
