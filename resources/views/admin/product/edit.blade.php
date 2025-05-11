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
                                <input type="text" required class="form-control" name="product_name" value="{{ old('product_name', $product->product_name) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Product Category<i class="text-danger">*</i></label>
                            <div class="col-md-9">
                                <select required class="form-control" name="category_id">
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Price<i class="text-danger">*</i></label>
                            <div class="col-md-9">
                                <input type="number" required class="form-control" name="price" value="{{ old('price', $product->price) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Purchase Price <i class="text-danger">*</i></label>
                            <div class="col-md-9">
                                <input type="number" required class="form-control" name="purchase_price" value="{{ old('purchase_price', $product->purchase_price) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">
                                Delivery Charge Inside Dhaka <i class="text-danger"></i>
                            </label>
                            <div class="col-md-9">
                                <input
                                    type="number"
                                    class="form-control"
                                    name="delivery_charge_in"
                                    value="{{ old('delivery_charge_in', $product->delivery_charge_in ) }}"
                                >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">
                                Delivery Charge Outside Dhaka <i class="text-danger"></i>
                            </label>
                            <div class="col-md-9">
                                <input
                                    type="number"
                                    class="form-control"
                                    name="delivery_charge_out"
                                    value="{{ old('delivery_charge_out', $product->delivery_charge_out ) }}"
                                >
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Image</label>
                            <div class="col-md-9">
                                <input type="file" class="form-control" name="image">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="100">
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label>Existing Additional Images:</label><br>
                              <div class="col-md-9">
                                  <input type="file" class="form-control" name="additional_images[]" multiple>
                                 @if($product->additional_images)
                                    @foreach(json_decode($product->additional_images, true) as $key => $image)
                                       <div style="display:inline-block; margin:10px; position:relative;">
                                            <img src="{{ asset('storage/'.$image) }}" width="100" height="100" style="object-fit:cover;">
                                            <input type="checkbox" name="remove_additional_images[]" value="{{ $image }}" style="position:absolute; top:0; left:0;">
                                            <small style="display:block; text-align:center;">Remove</small>
                                       </div>
                                    @endforeach
                                @endif
                              </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Color (if any)</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="color" value="{{ old('color', $product->color) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Size (if any)</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="size" value="{{ old('size', $product->size) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Required Advance<i class="text-danger">*</i></label>
                            <div class="col-md-9">
                                <select required class="form-control" name="required_advance">
                                    <option value="deli" {{ $product->required_advance == 'deli' ? 'selected' : '' }}>Delivery Charge</option>
                                    <option value="all" {{ $product->required_advance == 'all' ? 'selected' : '' }}>All price including DC</option>
                                    <option value="price" {{ $product->required_advance == 'price' ? 'selected' : '' }}>Only price</option>
                                    <option value="none" {{ $product->required_advance == 'none' ? 'selected' : '' }}>COD</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Status<i class="text-danger">*</i></label>
                            <div class="col-md-9">
                                <select required class="form-control" name="status">
                                    <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    <option value="out_of_stock" {{ $product->status == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                                    <option value="discontinued" {{ $product->status == 'discontinued' ? 'selected' : '' }}>Discontinued</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Stock</label>
                            <div class="col-md-9">
                                <input type="number" class="form-control" name="stock" value="{{ old('stock', $product->stock) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Product Description</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="description" rows="4">{{ old('description', $product->description) }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"></label>
                            <div class="col-md-9">
                                <input type="submit" class="btn btn-primary" value="Update Product">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
