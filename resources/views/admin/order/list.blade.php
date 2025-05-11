@extends('admin.master.app')

@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <h3>{{ __('All Product List') }}</h3>
            </div>
            <div class="card-body">
                @if(Session::get('message'))
                    <div class="alert alert-success alert-dismissible col-md-5">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> {{ Session::get('message') }}</h5>
                    </div>
                @endif

                <!-- Add new product button -->
                <a class="float-right btn bg-gradient-teal btn-sm mb-3" href="{{ route('product.create') }}">
                    <i class="fa fa-plus text-light"></i>
                </a>
                    @foreach($errors->any as $err)
                        {{$err}}
                    @endforeach

                <!-- Table -->
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
                            <th class="text-center">Actions</th>
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
                                    <form action="{{ route('order.updateStatus', ['order' => $val->id]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <div style="position: relative; width: 160px;">
                                            <select name="status"
                                                    class="form-control form-control-sm @error('status') is-invalid @enderror"
                                                    style="
                                                            font-size: 14px;
                                                            padding: 6px 30px 6px 10px;
                                                            height: 36px;
                                                            width: 100%;
                                                            border-radius: 6px;
                                                            background-color: #f9f9f9;
                                                            text-align-last: center;
                                                            cursor: pointer;
                                                            appearance: none;
                                                            -webkit-appearance: none;
                                                            -moz-appearance: none;
                                                            background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22%23666%22 stroke-width=%222%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22><polyline points=%226 9 12 15 18 9%22/></svg>');
                                                            background-repeat: no-repeat;
                                                            background-position: right 10px center;
                                                            background-size: 16px 16px;
                                                            transition: all 0.3s ease;"
                                                            onchange="this.form.submit()"
                                                            required>
                                                <option value="processing" {{ $val->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                                <option value="cancelled" {{ $val->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                <option value="delivered" {{ $val->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                                <option value="pending" {{ $val->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="placed" {{ $val->status == 'placed' ? 'selected' : '' }}>Placed</option>
                                            </select>
                                        </div>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <!-- Edit and Delete buttons -->
                                    <a href="{{ route('order.edit', ['order' => $val->id]) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('order.destroy', ['order' => $val->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
