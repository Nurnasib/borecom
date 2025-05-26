@extends('Layouts.master')
@section('links')
{{--    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('/')}}assets/images/icons/apple-touch-icon.png">--}}
{{--    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('/')}}adw.jpeg">--}}
{{--    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/')}}assets/images/icons/favicon-16x16.png">--}}
{{--    <link rel="manifest" href="{{asset('/')}}assets/images/icons/site.html">--}}
{{--    <link rel="mask-icon" href="{{asset('/')}}assets/images/icons/safari-pinned-tab.svg" color="#666666">--}}
{{--    <link rel="shortcut icon" href="{{asset('/')}}assets/images/icons/favicon.ico">--}}

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
    <div class="intro-section bg-lighter pt-5 pb-6">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="intro-slider-container slider-container-ratio slider-container-1 mb-2 mb-lg-0">
                        <div class="intro-slider intro-slider-1 owl-carousel owl-simple owl-light owl-nav-inside" data-toggle="owl" data-owl-options='{
                                        "nav": false,
                                        "responsive": {
                                            "768": {
                                                "nav": true
                                            }
                                        }
                                    }'>
                            <div class="intro-slide">
                                <figure class="slide-image">
                                    <picture>
                                        <source media="(max-width: 480px)" srcset="{{asset('/')}}assets/images/slider/slide-1-480w.jpg">
                                        <img src="{{asset('/')}}assets/images/slider/slide-1.jpg" alt="Image Desc">
                                    </picture>
                                </figure><!-- End .slide-image -->

                                <div class="intro-content">

                                    <a href="category.html" class="btn btn-outline-white">
                                        <span>SHOP NOW</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div><!-- End .intro-content -->
                            </div><!-- End .intro-slide -->

                            <div class="intro-slide">
                                <figure class="slide-image">
                                    <picture>
                                        <source media="(max-width: 480px)" srcset="{{asset('/')}}assets/images/slider/slide-2-480w.jpg">
                                        <img src="{{asset('/')}}assets/images/slider/slide-2.jpg" alt="Image Desc">
                                    </picture>
                                </figure><!-- End .slide-image -->

                                <div class="intro-content">
                                    <h3 class="intro-subtitle">News and Inspiration</h3><!-- End .h3 intro-subtitle -->
                                    <h1 class="intro-title">New Arrivals</h1><!-- End .intro-title -->

                                    <a href="category.html" class="btn btn-outline-white">
                                        <span>SHOP NOW</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div><!-- End .intro-content -->
                            </div><!-- End .intro-slide -->

                            <div class="intro-slide">
                                <figure class="slide-image">
                                    <picture>
                                        <source media="(max-width: 480px)" srcset="{{asset('/')}}assets/images/slider/slide-3-480w.jpg">
                                        <img src="{{asset('/')}}assets/images/slider/slide-3.jpg" alt="Image Desc">
                                    </picture>
                                </figure><!-- End .slide-image -->

                                <div class="intro-content">
                                    <h3 class="intro-subtitle">Outdoor Furniture</h3><!-- End .h3 intro-subtitle -->
                                    <h1 class="intro-title">Outdoor Dining <br>Furniture</h1><!-- End .intro-title -->

                                    <a href="category.html" class="btn btn-outline-white">
                                        <span>SHOP NOW</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div><!-- End .intro-content -->
                            </div><!-- End .intro-slide -->
                        </div><!-- End .intro-slider owl-carousel owl-simple -->

                        <span class="slider-loader"></span><!-- End .slider-loader -->
                    </div><!-- End .intro-slider-container -->
                </div><!-- End .col-lg-8 -->
                <div class="col-lg-4">
                    <div class="intro-banners">
                        <div class="row row-sm">
                            <div class="col-md-6 col-lg-12">
                                <div class="banner banner-display">
                                    <a href="#">
                                        <img src="{{asset('/')}}assets/images/banners/home/intro/banner-1.jpg" alt="Banner">
                                    </a>

                                    <div class="banner-content">
                                        <h4 class="banner-subtitle text-darkwhite"><a href="#">Clearence</a></h4><!-- End .banner-subtitle -->
                                        <h3 class="banner-title text-white"><a href="#">Chairs & Chaises <br>Up to 40% off</a></h3><!-- End .banner-title -->
                                        <a href="#" class="btn btn-outline-white banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                                    </div><!-- End .banner-content -->
                                </div><!-- End .banner -->
                            </div><!-- End .col-md-6 col-lg-12 -->

                            <div class="col-md-6 col-lg-12">
                                <div class="banner banner-display mb-0">
                                    <a href="#">
                                        <img src="{{asset('/')}}assets/images/banners/home/intro/banner-2.jpg" alt="Banner">
                                    </a>

                                    <div class="banner-content">
                                        <h4 class="banner-subtitle text-darkwhite"><a href="#">New in</a></h4><!-- End .banner-subtitle -->
                                        <h3 class="banner-title text-white"><a href="#">Best Lighting <br>Collection</a></h3><!-- End .banner-title -->
                                        <a href="#" class="btn btn-outline-white banner-link">Discover Now<i class="icon-long-arrow-right"></i></a>
                                    </div><!-- End .banner-content -->
                                </div><!-- End .banner -->
                            </div><!-- End .col-md-6 col-lg-12 -->
                        </div><!-- End .row row-sm -->
                    </div><!-- End .intro-banners -->
                </div><!-- End .col-lg-4 -->
            </div><!-- End .row -->

            <div class="mb-6"></div><!-- End .mb-6 -->

            <div class="owl-carousel owl-simple" data-toggle="owl"
                 data-owl-options='{
                            "nav": false,
                            "dots": false,
                            "margin": 30,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":2
                                },
                                "420": {
                                    "items":3
                                },
                                "600": {
                                    "items":4
                                },
                                "900": {
                                    "items":5
                                },
                                "1024": {
                                    "items":6
                                }
                            }
                        }'>
                <a href="#" class="brand">
                    <img src="{{asset('/')}}assets/images/brands/1.png" alt="Brand Name">
                </a>

                <a href="#" class="brand">
                    <img src="{{asset('/')}}assets/images/brands/2.png" alt="Brand Name">
                </a>

                <a href="#" class="brand">
                    <img src="{{asset('/')}}assets/images/brands/3.png" alt="Brand Name">
                </a>

                <a href="#" class="brand">
                    <img src="{{asset('/')}}assets/images/brands/4.png" alt="Brand Name">
                </a>

                <a href="#" class="brand">
                    <img src="{{asset('/')}}assets/images/brands/5.png" alt="Brand Name">
                </a>

                <a href="#" class="brand">
                    <img src="{{asset('/')}}assets/images/brands/6.png" alt="Brand Name">
                </a>
            </div><!-- End .owl-carousel -->
        </div><!-- End .container -->
    </div><!-- End .bg-lighter -->

    <div class="mb-6"></div><!-- End .mb-6 -->


