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
            <h1 class="page-title">Shopping Cart<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="cart">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <table class="table table-cart table-mobile">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody id="cart-body">
                            @if(session('cart') && count(session('cart')) > 0)
                                @php $subtotal = 0; @endphp
                                @foreach(session('cart') as $key => $item)
                                    @php
                                        $itemTotal = $item['price'] * $item['quantity'];
                                        $subtotal += $itemTotal;
                                    @endphp
                                    <tr data-key="{{ $key }}" data-price="{{ $item['price'] }}">
                                        <td class="product-col">
                                            <div class="product">
                                                <figure class="product-media">
                                                    <a href="#">
                                                        <img src="{{ asset('storage/'.$item['image']) }}" alt="Product image">
                                                    </a>
                                                </figure>
                                                <h3 class="product-title">
                                                    <a href="#">{{ $item['name'] }}</a>
                                                </h3>
                                                @if(isset($item['size']))
                                                    <p id="size">Size: {{ strtoupper($item['size']) }}</p>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="price-col">{{ number_format($item['price'], 2) }} tk</td>
                                        <td class="quantity-col">
                                            <div class="cart-product-quantity">
                                                <input type="number" class="form-control quantity-input"
                                                       value="{{ $item['quantity'] }}" min="1" max="10" step="1"
                                                       data-key="{{ $key }}" required>
                                            </div>
                                        </td>
                                        <td class="total-col" id="item-total-{{ $key }}">{{ number_format($itemTotal, 2) }} tk</td>
                                        <td class="remove-col">
                                            <button class="btn-remove" onclick="removeFromCart('{{ $key }}')">
                                                <i class="icon-close"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">Your cart is empty</td>
                                </tr>
                            @endif
                            </tbody>

{{--                            <tfoot>--}}
{{--                            <tr>--}}
{{--                                <td colspan="3" class="text-end"><strong>Subtotal:</strong></td>--}}
{{--                                <td colspan="2" id="cart-subtotal"><strong>{{ number_format($subtotal, 2) }} tk</strong></td>--}}
{{--                            </tr>--}}
{{--                            </tfoot>--}}



                        </table><!-- End .table table-wishlist -->

                        <div class="cart-bottom">
                            <div class="cart-discount">
                                <form action="#">
                                    <div class="input-group">
                                        <input type="text" class="form-control" required placeholder="coupon code">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary-2" type="submit"><i class="icon-long-arrow-right"></i></button>
                                        </div><!-- .End .input-group-append -->
                                    </div><!-- End .input-group -->
                                </form>
                            </div><!-- End .cart-discount -->

                            <a href="#" class="btn btn-outline-dark-2"><span>UPDATE CART</span><i class="icon-refresh"></i></a>
                        </div><!-- End .cart-bottom -->
                    </div><!-- End .col-lg-9 -->
                    <aside class="col-lg-3">
                        <div class="summary summary-cart">
                            <h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

                            <table class="table table-summary">
                                <tbody>

                                <tr class="summary-subtotal">
                                    <td>Subtotal:</td>
                                    <td id="cart-summary-subtotal">{{ number_format($subtotal ?? 0, 2) }} tk</td>
                                </tr><!-- End .summary-subtotal -->

                                <tr class="summary-shipping">
                                    <td>Shipping:</td>
                                    <td>&nbsp;</td>
                                </tr>

                                <tr class="summary-shipping-row">
                                    <td>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="free-shipping" name="shipping" class="custom-control-input">
                                            <label class="custom-control-label" for="free-shipping">Free Shipping</label>
                                        </div><!-- End .custom-control -->
                                    </td>
                                    <td>$0.00</td>
                                </tr><!-- End .summary-shipping-row -->

                                <tr class="summary-shipping-row">
                                    <td>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="standart-shipping" name="shipping" class="custom-control-input">
                                            <label class="custom-control-label" for="standart-shipping">Standart:</label>
                                        </div><!-- End .custom-control -->
                                    </td>
                                    <td>$10.00</td>
                                </tr><!-- End .summary-shipping-row -->

                                <tr class="summary-shipping-row">
                                    <td>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="express-shipping" name="shipping" class="custom-control-input">
                                            <label class="custom-control-label" for="express-shipping">Express:</label>
                                        </div><!-- End .custom-control -->
                                    </td>
                                    <td>$20.00</td>
                                </tr><!-- End .summary-shipping-row -->

                                <tr class="summary-shipping-estimate">
                                    <td>Estimate for Your Country<br> <a href="dashboard.html">Change address</a></td>
                                    <td>&nbsp;</td>
                                </tr><!-- End .summary-shipping-estimate -->

                                <tr class="summary-total">
                                    <td>Total:</td>
                                    <td id="cart-total"><strong>{{ number_format($subtotal ?? 0, 2) }} tk</strong></td>
                                </tr>
                                <!-- End .summary-total -->
                                </tbody>
                            </table><!-- End .table table-summary -->

                            <button onclick="sendCartDataToRoute()" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</button>
                        </div><!-- End .summary -->

                        <a href="category.html" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .cart -->
    </div><!-- End .page-content -->
@endsection


@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const quantityInputs = document.querySelectorAll('.quantity-input');

            quantityInputs.forEach(input => {
                input.addEventListener('input', function () {
                    const key = this.dataset.key;
                    const row = this.closest('tr');
                    const price = parseFloat(row.dataset.price);
                    const quantity = parseInt(this.value) || 1;

                    // Update item total
                    const itemTotal = price * quantity;
                    document.getElementById(`item-total-${key}`).textContent = itemTotal.toFixed(2) + ' tk';

                    // Recalculate subtotal
                    let newSubtotal = 0;
                    document.querySelectorAll('tr[data-key]').forEach(row => {
                        const price = parseFloat(row.dataset.price);
                        const qty = parseInt(row.querySelector('.quantity-input').value) || 1;
                        newSubtotal += price * qty;
                    });

                    const formattedSubtotal = newSubtotal.toFixed(2) + ' tk';

                    // Update all subtotal displays
                    const subtotalElement = document.getElementById('cart-subtotal');
                    const totalElement = document.getElementById('cart-total');
                    const summaryElement = document.getElementById('cart-summary-subtotal');

                    if (subtotalElement) subtotalElement.innerHTML = `<strong>${formattedSubtotal}</strong>`;
                    if (totalElement) totalElement.innerHTML = `<strong>${formattedSubtotal}</strong>`;
                    if (summaryElement) summaryElement.innerHTML = `<strong>${formattedSubtotal}</strong>`;
                });
            });
        });

        // ✅ Function to collect product data as array of objects
        function collectCartData() {
            const productRows = document.querySelectorAll('tr[data-key]');
            let cartData = [];

            productRows.forEach(row => {
                const product = {
                    id: row.dataset.id,
                    price: parseFloat(row.dataset.price),
                    size: parseInt(row.querySelector('.size')) || 1,
                    quantity: parseInt(row.querySelector('.quantity-input').value) || 1
                };
                cartData.push(product);
            });

            return cartData;
        }

        // ✅ Function to send cart data to Laravel route
        function sendCartDataToRoute() {
            const cartItems = collectCartData();

            fetch("{{ route('cart-buy_now', 1) }}", {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ cart: cartItems })
            })
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                    // Show a message or update UI as needed
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>


@endsection

