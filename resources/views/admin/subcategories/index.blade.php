@extends('admin.master.app')

@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <h3>{{ __('All Sub-category List') }}</h3>
            </div>
            <div class="card-body">
                @if(Session::get('message'))
                    <div class="alert alert-success alert-dismissible col-md-5">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> {{ Session::get('message') }}</h5>
                    </div>
                @endif

                <a class="float-right btn bg-gradient-teal btn-sm mb-3" href="{{ route('subcategories.create') }}">
                    <i class="fa fa-plus text-light"></i>
                </a>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-gradient-teal text-white">
                        <tr>
                            <th>#</th>
                            <th>Sub-category Name</th>
                            <th>Parent Category</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subcategories as $subcat)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $subcat->sub_category_name }}</td>
                                <td>{{ $subcat->category->category_name ?? 'N/A' }}</td>
                                <td>{{ ucfirst($subcat->status) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('subcategories.edit', $subcat->id) }}" class="btn btn-info btn-sm mx-1">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('subcategories.destroy', $subcat->id) }}" method="POST" style="display:inline-block;">


                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm mx-1">
                                            <i class="fa fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $subcategories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
