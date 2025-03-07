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
                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-gradient-teal text-white">
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Deliver Charge</th>
                            <th>Required Advanced</th>
                            <th>Color-Size</th>
                            <th>Status</th>
                            <th>Image</th> <!-- New column for the image -->
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $val)
                            <tr>
                                <td>{{ $val->id }}</td>
                                <td>{{ $val->product_name }}</td>
                                <td>{{ $val->category_name }}</td>
                                <td>{{ $val->price }}</td>
                                <td>{{ $val->delivery_charge }}</td>
                                <td>{{ $val->required_advance }}</td>
                                <td>{{ $val->color }}-{{ $val->size }}</td>
                                <td>{{ $val->status }}</td>
                                <!-- Display the product image -->
                                <td>
                                    @if($val->product_image)
                                        <img src="{{ asset('storage/' . $val->product_image) }}"  width="50" height="50">
                                    @else
                                        <span>No Image</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <!-- Edit and Delete buttons -->
                                    <a href="{{ route('product.edit',['product' => $val->id])}}" class="btn btn-info btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('product.destroy', ['product' => $val->id]) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm mx-2" onclick="return confirm('Are you sure you want to delete this product?');">
                                            <i class="fa fa-trash"></i>
                                        </button>
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
