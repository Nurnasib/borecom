<header class="header">
    <div class="header-top">
{{--        <div class="container">--}}
{{--            <div class="header-left">--}}
{{--                <div class="header-dropdown">--}}
{{--                    <a href="#">Usd</a>--}}
{{--                    <div class="header-menu">--}}
{{--                        <ul>--}}
{{--                            <li><a href="#">Eur</a></li>--}}
{{--                            <li><a href="#">Usd</a></li>--}}
{{--                        </ul>--}}
{{--                    </div><!-- End .header-menu -->--}}
{{--                </div><!-- End .header-dropdown -->--}}

{{--                <div class="header-dropdown">--}}
{{--                    <a href="#">Eng</a>--}}
{{--                    <div class="header-menu">--}}
{{--                        <ul>--}}
{{--                            <li><a href="#">English</a></li>--}}
{{--                            <li><a href="#">Bangla</a></li>--}}
{{--                        </ul>--}}
{{--                    </div><!-- End .header-menu -->--}}
{{--                </div><!-- End .header-dropdown -->--}}
{{--            </div><!-- End .header-left -->--}}

{{--            <div class="header-right">--}}
{{--                <ul class="top-menu">--}}
{{--                    <li>--}}
{{--                        <a href="#">Links</a>--}}
{{--                        <ul>--}}
{{--                            <li><a href="tel:#"><i class="icon-phone"></i>Call: +01552 383041</a></li>--}}
{{--                            <li><a href="wishlist.html"><i class="icon-heart-o"></i>My Wishlist <span>(3)</span></a></li>--}}
{{--                            <li><a href="about.html">About Us</a></li>--}}
{{--                            <li><a href="contact.html">Contact Us</a></li>--}}
{{--                            <li><a href="#signin-modal" data-toggle="modal"><i class="icon-user"></i>Login</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                </ul><!-- End .top-menu -->--}}
{{--            </div><!-- End .header-right -->--}}
{{--        </div><!-- End .container -->--}}
    </div><!-- End .header-top -->

    <div class="header-middle sticky-header">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>

                <a href="{{route('landing')}}" class="logo">
                    <img src="{{asset('/')}}adw.jpeg" alt="Molla Logo" width="105" height="25">
                </a>

                <nav class="main-nav">
                    <ul class="menu">
                        <li class="active">
                            <a href="{{ route('landing') }}">Home</a>
                        </li>
                        <li>
                            <form action="{{ route('orders.slug') }}" method="POST" style="display: flex; align-items: center;">
                                @csrf
                                <input type="search" class="form-control" name="slug" placeholder="Search in..." required
                                       style="margin-right: 5px; margin-bottom: 0px; height: 36px;" />
                                <button type="submit"
                                        style="border: none; background: none; padding: 0; cursor: pointer; height: 36px; display: flex; align-items: center;">
                                    <i class="icon-search" style="font-size: 20px;"></i>
                                </button>
                            </form>
                        </li>
                    </ul>

                </nav><!-- End .main-nav -->

            </div><!-- End .header-left -->

            <div class="header-right">
                <div class="header-search">

                </div><!-- End .header-search -->
                @php
                    $cart = session('cart', []);
                    $count = is_array($cart) ? count($cart) : 0;
                @endphp

                <div class="dropdown cart-dropdown">
                    <a href="/cart" class="dropdown-toggle" role="button">
                        <i class="icon-shopping-cart"></i>
                        <span class="cart-count">{{ json_encode($count) }}</span>
                    </a>

{{--                    <div class="dropdown-menu dropdown-menu-right">--}}
{{--                        <div class="dropdown-cart-products">--}}
{{--                            <div class="product">--}}
{{--                                <div class="product-cart-details">--}}
{{--                                    <h4 class="product-title">--}}
{{--                                        <a href="product.html">Beige knitted elastic runner shoes</a>--}}
{{--                                    </h4>--}}

{{--                                    <span class="cart-product-info">--}}
{{--                                                <span class="cart-product-qty">1</span>--}}
{{--                                                x $84.00--}}
{{--                                            </span>--}}
{{--                                </div><!-- End .product-cart-details -->--}}

{{--                                <figure class="product-image-container">--}}
{{--                                    <a href="product.html" class="product-image">--}}
{{--                                        <img src="{{asset('/')}}assets/images/products/cart/product-1.jpg" alt="product">--}}
{{--                                    </a>--}}
{{--                                </figure>--}}
{{--                                <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>--}}
{{--                            </div><!-- End .product -->--}}

{{--                            <div class="product">--}}
{{--                                <div class="product-cart-details">--}}
{{--                                    <h4 class="product-title">--}}
{{--                                        <a href="product.html">Blue utility pinafore denim dress</a>--}}
{{--                                    </h4>--}}

{{--                                    <span class="cart-product-info">--}}
{{--                                                <span class="cart-product-qty">1</span>--}}
{{--                                                x $76.00--}}
{{--                                            </span>--}}
{{--                                </div><!-- End .product-cart-details -->--}}

{{--                                <figure class="product-image-container">--}}
{{--                                    <a href="product.html" class="product-image">--}}
{{--                                        <img src="{{asset('/')}}assets/images/products/cart/product-2.jpg" alt="product">--}}
{{--                                    </a>--}}
{{--                                </figure>--}}
{{--                                <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>--}}
{{--                            </div><!-- End .product -->--}}
{{--                        </div><!-- End .cart-product -->--}}

{{--                        <div class="dropdown-cart-total">--}}
{{--                            <span>Total</span>--}}

{{--                            <span class="cart-total-price">$160.00</span>--}}
{{--                        </div><!-- End .dropdown-cart-total -->--}}

{{--                        <div class="dropdown-cart-action">--}}
{{--                            <a href="" class="btn btn-primary">View Cart</a>--}}
{{--                            <a id="buyNowBtn" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>--}}
{{--                        </div><!-- End .dropdown-cart-total -->--}}
{{--                    </div><!-- End .dropdown-menu -->--}}
                </div><!-- End .cart-dropdown -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->
</header><!-- End .header -->
