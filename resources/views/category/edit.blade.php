@extends('Layouts.master')
@section('links')
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('/')}}assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('/')}}assets/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/')}}assets/images/icons/favicon-16x16.png">
    <link rel="manifest" href="{{asset('/')}}assets/images/icons/site.html">
    <link rel="mask-icon" href="{{asset('/')}}assets/images/icons/safari-pinned-tab.svg" color="#666666">
    <link rel="shortcut icon" href="{{asset('/')}}assets/images/icons/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="{{asset('/')}}assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{asset('/')}}assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('/')}}assets/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="{{asset('/')}}assets/css/plugins/magnific-popup/magnific-popup.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{asset('/')}}assets/css/style.css">
@endsection

@section('content')

    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Category<span>Create</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->


    <main class="main">
        <div class="cta cta-horizontal cta-horizontal-box bg-image mb-5" style="background-image: url(assets/images/backgrounds/cta/bg-1.jpg); background-position: center right;">
            <div class="row align-items-center">
                <div class="col-lg-4 col-xl-3 offset-xl-1">
                    <h3 class="cta-title">Enter Category</h3><!-- End .cta-title -->
                    <p class="cta-desc">Create Any Category</p><!-- End .cta-desc -->
                </div><!-- End .col-xl-3 -->

                <div class="col-lg-8 col-xl-7">
                    <form action=" {{route('category.update',['category'=>$category->id])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="input-group">
                            <input type="hidden" name="id" value="{{$category->id}}">
                            <input type="text" class="form-control" name="category_name" value="{{$category->category_name}}" placeholder="Enter your Category Name...." aria-label="Enter Category" required>
                            <div class="input-group-append">
                                <button class="btn btn-primary btn-rounded" type="submit"><span>Submit</span><i class="icon-long-arrow-right"></i></button>
                            </div><!-- .End .input-group-append -->
                        </div><!-- .End .input-group -->
                    </form>
                </div><!-- End .col-xl-7 -->
            </div><!-- End .row -->
        </div>
    </main>

@endsection

@section('scripts')
    <script src="{{asset('/')}}assets/js/jquery.min.js"></script>
    <script src="{{asset('/')}}assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('/')}}assets/js/jquery.hoverIntent.min.js"></script>
    <script src="{{asset('/')}}assets/js/jquery.waypoints.min.js"></script>
    <script src="{{asset('/')}}assets/js/superfish.min.js"></script>
    <script src="{{asset('/')}}assets/js/owl.carousel.min.js"></script>
    <script src="{{asset('/')}}assets/js/jquery.magnific-popup.min.js"></script>
    <!-- Main JS File -->
    <script src="{{asset('/')}}assets/js/main.js"></script>
@endsection


