@extends('admin.master.app')

@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <h3>{{ __('All Category List') }}</h3>
            </div>
            <div class="card-body">
                @if(Session::get('message'))
                    <div class="alert alert-success alert-dismissible col-md-5">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> {{ Session::get('message') }}</h5>
                    </div>
                @endif

                <!-- Add new category button -->
                <a class="float-right btn bg-gradient-teal btn-sm mb-3" href="{{ route('categories.create') }}">
                    <i class="fa fa-plus text-light"></i> Add New Category
                </a>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-gradient-teal text-white">
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            @extends('admin.master.app')

                            @section('content')
                                <div class="content-wrapper">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3>{{ __('All Category List') }}</h3>
                                        </div>
                                        <div class="card-body">
                                            @if(Session::get('message'))
                                                <div class="alert alert-success alert-dismissible col-md-5">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    <h5><i class="icon fas fa-check"></i> {{ Session::get('message') }}</h5>
                                                </div>
                                            @endif

                                            <!-- Add new category button -->
                                                <a class="float-right btn bg-gradient-teal btn-sm mb-2" href="{{route('categories.create')}}"><i class="fa fa-plus text-light"></i></a>

                                            <!-- Table -->
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover">
                                                    <thead class="bg-gradient-teal text-white">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Category Name</th>
                                                        <th class="text-center">Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($categories as $cat)
                                                        <tr>
                                                            <td>{{ $cat->id }}</td>
                                                            <td>{{ $cat->category_name }}</td>
                                                            <td class="text-center">
                                                                <!-- Edit and Delete buttons -->
                                                                <a href="{{ route('category.edit', ['category'=> $cat->id]) }}" class="btn btn-info btn-sm mx-1">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <a href="{{ route('category.destroy',['category' => $cat->id]) }}" class="btn btn-danger btn-sm mx-1" onclick="return confirm('Are you sure you want to delete this category?');">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
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
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $cat)
                            <tr>
                                <td>{{ $cat->category_name }}</td>
                                <td class="text-center">
                                    <!-- Edit and Delete buttons -->
                                    <a href="{{ route('category.edit', ['category' => $cat->id]) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <a href="{{ route('delete.category', ['id' => $cat->id]) }}" class="btn btn-danger btn-sm mx-2" onclick="return confirm('Are you sure you want to delete this category?');">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>

                                    <form action="{{route('category.destroy',['category' => $cat->id])}}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-rounded" style="min-width: 10px!important;" onclick="return confirm('Are you sure you want to delete this category?');">
                                            <i class="fas fa-trash-alt"></i>
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
