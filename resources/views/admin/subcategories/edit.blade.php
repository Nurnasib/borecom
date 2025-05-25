@extends('admin.master.app')
@section('content')
    <div class="content-wrapper">
        <div class="col-md-7 py-5 mx-auto">
            <div class="card card-primary card-outline">
                <div class="card-header text-center">{{ __('Edit Sub-category Form') }}</div>
                <div class="card-body">
                    <form action="{{ route('subcategories.update', $subcategory->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Sub-category Name</label>
                            <div class="col-md-9">
                                <input type="text" required class="form-control" name="sub_category_name" value="{{ $subcategory->sub_category_name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Category</label>
                            <div class="col-md-9">
                                <select name="category_id" class="form-control">
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ $cat->id == $subcategory->category_id ? 'selected' : '' }}>
                                            {{ $cat->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Status</label>
                            <div class="col-md-9">
                                <select name="status" class="form-control">
                                    <option value="active" {{ (isset($subcategory) && $subcategory->status == 'active') ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ (isset($subcategory) && $subcategory->status == 'inactive') ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Note</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="note">{{ $subcategory->note }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"></label>
                            <div class="col-md-9">
                                <input type="submit" class="btn btn-primary" value="Update" >
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
