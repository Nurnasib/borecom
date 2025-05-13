@extends('Layouts.master')
@section('links')
{{--    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('/')}}assets/images/icons/apple-touch-icon.png">--}}
{{--    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('/')}}assets/images/icons/favicon-32x32.png">--}}
{{--    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/')}}assets/images/icons/favicon-16x16.png">--}}
    <link rel="manifest" href="{{asset('/')}}assets/images/icons/site.html">
    <link rel="mask-icon" href="{{asset('/')}}assets/images/icons/safari-pinned-tab.svg" color="#666666">
{{--    <link rel="shortcut icon" href="{{asset('/')}}assets/images/icons/favicon.ico">--}}
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="{{asset('/')}}assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link rel="icon" href="{{asset('/')}}adw.jpeg" type="image/x-icon" />
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
            <h1 class="page-title">Orders</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Orders</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="cart">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="bg-gradient-teal text-white">
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Customer Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Transaction ID</th>
                                    <th>Delivery Charge</th>
                                    <th>City</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $val)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $val->product->product_name ?? 'N/A' }}</td>
                                        <td>{{ $val->f_name ?? 'N/A' }}</td>
                                        <td>{{ $val->qty??'n/a' }}</td>
                                        <td>{{ $val->product->price*$val->qty??'none' }}</td>
                                        <td>{{ $val->payment->transactionId??'none' }}</td>
                                        <td>{{ $val->city=='dhaka'?$val->product->delivery_charge_in:$val->product->delivery_charge_out }}</td>
                                        <td>{{ $val->city??'n/a' }}</td>
                                        <td>{{ $val->address??'n/a' }}</td>
                                        <td>
                                            {{$val->status}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- End .col-lg-9 -->
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
                    product_id: row.querySelector('.product_id')?.value || 1,
                    quantity: parseInt(row.querySelector('.quantity-input').value) || 1
                };
                cartData.push(product);
            });

            return cartData;
        }

        // ✅ Function to send cart data to Laravel route
        function sendCartDataToRoute() {
            const cartItems = collectCartData();

            fetch("{{ route('cart-buy_now', 11111111) }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ cart: cartItems })
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
        }
    </script>


@endsection

