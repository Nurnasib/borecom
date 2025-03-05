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
                    <form action="{{route('product.store')}}" method="post" >
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
                                    @foreach($categories as $cat)
                                    <option value="{{$cat->id}}">{{$cat->category_name}}</option>
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
                            <label class="col-md-3 col-form-label">Delivery Charge<i class="text-danger">*</i></label>
                            <div class="col-md-9">
                                <input type="number" required class="form-control" name="delivery_charge">
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
                                    <option selected>deli</option>
                                    <option>all</option>
                                    <option>price</option>
                                    <option>none</option>
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

