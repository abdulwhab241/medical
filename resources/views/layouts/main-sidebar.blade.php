<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active"><img src="{{ URL::asset('/My/Dashboard/img/brand/logo.png') }}"
                class="main-logo" alt="logo"></a>
        <a class="desktop-logo logo-dark active"><img src="{{ URL::asset('/My/Dashboard/img/brand/logo-white.png') }}"
                class="main-logo dark-theme" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active"><img
                src="{{ URL::asset('/My/Dashboard/img/brand/favicon.png') }}" class="logo-icon" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-dark active"><img
                src="{{ URL::asset('/My/Dashboard/img/brand/favicon-white.png') }}" class="logo-icon dark-theme"
                alt="logo"></a>
    </div>


    @if (Auth::user()->job == 'admin')
        @include('layouts.main-sidebar.admin-sidebar-main')
    @endif


    @if (Auth::user()->job == 'دكتور')
        @include('layouts.main-sidebar.doctor-sidebar-main')
    @endif


    @if (Auth::user()->job == 'الأشعة')
        @include('layouts.main-sidebar.ray_employee-sidebar-main')
    @endif


    @if (Auth::user()->job == 'المختبر')
        @include('layouts.main-sidebar.laboratorie_employee-sidebar-main')
    @endif


    @if (auth('patient')->check())
        @include('layouts.main-sidebar.patient-sidebar-main')
    @endif

</aside>
<!-- main-sidebar -->
