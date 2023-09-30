@extends('Dashboard.layouts.master2')
@section('css')
    <style>
        .panel {
            display: none;
        }
    </style>


    <!-- Sidemenu-respoansive-tabs css -->
    <link href="{{ URL::asset('/My/Dashboard/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css') }}"
        rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row no-gutter">
            <!-- The image half -->
            <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
                <div class="row wd-100p mx-auto text-center">
                    <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                        <img src="{{ URL::asset('/My/Dashboard/img/media/login.png') }}"
                            class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
                    </div>
                </div>
            </div>
            <!-- The content half -->
            <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
                <div class="login d-flex align-items-center py-2">
                    <!-- Demo content-->
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                                <div class="card-sigin">
                                    <div class="mb-5 d-flex"> <a href="{{ url('/' . ($page = 'index')) }}"><img
                                                src="{{ URL::asset('/My/Dashboard/img/brand/favicon.png') }}"
                                                class="sign-favicon ht-40" alt="logo"></a>
                                        <h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Va<span>le</span>x</h1>
                                    </div>
                                    <div class="card-sigin">
                                        <div class="main-signup-header">
                                            <h2>مرحباً بـك في مركز رواد القلب</h2>
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">حدد طريقة الدخول</label>
                                                <select class="form-control" id="sectionChooser">
                                                    <option value="" selected disabled>اختر من القائمة</option>
                                                    <option value="user">محاسب</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="doctor"> دكتور</option>
                                                    <option value="ray_employee">موظف اشعة</option>
                                                    <option value="laboratorie_employee">موظف مختبر</option>
                                                </select>
                                            </div>

                                            <!-- form admin -->
                                            <div class="panel" id="admin">
                                                <h2>دخول ادمن</h2>
                                                <form method="POST" action="{{ route('login.Admin') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>الاسم</label> <input class="form-control"
                                                            placeholder="ادخل الاسم" type="text" name="name"
                                                            :value="old('name')" required autofocus>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>كلمة المرور</label> <input class="form-control"
                                                            placeholder="ادخل كلمة المرور" type="password"name="password"
                                                            required autocomplete="current-password">
                                                    </div><button type="submit"
                                                        class="btn btn-main-primary btn-block">دخول</button>

                                                </form>

                                            </div>
                                            {{-- <!-- form patient -->
                                            <div class="panel" id="patient">
                                                <h2>دخول مريض</h2>
                                                <form method="POST" action="{{ route('login.patient') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>أسم المريض</label> <input class="form-control"
                                                            placeholder="ادخل اسم المريض" type="text" name="Name"
                                                            :value="old('email')" required autofocus>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>كلمة المرور</label> <input class="form-control"
                                                            placeholder="كلمة المرور" type="password"name="password"
                                                            required autocomplete="current-password">
                                                    </div><button type="submit"
                                                        class="btn btn-main-primary btn-block">دخول</button>

                                                </form>

                                            </div>

                                            <!-- form admin -->
                                            <div class="panel" id="admin">
                                                <h2>دخول ادمن</h2>
                                                <form method="POST" action="{{ route('login.admin') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>الاسم</label> <input class="form-control"
                                                            placeholder="ادخل الاسم" type="text" name="Name"
                                                            :value="old('Name')" required autofocus>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>كلمة المرور</label> <input class="form-control"
                                                            placeholder="ادخل كلمة المرور" type="password"name="password"
                                                            required autocomplete="current-password">
                                                    </div><button type="submit"
                                                        class="btn btn-main-primary btn-block">دخول</button>

                                                </form>

                                            </div>

                                            <!-- form Doctor -->
                                            <div class="panel" id="doctor">
                                                <h2>دخول دكتور</h2>
                                                <form method="POST" action="{{ route('login.doctor') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>أسم الطبيب</label> <input class="form-control"
                                                            placeholder="ادخل اسم الطبيب" type="text" name="Name"
                                                            :value="old('Name')" required autofocus>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>كلمة المرور</label> <input class="form-control"
                                                            placeholder="ادخل كلمة المرور" type="password"name="password"
                                                            required autocomplete="current-password">
                                                    </div><button type="submit"
                                                        class="btn btn-main-primary btn-block">دخول</button>

                                                </form>

                                            </div>

                                            <!-- form RayEmployee -->
                                            <div class="panel" id="ray_employee">
                                                <h2>دخول موظف اشعة</h2>
                                                <form method="POST" action="{{ route('login.ray_employee') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>أسم الموظف</label> <input class="form-control"
                                                            placeholder="ادخل اسم الموظف" type="text" name="Name"
                                                            :value="old('Name')" required autofocus>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>كلمة المرور</label> <input class="form-control"
                                                            placeholder="ادخل كلمة المرور" type="password"name="password"
                                                            required autocomplete="current-password">
                                                    </div><button type="submit"
                                                        class="btn btn-main-primary btn-block">دخول</button>

                                                </form>

                                            </div>

                                            <!-- form laboratorie_employee -->
                                            <div class="panel" id="laboratorie_employee">
                                                <h2>دخول موظف مختبر</h2>
                                                <form method="POST" action="{{ route('login.laboratorie_employee') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>أسم الموظف</label> <input class="form-control"
                                                            placeholder="ادخل اسم الموظف" type="text" name="Name"
                                                            :value="old('Name')" required autofocus>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>كلمة المرور</label> <input class="form-control"
                                                            placeholder="ادخل كلمة المرور" type="password"name="password"
                                                            required autocomplete="current-password">
                                                    </div><button type="submit"
                                                        class="btn btn-main-primary btn-block">دخول</button>

                                                </form>

                                            </div>

                                            <!-- form user -->
                                            <div class="panel" id="user">
                                                <h2>دخول محاسب</h2>
                                                <form method="POST" action="{{ route('login.user') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>أسم الموظف</label> <input class="form-control"
                                                            placeholder="ادخل اسم الموظف" type="text" name="Name"
                                                            :value="old('Name')" required autofocus>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>كلمة المرور</label> <input class="form-control"
                                                            placeholder="ادخل كلمة المرور" type="password"name="password"
                                                            required autocomplete="current-password">
                                                    </div><button type="submit"
                                                        class="btn btn-main-primary btn-block">دخول</button>

                                                </form>

                                            </div> --}}

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End -->
                </div>
            </div><!-- End -->
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#sectionChooser').change(function() {
            var myID = $(this).val();
            $('.panel').each(function() {
                myID === $(this).attr('id') ? $(this).show() : $(this).hide();
            });
        });
    </script>
@endsection