{{--    <div class="cta cta-display bg-image pt-4 pb-4" style="background-image: url({{asset('/')}}assets/images/backgrounds/cta/bg-6.jpg); margin-bottom: 30px;">--}}
{{--        <div class="container">--}}
{{--            <div class="row justify-content-center">--}}
{{--                <div class="col-md-10 col-lg-9 col-xl-8">--}}
{{--                    <div class="row no-gutters flex-column flex-sm-row align-items-sm-center">--}}
{{--                        <div class="col">--}}
{{--                            <h3 class="cta-title text-white">Sign Up & Get 5% Off</h3><!-- End .cta-title -->--}}
{{--                            <p class="cta-desc text-white">Amadr Dokan presents the best in product in Bangladesh </p><!-- End .cta-desc -->--}}
{{--                        </div><!-- End .col -->--}}

{{--                        <div class="col-auto">--}}
{{--                            <a href="login.html" class="btn btn-outline-white"><span>SIGN UP</span><i class="icon-long-arrow-right"></i></a>--}}
{{--                        </div><!-- End .col-auto -->--}}
{{--                    </div><!-- End .row no-gutters -->--}}
{{--                </div><!-- End .col-md-10 col-lg-9 -->--}}
{{--            </div><!-- End .row -->--}}
{{--        </div><!-- End .container -->--}}
{{--    </div><!-- End .cta -->--}}

    <div class="container">
        <div class="heading heading-center mb-6 ">
            <h2 class="title">Recent Arrivals</h2><!-- End .title -->
        </div><!-- End .heading -->

        <div class="tab-content">
            <div class="tab-pane p-0 fade show active" id="top-all-tab" role="tabpanel" aria-labelledby="top-all-link">
                <div class="products">
                    <div class="row justify-content-center" id="product-container">
                        @include('Landing.products_card', ['products' => $products])
                    </div>

                    <div class="text-center mt-4">
                        <button id="load-more" class="btn btn-outline-darker" data-offset="{{ count($products) }}">
                            <span>Load more products</span> <i class="icon-long-arrow-down"></i>
                        </button>
                    </div>
                </div>
            </div><!-- .End .tab-pane -->

        </div><!-- End .tab-content -->
    </div><!-- End .container -->



    @foreach($products_grouped as $category=>$product_c)
    <div class="container mb-5 mt-10">
        <div class="heading heading-center mb-4">
            <h2 class="title">{{$product_c[0]->subCategory->sub_category_name??'N/A'}}</h2>
        </div><!-- End .heading -->

        <div class="row">

            @foreach($product_c as $product_s)
                <div class="col-6 col-md-4 col-lg-3 ">
                    <div class="product product-11 text-center">
                        <figure class="product-media">
                            <a href="{{ route('product.detail', $product_s->id) }}" style="position: relative;  display: block; overflow: hidden;">
                                <img src="{{ asset('storage/' . $product_s->image) }}"
                                     alt="{{ $product_s->product_name }}"
                                     style="height: 180px; width: 100%;  object-fit: cover; transition: opacity 0.3s ease; display: block;">

                                @php
                                    $hoverImage = optional(json_decode($product_s->additional_images))[0] ?? null;
                                @endphp
                                @if($hoverImage)
                                    <img src="{{ asset('storage/' . $hoverImage) }}"
                                         class="product-image-hover"
                                         style="height: 180px; width: 100%; object-fit: cover; position: absolute; top: 0; left: 0; opacity: 0; transition: opacity 0.3s ease;">
                                @endif
                            </a>

                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist"><span>add to wishlist</span></a>
                            </div>
                        </figure>

                        <div class="product-body">
                            <h3 class="product-title"><a href="{{ route('product.detail', $product_s->id) }}">{{ $product_s->product_name }}</a></h3>
                            <div class="product-price">
                                {{ $product_s->price }} TK
                            </div>
                        </div>

                        <div class="product-action">
                            <a href="/cart" class="btn-product btn-cart mr-2" ><span>Add Cart</span></a><br>
                            <a href="/cart" class="btn-product btn-cart "><span>Buy Now</span></a>
                        </div>
                    </div>
                </div>
                @endforeach

        </div>
    </div>
    @endforeach


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
<script>
    document.getElementById('load-more').addEventListener('click', function () {
        let button = this;
        let offset = parseInt(button.getAttribute('data-offset'));

        button.innerHTML = 'Loading...';

        fetch("{{ route('products.load-more') }}?offset=" + offset)
            .then(res => res.json())
            .then(data => {
                document.getElementById('product-container').insertAdjacentHTML('beforeend', data.html);
                offset += 8;
                button.setAttribute('data-offset', offset);
                button.innerHTML = '<span>Load more products</span> <i class="icon-long-arrow-down"></i>';

                if (!data.hasMore) {
                    button.remove();
                }
            })
            .catch(err => {
                console.error(err);
                button.innerText = 'Error. Try again.';
            });
    });
</script>


@endsection

