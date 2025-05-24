@extends('admin.master.app')
@section('content')
    <div class="content-wrapper">
        <div class="col-md-7 py-5 mx-auto">
            <div class="card card-primary card-outline">
                <div class="card-header text-center">{{ __('Add Product Form') }}</div>
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
                    <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Product Name<i class="text-danger">*</i></label>
                            <div class="col-md-9">
                                <input type="text" required class="form-control" name="product_name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Product Category<i class="text-danger">*</i></label>
                            <div class="col-md-9">
                                <select required class="form-control" name="category_id">
                                    <option value="">Select</option>
                                    @foreach($categories as $cat)
                                        <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Sub Category</label>
                            <div class="col-md-9">
                                <select class="form-control" name="sub_category_id">
                                    <option value="">Select</option>
                                    @foreach($subcategories as $sub)
                                        <option value="{{ $sub->id }}">{{ $sub->sub_category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Price<i class="text-danger">*</i></label>
                            <div class="col-md-9">
                                <input type="number" required class="form-control" name="price">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Purchase Price <i class="text-danger">*</i></label>
                            <div class="col-md-9">
                                <input type="number" required class="form-control" name="purchase_price" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Delivery Charge Inside Dhaka<i class="text-danger"></i></label>
                            <div class="col-md-9">
                                <input type="number"  class="form-control" name="delivery_charge_in">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Delivery Charge Outside  Dhaka <i class="text-danger"></i></label>
                            <div class="col-md-9">
                                <input type="number"  class="form-control" name="delivery_charge_out">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Image<i class="text-danger">*</i></label>
                            <div class="col-md-9">
                                <input type="file" required class="form-control" name="image">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Additional Images<i class="text-danger">*</i></label>
                            <div class="col-md-9">
                                <input type="file" required class="form-control" name="additional_images[]" multiple>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Color (if any)</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="color">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Size  (if any)</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="size">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Required Advance<i class="text-danger">*</i></label>
                            <div class="col-md-9">
                                <select required class="form-control" name="required_advance">
                                    <option value="deli">Delivery Charge</option>
                                    <option value="all">All price including DC</option>
                                    <option value="price">Only price</option>
                                    <option value="none">COD</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Status<i class="text-danger">*</i></label>
                            <div class="col-md-9">
                                <select required class="form-control" name="status">
                                    <option selected>active</option>
                                    <option>inactive</option>
                                    <option>out_of_stock</option>
                                    <option>discontinued</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Stock</label>
                            <div class="col-md-9">
                                <input type="number" class="form-control" name="stock" placeholder="Enter stock quantity">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Product Description</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="description" rows="4" placeholder="Enter product details..."></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"></label>
                            <div class="col-md-9">
                                <input type="submit" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    import FindUrl from "../../js/components/FindUrl";
    export default {
        components: {FindUrl}
    }
</script>
@section('script')
    <script>
        $(document).ready(function() {
            $('#categorySelect').on('change', function() {
                const categoryId = $(this).val();
                const subCategorySelect = $('#subCategorySelect');

                // Clear and show loading
                subCategorySelect.html('<option value="">Loading...</option>');

                if (categoryId) {
                    $.ajax({
                        url: '/admin/get-subcategories/' + categoryId,
                        type: 'GET',
                        success: function(response) {
                            if(response.length > 0) {
                                let options = '<option value="">Select Sub Category</option>';
                                $.each(response, function(key, subcategory) {
                                    options += `<option value="${subcategory.id}">${subcategory.sub_category_name}</option>`;
                                });
                                subCategorySelect.html(options);
                            } else {
                                subCategorySelect.html('<option value="">No subcategories found</option>');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                            subCategorySelect.html('<option value="">Error loading subcategories</option>');
                        }
                    });
                } else {
                    subCategorySelect.html('<option value="">Select Category First</option>');
                }
            });
        });
    </script>
@endsection
