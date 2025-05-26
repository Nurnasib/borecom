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

{{--    <div class="page-content">--}}
{{--        <div class="cart">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-12">--}}
{{--                        <div class="table-responsive">--}}
{{--                            <table class="table table-bordered table-striped">--}}
{{--                                <thead class="bg-gradient-teal text-white">--}}
{{--                                <tr>--}}
{{--                                    <th>#</th>--}}
{{--                                    <th>Product Name</th>--}}
{{--                                    <th>Customer Name</th>--}}
{{--                                    <th>Quantity</th>--}}
{{--                                    <th>Price</th>--}}
{{--                                    <th>Code</th>--}}
{{--                                    <th>Delivery Charge</th>--}}
{{--                                    <th>City</th>--}}
{{--                                    <th>Address</th>--}}
{{--                                    <th>Status</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @foreach($orders as $val)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{ $loop->iteration }}</td>--}}
{{--                                        <td>{{ $val->product->product_name ?? 'N/A' }}</td>--}}
{{--                                        <td>{{ $val->f_name ?? 'N/A' }}</td>--}}
{{--                                        <td>{{ $val->qty??'n/a' }}</td>--}}
{{--                                        <td>{{ $val->product->price*$val->qty??'none' }}</td>--}}
{{--                                        <td>{{ $val->payment->order_code??'none' }}</td>--}}
{{--                                        <td>{{ $val->city=='dhaka'?$val->product->delivery_charge_in:$val->product->delivery_charge_out }}</td>--}}
{{--                                        <td>{{ $val->city??'n/a' }}</td>--}}
{{--                                        <td>{{ $val->address??'n/a' }}</td>--}}
{{--                                        <td>--}}
{{--                                            {{$val->status}}--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div><!-- End .col-lg-9 -->--}}
{{--                </div><!-- End .row -->--}}
{{--            </div><!-- End .container -->--}}
{{--        </div><!-- End .cart -->--}}
{{--    </div><!-- End .page-content -->--}}


    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #invoice, #invoice * {
                visibility: visible;
            }
            #invoice {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
            .no-print {
                display: none;
            }
        }

        .invoice-container {
            max-width: 800px;
            margin: 30px auto;
            padding: 30px;
            border: 1px solid #ccc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff;
            color: #333;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .invoice-header img {
            max-height: 60px;
            margin: 0 auto 10px auto;
            /*margin-bottom: 10px;*/
        }

        .invoice-header h2 {
            margin-bottom: 5px;
        }

        .order-info {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .order-info p {
            margin: 6px 0;
            font-size: 15px;
        }

        .product-list h4 {
            margin-bottom: 15px;
            font-size: 18px;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 5px;
            color: #4CAF50;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .product-table th,
        .product-table td {
            border: 1px solid #ccc;
            padding: 8px 12px;
            text-align: center;
            font-size: 14px;
        }

        .product-table th {
            background-color: #4CAF50;
            color: #fff;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .total-section {
            margin-top: 20px;
            text-align: right;
            font-size: 16px;
        }

        .total-section p {
            margin: 6px 0;
        }

        .print-btn {
            display: block;
            width: fit-content;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .print-btn:hover {
            background-color: #45a049;
        }
    </style>

    <div class="no-print">
        <button onclick="window.print()" class="print-btn">🖨️ Print Invoice</button>
    </div>

    <div class="invoice-container" id="invoice">
        @if(count($orders) > 0)
            @php
                $first = $orders[0];
                $deliveryCharge = $first->city == 'dhaka' ? ($first->product->delivery_charge_in ?? 0) : ($first->product->delivery_charge_out ?? 0);
                $subtotal = 0;
            @endphp

            <div class="invoice-header">
                <!-- Company logo and name -->
                <img src="{{ asset('/')}}adw.jpeg" alt="Company Logo" class="">
{{--                <h2>Amader Dokan</h2>--}}
                <p><strong>Invoice ID:</strong> {{ $first->payment->order_code ?? 'N/A' }}</p>
                <p><strong>Date:</strong> {{ date('d M, Y') }}</p>
            </div>

            <div class="order-info">
                <p><strong>Customer Name:</strong> {{ $first->f_name ?? 'N/A' }}</p>
                <p><strong>City:</strong> {{ ucfirst($first->city) ?? 'N/A' }}</p>
                <p><strong>Address:</strong> {{ $first->address ?? 'N/A' }}</p>
                <p><strong>Status:</strong> {{ ucfirst($first->status) }}</p>
            </div>

            <div class="product-list">
                <h4>Products</h4>
                <table class="product-table">
                    <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Total Price (BDT)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $val)
                        @php
                            $productTotal = ($val->product->price ?? 0) * ($val->qty ?? 0);
                            $subtotal += $productTotal;
                        @endphp
                        <tr>
                            <td>{{ $val->product->product_name ?? 'N/A' }}</td>
                            <td>{{ $val->qty ?? 'n/a' }}</td>
                            <td>{{ $productTotal }} BDT</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="total-section">
                <p><strong>Subtotal:</strong> {{ $subtotal }} BDT</p>
                <p><strong>Delivery Charge:</strong> {{ $deliveryCharge }} BDT</p>
                <p><strong>Total Amount:</strong> {{ $subtotal + $deliveryCharge }} BDT</p>
            </div>
        @else
            <p>No orders available to display.</p>
        @endif
    </div>



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

