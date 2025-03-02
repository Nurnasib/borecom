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
    <link rel="stylesheet" href="{{asset('/')}}font-awesome/css/all.min.css">
@endsection

@section('content')



<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Category<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('category.index')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Category</li>
            </ol>
        </div><!-- End .container -->
    </nav>



    <hr class="page-content">
        <div class="col-md-8" style="margin-left: 80%">
            <a href="{{route('category.create')}}" class="btn btn-primary btn-rounded float-end mb-3"> Create Category</a>
        </div>

        <div class="cart">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-cart table-mobile">
                            <thead>
                            <tr >
                                <th>#</th>
                                <th style="font-weight: bold;">Category Name</th>
                                <th class="text-end " style="text-align: right; font-weight: bold; ">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($categories as  $key => $val)
                                <tr class="p-0">
                                    <td class="p-0">{{$key+ 1}}</td>
                                    <td class="p-0">{{$val->category_name}}</td>
                                    <td class="text-end row d-flex justify-content-end align-items-center p-0">
                                        <!-- Edit Button -->
                                        <a href="{{route('category.edit',['category'=>$val->id])}}" class="btn btn-primary btn-rounded " style="min-width: 10px!important;">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('category.destroy', ['category' => $val->id]) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-rounded" style="min-width: 10px!important;" onclick="return confirm('Are you sure you want to delete this category?');">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>

                                    {{--                                    <td class="remove-col"><button class="btn-remove"><i class="icon-close"></i></button></td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table><!-- End .table table-wishlist -->

                        <div class="cart-bottom">
                            <div class="cart-discount">
                                <form action="#">
{{--                                    <div class="input-group">--}}
{{--                                        <input type="text" class="form-control" required placeholder="coupon code">--}}
{{--                                        <div class="input-group-append">--}}
{{--                                            <button class="btn btn-outline-primary-2" type="submit"><i class="icon-long-arrow-right"></i></button>--}}
{{--                                        </div><!-- .End .input-group-append -->--}}
{{--                                    </div><!-- End .input-group -->--}}
                                </form>
                            </div><!-- End .cart-discount -->

{{--                            <a href="#" class="btn btn-outline-dark-2"><span>UPDATE CART</span><i class="icon-refresh"></i></a>--}}
                        </div><!-- End .cart-bottom -->
                    </div><!-- End .col-lg-9 -->
                    <!-- Pagination Links -->
                    <nav aria-label="Page navigation">
                        <ul class="pagination mb-4">
                            <li class="page-item disabled">
                                <a class="page-link page-link-prev" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                    <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                                </a>
                            </li>
                            <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item-total">of 6</li>
                            <li class="page-item">
                                <a class="page-link page-link-next" href="#" aria-label="Next">
                                    Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .cart -->
    </div><!-- End .page-content -->
</main><!-- End .main -->


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

