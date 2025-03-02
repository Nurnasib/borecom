<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Amadr Dokan</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('/')}}AdminAssets/backend/dist/js/toastr/toastr.min.css ">
    <!-- Icofont Icons-->
    <link rel="stylesheet" href=" {{ asset('/')}}AdminAssets/backend/plugins/icofont/icofont.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('/')}}AdminAssets/backend/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
    <script type="text/javascript" src="https://cdn.jwplayer.com/libraries/rgoZYM8H.js"></script>
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('/')}}AdminAssets/backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/')}}AdminAssets/backend/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{asset('/')}}AdminAssets/css/bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/')}}AdminAssets/backend/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('/')}}AdminAssets/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="{{  asset('/')}}AdminAssets/css/app.css">
    <link rel="stylesheet" href="{{  asset('/')}}AdminAssets/css/new.css">
    <style>
        .imgWrap { display: flex; justify-content: center;}
        .imgcontain { position: relative; width: max-content}
        .imgcontain img { display: block; }
        .imgcontain .fa-trash { position: absolute; top:10px; right:10px; }
    </style>

    <!-- New font start-->
    <link rel="stylesheet" href="{{  asset('/')}}AdminAssets/backend/dist/css/alt/bootstrap.min.css" />
    <link rel="stylesheet" href="{{  asset('/')}}AdminAssets/backend/dist/css/alt/bootstrap-select.min.css" />
    <script src="{{  asset('/')}}AdminAssets/js/app.js') }}" defer></script>
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">--}}
<!-- New font end-->
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper" id="app">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="{{ asset('/')}}AdminAssets/backend/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>
    <!-- Navbar -->
@include('admin.master.navbar')
<!-- /.navbar -->
    <!-- Main Sidebar Container -->
@include('admin.master.sidebar')
@yield('content')
<!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    <!-- Main Footer -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2019-2025 <a href="">Amader Dokan</a>.</strong>
        All rights reserved At Amadr Dokan.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.2.0
        </div>
    </footer>
</div>
<!-- ./wrapper -->
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('/')}}AdminAssets/backend/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{ asset('/')}}AdminAssets/backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('/')}}AdminAssets/backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/')}}AdminAssets/backend/dist/js/adminlte.js"></script>
<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('/')}}AdminAssets/backend/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="{{ asset('/')}}AdminAssets/backend/plugins/raphael/raphael.min.js"></script>
<script src="{{ asset('/')}}AdminAssets/backend/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="{{ asset('/')}}AdminAssets/backend/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="{{ asset('/')}}AdminAssets/backend/plugins/chart.js/Chart.min.js"></script>
<script src="{{ asset('/')}}AdminAssets/backend/plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>--}}
<script src="{{ asset('/')}}AdminAssets/backend/dist/js/pages/dashboard2.js"></script>
<script src="{{ asset('/')}}AdminAssets/backend/dist/js/toastr/toastr.min.js "></script>
<!-- Alert -->
<script src="{{ asset('/')}}AdminAssets/backend/dist/js/custom.js"></script>
<script src="{{ asset('/')}}AdminAssets/backend/dist/js/sweetalert2.min.js"></script>
</body>
<script src="{{ asset('/')}}AdminAssets/backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Option 2: Separate Popper and Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="{{  asset('/')}}AdminAssets/backend/plugins/dist/js/popper.min.js"></script>
<script src="{{ asset('/')}}AdminAssets/backend/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="{{ asset('/')}}AdminAssets/backend/dist/js/bootstrap-select.min.js"></script>

<script src="{{ mix('js/app.js') }}"></script>

<script>
    $(document).ready(function() {
        // $('.select2').select2();
        $('.search_select_box select').selectpicker();
    });
</script>
<script>
    function deleteStudent(id)
    {
        event.preventDefault();
        var check = confirm('Are you sure want to update this!');
        if(check)
        {
            document.getElementById('deleteStudentForm'+id).submit();
        }
    }
</script>
<script>
    $(document).ready(function() {
        $('#categorySearch').keyup(function() {
            var searchText = $(this).val().toLowerCase();
            $('#myTable tbody tr').each(function() {
                var rowText = $(this).text().toLowerCase();
                if (rowText.indexOf(searchText) === -1) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        });
    });
</script>
</html>
