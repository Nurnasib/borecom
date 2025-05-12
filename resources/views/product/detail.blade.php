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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

@endsection




@section('content')
    <div class="page-content">
        <div class="container">
            <div class="product-details-top">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-gallery product-gallery-vertical">
                            <div class="row">
                                <figure class="product-main-image">
                                    <img id="product-zoom" src="{{ asset('storage/' . $product->image) }}" data-zoom-image="assets/images/products/single/1-big.jpg" alt="product image">

                                    <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                        <i class="icon-arrows"></i>
                                    </a>
                                </figure><!-- End .product-main-image -->

                                <div id="product-zoom-gallery" class="product-image-gallery">
                                    @foreach(json_decode($product->additional_images) as $addi)
                                    <a class="product-gallery-item active" href="#" data-image="assets/images/products/single/1.jpg" data-zoom-image="assets/images/products/single/1-big.jpg">
                                        <img src="{{asset('storage/'. $addi)}}" alt="product side">
                                    </a>
                                    @endforeach
                                </div><!-- End .product-image-gallery -->
                            </div><!-- End .row -->
                        </div><!-- End .product-gallery -->
                    </div><!-- End .col-md-6 -->

                    <div class="col-md-6">
                        <div class="product-details">
                            <h1 class="product-title">{{$product->product_name}}</h1><!-- End .product-title -->

                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                </div><!-- End .ratings -->
                                <a class="ratings-text" href="#product-review-link" id="review-link">( 2 Reviews )</a>
                            </div><!-- End .rating-container -->

                            <div class="product-price" id="product-price">
                                {{$product->price}} tk
                            </div><!-- End .product-price -->

                            <div class="product-content">
                                <p>Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing. Sed lectus. </p>
                            </div><!-- End .product-content -->

                            <div class="">
                                <label>Color: {{$product->color??'N/A'}}</label>
                            </div><!-- End .details-filter-row -->

                            <div class="details-filter-row details-row-size">
                                <label for="size">Size:</label>
                                <div class="select-custom">
                                    <select name="size" id="size" class="form-control">
                                        <option value="s">Small</option>
                                        <option value="m">Medium</option>
                                        <option value="l">Large</option>
                                        <option value="xl">Extra Large</option>
                                    </select>
                                </div><!-- End .select-custom -->

                                <a href="#" class="size-guide"><i class="icon-th-list"></i>Size Guide</a>
                            </div><!-- End .details-filter-row -->

                            <div class="details-filter-row details-row-size">
                                <label for="qty">Qty:</label>
                                <div class="product-details-quantity">
                                    <input type="number" id="qty" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required>
                                </div><!-- End .product-details-quantity -->
                            </div><!-- End .details-filter-row -->

                            <div class="product-details-action" style="display: flex; gap: 10px; align-items: center;">
                                <a href="#" id="addToCartBtn" class="btn btn-primary btn-shadow"
                                   style="width: 150px; text-align: center; padding: 10px 20px; display: inline-block; text-decoration: none; background-color: green; color: white; border: none;">
                                    <i class="fas fa-shopping-cart" style="margin-right: 5px;"></i>
                                    <span>Add to Cart</span>
                                </a>

                                <a href="#" id="buyNowBtnnnn" class="btn btn-primary btn-rounded btn-shadow"
                                   style="width: 150px; text-align: center; padding: 10px 20px; display: inline-block; text-decoration: none; background-color: green; color: white; border: none;">
                                    <i class="fas fa-shopping-bag text-outline-success" style="margin-right: 5px;"></i>
                                    <span>Buy Now</span>
                                </a>
                            </div>
                        </div><!-- End .product-details -->
                    </div><!-- End .col-md-6 -->
                </div><!-- End .row -->
            </div><!-- End .product-details-top -->



            <h2 class="title text-center mb-4">You May Also Like</h2>

            @if($related_products->count())
                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                     data-owl-options='{
                    "nav": false,
                    "dots": true,
                    "margin": 20,
                    "loop": false,
                    "responsive": {
                        "0": {"items":1},
                        "480": {"items":2},
                        "768": {"items":3},
                        "992": {"items":4},
                        "1200": {"items":4, "nav": true, "dots": false}
                    }
                }'>
                    @foreach($related_products as $rel)
                        <div class="product product-7 text-center">
                            <figure class="product-media">
                                <a href="{{ route('product.detail', $rel->id) }}">
{{--                                    <img src="{{ asset('storage/' . $rel->image) }}" alt="{{ $rel->product_name }}" class="product-image">--}}
                                    <img src="{{ asset('storage/' . $rel->image) }}" alt="{{ $rel->product_name }}" class="product-image" style="height: 175px; object-fit: cover;">

                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                    <a href="#" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                    <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                                </div>

                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div>
                            </figure>

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">{{ $rel->category->name ?? 'Uncategorized' }}</a>
                                </div>
                                <h3 class="product-title">
                                    <a href="{{ route('product.detail', $rel->id) }}">{{ $rel->product_name }}</a>
                                </h3>
                                <div class="product-price">
                                    {{ $rel->price }} tk
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center">No related products found.</p>
            @endif
        </div>
    </div>
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
            document.addEventListener("DOMContentLoaded", function () {
                const sizeSelect = document.getElementById("size");
                const qtyInput = document.getElementById("qty");
                const addToCartBtn = document.getElementById("addToCartBtn");
                const buyNowBtn = document.getElementById("buyNowBtn");

                function updateLinks() {
                    const size = sizeSelect.value;
                    const qty = qtyInput.value;
                    if (size === "") {
                        alert("Please select a size before proceeding.");
                        return false;
                    }

                    const addToCartUrl = "{{ route('cart.add.product', $product->id) }}?size=" + encodeURIComponent(size) + "&qty=" + qty;
                    addToCartBtn.href = addToCartUrl;

                    return true;
                }

                addToCartBtn.addEventListener("click", function (e) {
                    if (updateLinks()) {
                        alert('Added to cart successfully!');
                    } else {
                        e.preventDefault();
                    }
                });

            });

        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const sizeSelect = document.getElementById("size");
                const qtyInput = document.getElementById("qty");
                const priceInput = document.getElementById("product-price");
                const buyNowBtn = document.getElementById("buyNowBtnnnn");

                buyNowBtn.addEventListener("click", function (e) {
                    e.preventDefault();
                    console.log('Buy Now Clicked');

                    const size = sizeSelect.value;
                    const qty = qtyInput.value;
                    const rawText = priceInput.textContent.trim(); // e.g., "500 tk"
                    const price = parseFloat(rawText);
                    console.log(price, 'price')

                    if (size === "") {
                        alert("Please select a size before proceeding.");
                        return;
                    }

                    fetch("{{ route('single-buy_now', $product->id) }}?size=" + encodeURIComponent(size) + "&qty=" + qty+ "&price=" + price, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.redirect) {
                                window.location.href = data.redirect;
                            } else {
                                console.log('Unexpected response', data);
                            }
                        })
                        .catch(error => {
                            console.log('Error:', error);
                        });
                });

            });

        </script>
    @endsection
