@extends('Layouts.master')
@section('links')
{{--    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('/')}}assets/images/icons/apple-touch-icon.png">--}}
{{--    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('/')}}assets/images/icons/favicon-32x32.png">--}}
{{--    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/')}}assets/images/icons/favicon-16x16.png">--}}
    <link rel="manifest" href="{{asset('/')}}assets/images/icons/site.html">
    <link rel="mask-icon" href="{{asset('/')}}assets/images/icons/safari-pinned-tab.svg" color="#666666">
{{--    <link rel="shortcut icon" href="{{asset('/')}}assets/images/icons/favicon.ico">--}}
    <meta name="apple-mobile-web-app-title" content="Molla">
<link rel="icon" href="{{asset('/')}}adw.jpeg" type="image/x-icon" />
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

    <main class="main">
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Checkout<span>Shop</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="checkout">
                <div class="container">
                    <div class="checkout-discount">
                        <form action="#">
                            <input type="text" class="form-control" required id="checkout-discount-input">
                            <label for="checkout-discount-input" class="text-truncate">Have a coupon? <span>Click here to enter your code</span></label>
                        </form>
                    </div><!-- End .checkout-discount -->
                    <form action="{{route('place.order')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-9">
                                <h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>First Name *</label>
                                        <input type="text" name="f_name" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>Last Name *</label>
                                        <input type="text" name="l_name" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->
                                <label>Address *</label>
                                <textarea type="text" name="address" class="form-control" placeholder="House number and Street name" required></textarea>


                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>City *</label>
                                        <input type="text" id="city" name="city" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>Phone *</label>
                                        <input type="text" name="phone" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->

                                <label>Email address *</label>
                                <input type="email" name="email" class="form-control" required>


                            </div><!-- End .col-lg-9 -->
                            <aside class="col-lg-3">
                                <div class="summary">
                                    <h3 class="summary-title">Your Order</h3><!-- End .summary-title -->

                                    <table class="table table-summary">
                                        <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th class="pl-5">Price*Qty</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        @foreach($products1 as $val)
                                            <tr>
                                                <td><a href="#">{{$val['product']['product_name']}}</a></td>
                                                <td  class="pl-5">{{$val['price']}}x{{$val['qty']}}</td>
                                                <td>{{$val['price']*$val['qty']}}</td>
                                            </tr>
{{--                                            <tr>--}}
{{--                                                <td><a href="#">Quantity</a></td>--}}
{{--                                                --}}
{{--                                            </tr>--}}
                                        @endforeach

{{--                                        <input type="hidden" name="product_id" value="{{$product->id}}">--}}
{{--                                        <input type="hidden" name="price" value="{{$product->price}}">--}}
{{--                                        <input type="hidden" name="qty" value="{{$qty}}">--}}
{{--                                        <input type="hidden" name="size" value="{{$size}}">--}}
{{--                                        <input type="hidden" id="delivery_charge"--}}
{{--                                               name="delivery_charge" value="{{$product->delivery_charge}}">--}}

                                        <tr class="summary-subtotal">
                                            <td>Subtotal:</td>
                                            <td>{{$subtotal}}</td>
                                        </tr><!-- End .summary-subtotal -->
                                        <tr>
                                            <td>Delivery Charge:</td>
                                            <td id="delivery-charge">
                                                {{$products1[0]['product']['delivery_charge_in']}}
                                            </td>
                                        </tr>

{{--                                        <tr class="summary-total">--}}
{{--                                            <td>Total:</td>--}}
{{--                                            <td id="total">--}}
{{--                                                {{$product->price * $qty + $product->delivery_charge_out}} <!-- Initial value -->--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
                                        <tr>
                                            <td>Bkash:</td>
                                            <td>01784033051</td>
                                        </tr>
{{--                                        <tr>--}}
{{--                                            --}}
{{--                                        </tr>--}}
                                        </tbody>
                                    </table><!-- End .table table-summary -->
                                    <div class="col-md-10">
                                        <label> <span class="text-danger">Enter Transaction ID</span></label>
                                        <input type="text" class="form-control mt-1" required name="transactionId" placeholder="#transactionId">
                                    </div>

                                    <button type="submit" class="btn btn-outline-success">
                                        <span class="">Place Order</span>
                                    </button>
                                    @php
                                    $adv_req = 'none';
                                    if ($products1[0]['product']['required_advance']=='deli'){
                                        $adv_req = 'delivery charge';
                                    }elseif ($products1[0]['product']['required_advance']=='all'){
                                        $adv_req = 'full price+delivery charge';
                                    }elseif ($products1[0]['product']['required_advance']=='price'){
                                        $adv_req = 'only price';
                                    }
                                    @endphp

                                    <div class="accordion-summary" id="accordion-payment">
                                        <div class="card">
                                            <div class="card-header" id="heading-1">
                                                <h2 class="card-title">
                                                    <a role="button" data-toggle="collapse" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                                                        Advance {{$adv_req}} Required
                                                    </a>
                                                </h2>
                                            </div><!-- End .card-header -->
                                            <div id="collapse-1" class="collapse show" aria-labelledby="heading-1" data-parent="#accordion-payment">
                                                <div class="card-body">
                                                    উক্ত Bkash নম্বরে পে করুন। তারপর, Transaction_id প্রবেশ করে place Order এ চাপুন
                                                </div><!-- End .card-body -->
                                            </div><!-- End .collapse -->
                                        </div><!-- End .card -->
                                    </div><!-- End .accordion -->
                                </div><!-- End .summary -->
                            </aside><!-- End .col-lg-3 -->
                        </div><!-- End .row -->
                    </form>
                </div><!-- End .container -->
            </div><!-- End .checkout -->
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cityInput = document.getElementById('city');
            const deliveryChargeElement = document.getElementById('delivery-charge');
            const totalElement = document.getElementById('total');
            const hiddenDeliveryChargeInput = document.getElementById('delivery_charge'); // Hidden delivery charge input


            // Function to update delivery charge and total based on city
            function updateDeliveryInfo() {
                console.log('kkkkkk');
                const city = cityInput.value.trim().toLowerCase();  // Get and normalize city input

                if (city === 'dhaka') {
                    console.log(city);
                    deliveryChargeElement.textContent = '{{ $products1[0]['product']['delivery_charge_in'] }}';
                    totalElement.textContent = '{{ $products1[0]['price'] * $products1[0]['qty'] + $products1[0]['product']->delivery_charge_in }}';
                    hiddenDeliveryChargeInput.value = '{{ $products1[0]['product']->delivery_charge_in }}';
                } else {
                    deliveryChargeElement.textContent = '{{ $products1[0]['product']->delivery_charge_out }}';
                    totalElement.textContent = '{{ $products1[0]['price'] * $products1[0]['qty'] + $products1[0]['product']->delivery_charge_out }}';
                    hiddenDeliveryChargeInput.value = '{{ $products1[0]['product']->delivery_charge_out }}';
                }
            }

            // Attach the update function to the input event of the city field
            cityInput.addEventListener('input', updateDeliveryInfo);
        });
    </script>

@endsection


