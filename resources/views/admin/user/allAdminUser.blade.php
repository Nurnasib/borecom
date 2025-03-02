@extends('master.app')
@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">{{ __('All Category List') }}</div>
            <div class="card-body">
                @if(Session::get('message'))
                    <div class="alert alert-success alert-dismissible col-md-5">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> {{Session::get('message')}}</h5>
                    </div>
                @endif
                {{--                <a class="float-right btn bg-gradient-teal btn-sm mb-2" href="{{route('add.category')}}"><i class="fa fa-plus text-light"></i></a>--}}
                <table class="table table-striped">
                    <thead class="bg-gradient-teal">
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Number</th>
                        <th>status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $val)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$val->name}}</td>
                            <td>{{$val->role->name}}</td>
                            <td>{{$val->phoneNumber}}</td>
                            <td>{{$val->status==0?'Inactive':'Active'}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
