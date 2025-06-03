<!DOCTYPE html>
<html lang="en">


<!-- molla/index-2.html  22 Nov 2019 09:55:32 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Amader Dokan</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Amader Dokan">
    <meta name="author" content="p-themes">
    <link rel="icon" href="{{asset('/')}}adw.jpeg" type="image/x-icon" />
    <!-- Favicon -->
    @yield('links')

</head>

<body>
<div class="page-wrapper">
    @include('Layouts.header')

    <main class="main">

        @yield('content')
    </main><!-- End .main -->

    @include('Layouts.footer')
</div><!-- End .page-wrapper -->
<button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

<!-- Mobile Menu -->
<div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-close"></i></span>

        <form action="#" method="get" class="mobile-search">
            <label for="mobile-search" class="sr-only">Search</label>
            <input type="search" class="form-control" name="mobile-search" id="mobile-search" placeholder="Search in..." required>
            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
        </form>

        <nav class="mobile-nav">
            <ul class="mobile-menu">
                <li class="active">
                    <a href="{{ route('landing') }}">Home</a>
                </li>
            </ul>
        </nav><!-- End .mobile-nav -->

        <div class="social-icons">
            <a href="https://www.facebook.com/bg.hr.3" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
        </div><!-- End .social-icons -->
    </div><!-- End .mobile-menu-wrapper -->
</div><!-- End .mobile-menu-container -->

<!-- Plugins JS File -->
@yield('scripts')
</body>


<!-- molla/index-2.html  22 Nov 2019 09:55:42 GMT -->
</html>
