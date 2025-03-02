@extends('master.app')
@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">{{ __('All User List') }}</div>
            <div class="card-body">
                <label class="col-md-6">
                    <input type="text" class="form-control bg-white" name="categorySearch" id="categorySearch"  placeholder="Search"/>
                </label>
                @if(Session::get('message'))
                    <div class="alert alert-success alert-dismissible col-md-5">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> {{Session::get('message')}}</h5>
                    </div>
                @endif
                <a class="float-right btn bg-gradient-teal text-light mb-2" href="{{route('export-users-data')}}">Export as CSV</a>
                <table class="table table-striped" id="myTable">
                    <thead class="bg-gradient-teal">
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Number</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $val)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$val->name}}</td>
                            <td>{{$val->role->name}}</td>
                            <td>{{$val->phoneNumber}}</td>
                            <td>
                                <i class="fa fa-circle fa-xs mt-2 {{$val->status==0?'text-warning':'text-success'}}"></i>
                                {{$val->status==0?'Inactive':'Active'}}
                            </td>
                            <td>
                                <a href="{{route('user-status-update',['id'=>$val->id])}}" class="btn {{$val->status==0?'btn-warning':'btn-success'}} {{auth()->user()->roleId!=1?'disabled':''}} btn-sm mx-1" title="Update Status">
                                    <i class="fa fa-arrow-right "></i>
                                </a>
                                <a href="{{route('user-delete',['id'=>$val->id])}}" class="btn btn-danger {{auth()->user()->roleId!=1?'disabled':''}} btn-sm mx-1" title="Delete">
                                    <i class="fa fa-trash "></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
{{--    <script>--}}
{{--        function myFunction() {--}}
{{--            var input, filter, table, tr, td, i, txtValue;--}}
{{--            input = document.getElementById("categorySearch");--}}
{{--            filter = input.value.toUpperCase();--}}
{{--            table = document.getElementById("myTable");--}}
{{--            tr = table.getElementsByTagName("tr");--}}
{{--            for (i = 0; i < tr.length; i++) {--}}
{{--                td = tr[i].getElementsByTagName("td")[1];--}}
{{--                if (td) {--}}
{{--                    txtValue = td.textContent || td.innerText;--}}
{{--                    if (txtValue.toUpperCase().indexOf(filter) > -1) {--}}
{{--                        tr[i].style.display = "";--}}
{{--                    } else {--}}
{{--                        tr[i].style.display = "none";--}}
{{--                    }--}}
{{--                }--}}
{{--            }--}}
{{--        }--}}
{{--    </script>--}}
@endsection
