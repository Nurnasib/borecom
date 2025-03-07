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
                    <i class="fa fa-plus text-light"></i>
                </a>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-gradient-teal text-white">
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Scale</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories->unique('category_name') as $cat)
                            <tr>
                                <td>{{ $cat->id }}</td>
                                <td>{{ $cat->category_name }}</td>
                                <td>{{ $cat->scale }}</td>
                                <td class="text-center">
                                    <a href="{{ route('category.edit', ['category'=> $cat->id]) }}" class="btn btn-info btn-sm mx-1">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <form action="{{route('category.destroy',['category' => $cat->id])}}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm mx-1" style="min-width: 10px!important;" onclick="return confirm('Are you sure you want to delete this category?');">
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
