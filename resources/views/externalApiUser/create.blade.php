@extends('layouts.admin')

@section('title', 'Add External API User')

@section('content')
    <div class="row">
        <div class="spacer-50"></div>
        <h2 class="center-text">Add External API User</h2>
        <div class="spacer-20"></div>
        <div class="card">
            <div class="card-header">Add External  API User</div>
            <div class="card-block">
                {!! Form::open(['route' => 'externalApiUser.store', 'method' => 'post']) !!}
                    @include('externalApiUser.form')
                    <div class="col-md-12">
                        {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
                        {!! link_to_route('externalApiUser.index', "Cancel", [], ['class' => 'btn btn-secondary', 'role' => 'button']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
