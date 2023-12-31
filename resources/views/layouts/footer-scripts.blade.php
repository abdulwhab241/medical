<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>
<!-- JQuery min js -->
<script src="{{URL::asset('/My/Dashboard/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap Bundle js -->
<script src="{{URL::asset('/My/Dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Ionicons js -->
<script src="{{URL::asset('/My/Dashboard/plugins/ionicons/ionicons.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('/My/Dashboard/plugins/moment/moment.js')}}"></script>

<!-- Rating js-->
<script src="{{URL::asset('/My/Dashboard/plugins/rating/jquery.rating-stars.js')}}"></script>
<script src="{{URL::asset('/My/Dashboard/plugins/rating/jquery.barrating.js')}}"></script>

<!--Internal  Perfect-scrollbar js -->
<script src="{{URL::asset('/My/Dashboard/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{URL::asset('/My/Dashboard/plugins/perfect-scrollbar/p-scroll.js')}}"></script>
<!--Internal Sparkline js -->
<script src="{{URL::asset('/My/Dashboard/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<!-- Custom Scroll bar Js-->
<script src="{{URL::asset('/My/Dashboard/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- right-sidebar js -->
<script src="{{URL::asset('/My/Dashboard/plugins/sidebar/sidebar-rtl.js')}}"></script>
<script src="{{URL::asset('/My/Dashboard/plugins/sidebar/sidebar-custom.js')}}"></script>
<!-- Eva-icons js -->
<script src="{{URL::asset('/My/Dashboard/js/eva-icons.min.js')}}"></script>
@yield('js')
<!-- Sticky js -->
<script src="{{URL::asset('/My/Dashboard/js/sticky.js')}}"></script>
<!-- custom js -->
<script src="{{URL::asset('/My/Dashboard/js/custom.js')}}"></script><!-- Left-menu js-->
<script src="{{URL::asset('/My/Dashboard/plugins/side-menu/sidemenu.js')}}"></script>


<script>
    $(document).ready(function() {
        $('#example1').DataTable();
    } );
</script>

    <!-- Get Prices for Services -->
    <script>
        $(document).ready(function () {
            $('select[name="Doctor_id"]').on('change', function () {
                var Doctor_id = $(this).val();
                if (Doctor_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_prices') }}/" + Doctor_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="price"]').empty();
                            $('select[name="price"]').append('<option selected disabled >{{'اختيار من القائمة...'}}...</option>');
                            $.each(data, function (key, value) {
                                $('select[name="price"]').append('<option value="' + value + '">' + value + '</option>');
                            });
                        },
                    });
                }
                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>


<!-- Internal Data tables -->
<script src="{{URL::asset('/My/Dashboard/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('/My/Dashboard/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('/My/Dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('/My/Dashboard/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('/My/Dashboard/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('/My/Dashboard/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('/My/Dashboard/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('/My/Dashboard/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('/My/Dashboard/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('/My/Dashboard/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('/My/Dashboard/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('/My/Dashboard/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('/My/Dashboard/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('/My/Dashboard/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('/My/Dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('/My/Dashboard/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('/My/Dashboard/js/table-data.js')}}"></script>


@livewireScripts
