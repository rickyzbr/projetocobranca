<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>   

    <meta content="Admin Dashboard" name="description" />
    <meta content="Themesbrand" name="author" />

    <link rel="shortcut icon" href="{{url('dist/img/icon_company.ico')}}">

    	<!-- vector map CSS -->
        <link href="{{url('vendors/vectormap/jquery-jvectormap-2.0.3.css')}}" rel="stylesheet" type="text/css" />

        <!-- Toggles CSS -->
        <link href="{{url('vendors/jquery-toggles/css/toggles.css')}}" rel="stylesheet" type="text/css">
        <link href="{{url('vendors/jquery-toggles/css/themes/toggles-light.css')}}" rel="stylesheet" type="text/css">

          <!-- Data Table CSS -->
        <link href="{{url('vendors/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- Morris Charts CSS -->
        <link href="{{url('vendors/morris.js/morris.css')}}" rel="stylesheet" type="text/css" />

        <!-- Custom CSS -->
        <link href="{{url('dist/css/style.css')}}" rel="stylesheet" type="text/css">

        <!-- Toastr CSS -->
        <link href="{{url('vendors/jquery-toast-plugin/dist/jquery.toast.min.css')}}" rel="stylesheet" type="text/css">

        <!-- Pickr CSS -->
        <link href="{{url('vendors/pickr-widget/dist/pickr.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- Daterangepicker CSS -->
        <link href="{{url('vendors/daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css" />

        <!-- Calendar CSS -->
        <link href="{{url('vendors/fullcalendar/dist/fullcalendar.min.css')}}" rel="stylesheet" type="text/css" />


    
    </head>

    <body>
        <div class="hk-wrapper hk-vertical-nav">
            @include ('includes.top')
            @include ('includes.search')
            @include ('includes.navigation')
            @include ('includes.settings')
            <div class="hk-pg-wrapper">                
                @yield('content_header')
                <div class="container-fluid px-xxl-65 px-xl-20">
                @yield('content')
                </div>
            </div>
            @include ('includes.footer')
        </div>
            

        <script src="{{url('vendors/jquery/dist/jquery.min.js')}}"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="{{url('vendors/popper.js/dist/umd/popper.min.js')}}"></script>
        <script src="{{url('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>

        <!-- Slimscroll JavaScript -->
        <script src="{{url('dist/js/jquery.slimscroll.js')}}"></script>

        <!-- Fancy Dropdown JS -->
        <script src="{{url('dist/js/dropdown-bootstrap-extended.js')}}"></script>

        <!-- FeatherIcons JavaScript -->
        <script src="{{url('dist/js/feather.min.js')}}"></script>

        <!-- Toggles JavaScript -->
        <script src="{{url('vendors/jquery-toggles/toggles.min.js')}}"></script>
        <script src="{{url('dist/js/toggle-data.js')}}"></script>

        <!-- Morris Charts JavaScript -->
        <script src="{{url('vendors/raphael/raphael.min.js')}}"></script>
        <script src="{{url('vendors/morris.js/morris.min.js')}}"></script>

        <!-- Counter Animation JavaScript -->
        <script src="{{url('vendors/waypoints/lib/jquery.waypoints.min.js')}}"></script>
        <script src="{{url('vendors/jquery.counterup/jquery.counterup.min.js')}}"></script>

        <!-- EChartJS JavaScript -->
        <script src="{{url('vendors/echarts/dist/echarts-en.min.js')}}"></script>

        <!-- Sparkline JavaScript -->
        <script src="{{url('vendors/jquery.sparkline/dist/jquery.sparkline.min.js')}}"></script>

        <!-- Vector Maps JavaScript -->
        <script src="{{url('vendors/vectormap/jquery-jvectormap-2.0.3.min.js')}}"></script>
        <script src="{{url('vendors/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
        <script src="{{url('dist/js/vectormap-data.js')}}"></script>

        <!-- Owl JavaScript -->
        <script src="{{url('vendors/owl.carousel/dist/owl.carousel.min.js')}}"></script>

        <!-- Init JavaScript -->
        <script src="{{url('dist/js/init.js')}}"></script>

        <!-- Toastr JS -->
        <script src="{{url('vendors/jquery-toast-plugin/dist/jquery.toast.min.js')}}"></script>
        
@yield('scripts')
    </body>
</html>