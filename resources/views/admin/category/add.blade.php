@extends('admin.master.app')
@section('content')
    <div class="content-wrapper">
        <div class="col-md-7 py-5 mx-auto">
            <div class="card card-primary card-outline">
                <div class="card-header text-center">{{ __('Add Category Form') }}</div>
                <div class="card-body">
                    <form action="{{route('category.store')}}" method="post" >
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Category Name<i class="text-danger">*</i></label>
                            <div class="col-md-9">
                                <input type="text" required class="form-control" name="category_name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Scale</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="scale">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"></label>
                            <div class="col-md-9">
                                <input type="submit" class="btn btn-primary" value="Submit" >
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

