<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/backend/imgs/favicon-32x32.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('assets/backend/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/backend/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('assets/backend/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/backend/js/pace.min.js') }}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/backend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/backend/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/backend/css/icons.css') }}" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/backend/css/dark-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/backend/css/semi-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/backend/css/header-colors.css') }}" />
    {{--    JQuery--}}
    <script src="{{ asset('assets/backend/js/jquery.min.js') }}"></script>
    {{--    Toaster --}}
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src='https://cdn.tiny.cloud/1/vdqx2klew412up5bcbpwivg1th6nrh3murc6maz8bukgos4v/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
    <title>Rukada - Responsive Bootstrap 5 admin Template</title>
</head>

<body>
<!--wrapper-->
<div class="wrapper">
    <!--sidebar wrapper -->
    @include('admin.layouts.sidebar')
    <!--end sidebar wrapper -->
    <!--start header -->
    @include('admin.layouts.header')
    <!--end header -->
    @yield('content')
    <!--start overlay-->
    <div class="overlay toggle-icon"></div>
    <!--end overlay-->
    <!--Start Back To Top Button-->
    <a href="javaScript:" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->
    @include('admin.layouts.footer')

</div>
<!--end wrapper-->
<!-- Bootstrap JS -->
<script src="{{ asset('assets/backend/js/bootstrap.bundle.min.js') }}"></script>
<!--plugins-->
<script src="{{ asset('assets/backend/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/metismenu/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/chartjs/js/Chart.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/sparkline-charts/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/jquery-knob/excanvas.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/jquery-knob/jquery.knob.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/sweet-alert.js.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/input-tags/js/tagsinput.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
<script>
    $(function() {
        $(".knob").knob();
    });
</script>
<script src="{{ asset('assets/backend/js/index.js') }}"></script>
<!--app JS-->
<script src="{{ asset('assets/backend/js/app.js') }}"></script>

<script>
    @if(Session::has('message'))
    let type = "{{ Session::get('alert-type','info') }}"
    switch(type){
        case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;

        case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;

        case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;

        case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
    }
    @endif
</script>

<script>

    tinymce.init({
        selector: '#mytextarea'
    });
</script>

</body>
</html>
