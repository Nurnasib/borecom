@extends('admin.master.app')

@section('content')
    <div class="content-wrapper">
        <div class="col-md-7 py-5 mx-auto">
            <div class="card card-primary card-outline">
                <div class="card-header text-center">{{ __('Edit Product Form') }}</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div style="color: red;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Product Name<i class="text-danger">*</i></label>
                            <div class="col-md-9">
                                <input type="text" required class="form-control" name="product_name" value="{{ $product->product_name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Product Category<i class="text-danger">*</i></label>
                            <div class="col-md-9">
                                <select required class="form-control" name="category_id">
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ $cat->id == $product->category_id ? 'selected' : '' }}>{{ $cat->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Price<i class="text-danger">*</i></label>
                            <div class="col-md-9">
                                <input type="number" required class="form-control" name="price" value="{{ $product->price }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Delivery Charge<i class="text-danger">*</i></label>
                            <div class="col-md-9">
                                <input type="number" required class="form-control" name="delivery_charge" value="{{ $product->delivery_charge }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Color (if any)</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="color" value="{{ $product->color }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Size (if any)</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="size" value="{{ $product->size }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Required Advance<i class="text-danger">*</i></label>
                            <div class="col-md-9">
                                <select required class="form-control" name="required_advance">
                                    <option value="deli" {{ $product->required_advance == 'deli' ? 'selected' : '' }}>deli</option>
                                    <option value="all" {{ $product->required_advance == 'all' ? 'selected' : '' }}>all</option>
                                    <option value="price" {{ $product->required_advance == 'price' ? 'selected' : '' }}>price</option>
                                    <option value="none" {{ $product->required_advance == 'none' ? 'selected' : '' }}>none</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Status<i class="text-danger">*</i></label>
                            <div class="col-md-9">
                                <select required class="form-control" name="status">
                                    <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>active</option>
                                    <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>inactive</option>
                                    <option value="out_of_stock" {{ $product->status == 'out_of_stock' ? 'selected' : '' }}>out_of_stock</option>
                                    <option value="discontinued" {{ $product->status == 'discontinued' ? 'selected' : '' }}>discontinued</option>
                                </select>
                            </div>
                        </div>
                        <!-- Image Upload Field -->
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Product Image</label>
                            <div class="col-md-9">
                                <input type="file" class="form-control" name="product_image">
                                @if($product->product_image)
                                    <img src="{{ asset('images/' . $product->product_image) }}" alt="Product Image" width="50" height="50">
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"></label>
                            <div class="col-md-9">
                                <input type="submit" class="btn btn-primary" value="Update">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
