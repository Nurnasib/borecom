@extends('admin.master.app')

@section('content')
    <div class="content-wrapper">
        <div class="col-md-7 py-5 mx-auto">
            <div class="card card-primary card-outline">
                <div class="card-header text-center">{{ __('Edit Order') }}</div>
                <div class="card-body">
                    @if(Session::get('message'))
                        <div class="alert alert-success alert-dismissible col-md-5">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> {{ Session::get('message') }}</h5>
                        </div>
                    @endif

                    <!-- Display Validation Errors -->
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible col-md-5">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-ban"></i> Please correct the errors below:</h5>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('order.update', ['order' => $order->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Product -->
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Product</label>
                            <div class="col-md-9">
                                <select name="product_id" id="product_id" class="form-control @error('product_id') is-invalid @enderror" required>
                                    <option value="">Select Product</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ $order->product_id == $product->id ? 'selected' : '' }}>
                                            {{ $product->product_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Customer Name -->
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Customer Name</label>
                            <div class="col-md-9">
                                <input type="text" name="f_name" id="customer_name" class="form-control @error('f_name') is-invalid @enderror" value="{{ old('f_name', $order->f_name) }}" required>
                                @error('f_name')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Price</label>
                            <div class="col-md-9">
                                <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $order->payment->price) }}" required>
                                @error('price')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Transaction ID -->
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Transaction ID</label>
                            <div class="col-md-9">
                                <input type="text" name="transactionId" id="transactionId" class="form-control @error('transactionId') is-invalid @enderror" value="{{ old('transactionId', $order->payment->transactionId) }}" required>
                                @error('transactionId')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Delivery Charge -->
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Delivery Charge</label>
                            <div class="col-md-9">
                                <input type="number" name="delivery_charge" id="delivery_charge" class="form-control @error('delivery_charge') is-invalid @enderror" value="{{ old('delivery_charge', $order->city == 'dhaka' ? $order->product->delivery_charge_in : $order->product->delivery_charge_out) }}" required>
                                @error('delivery_charge')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Quantity -->
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Quantity</label>
                            <div class="col-md-9">
                                <input type="number" name="qty" id="qty" class="form-control @error('qty') is-invalid @enderror" value="{{ old('qty', $order->qty) }}" required>
                                @error('qty')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- City -->
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">City</label>
                            <div class="col-md-9">
                                <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city', $order->city) }}" required>
                                @error('city')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Address</label>
                            <div class="col-md-9">
                                <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" rows="3" required>{{ old('address', $order->address) }}</textarea>
                                @error('address')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Status</label>
                            <div class="col-md-9">
                                <select name="status" class="form-control @error('status') is-invalid @enderror" required onchange="this.form.submit()">
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="placed" {{ $order->status == 'placed' ? 'selected' : '' }}>Placed</option>
                                </select>
                                @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"></label>
                            <div class="col-md-9">
                                <button type="submit" class="btn btn-primary">Update Order</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
