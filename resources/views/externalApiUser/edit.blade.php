@extends('layouts.admin')

@section('title', 'Edit External API User')

@section('content')
    <div class="row">
        <div class="spacer-50"></div>
        <h2 class="center-text">Edit External API User</h2>
        <div class="spacer-20"></div>
        <div class="card">
            <div class="card-header">Edit External API User</div>
            <div class="card-block">
                {!! Form::open(['route' => ['externalApiUser.update', $user->id], 'method' => 'patch']) !!}
                    @include('externalApiUser.form')
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            {!! Form::label('token', 'Token', ['class' => 'col-md-5 col-form-label']); !!}
                            <div class="col-md-12">
                                <textarea class="form-control" rows="4" readonly>{{ $user->username }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                            {!! link_to_route('externalApiUser.refreshToken', "Refresh Token", ['user' => $user->id], ['class' => 'btn btn-info', 'role' => 'button']) !!}
                            {!! link_to_route('externalApiUser.index', "Cancel", [], ['class' => 'btn btn-secondary', 'role' => 'button']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
