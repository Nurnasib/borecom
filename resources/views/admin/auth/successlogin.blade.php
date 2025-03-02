@extends('admin.master.app')

@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">{{ __('Dashboard') }}</div>

            <div class="card-body">
                <h2>{{Auth::user()->name}} -You are logged in</h2>
            </div>
        </div>
    </div>
@endsection
