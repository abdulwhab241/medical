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
    
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap" style="text-align:center;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>أسم المريض</th>
                                    <th>أسم الطبيب</th>
                                    <th>التشخيص</th>
                                    <th>الدواء</th>
                                    <th>تاريخ الزيارة</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Diagnostics as $Diagnostic)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $Diagnostic->Patient->name }}</td>

                                        <td>{{ $Diagnostic->Doctor->name }}</td>
                                        <td>{{ $Diagnostic->diagnosis }}</td>
                                        <td>
                                            {{ $Diagnostic->Medicine->name }}
                                        </td>

                                        <td>{{ $Diagnostic->date }}</td>

                                    </tr>

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
