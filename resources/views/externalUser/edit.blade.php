@extends('layouts.admin')

@section('title', 'Edit External User')

@section('content')
    <div class="row">
        <div class="spacer-50"></div>
        <h2 class="center-text">Edit External User</h2>
        <div class="spacer-20"></div>
        <div class="card">
            <div class="card-header">Edit External User</div>
            <div class="card-block">
                {!! Form::open(['route' => ['externalUser.update', $user->id], 'method' => 'patch']) !!}
                    @include('externalUser.form')
                    <div class="col-md-12">
                        {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                        {!! link_to_route('externalUser.index', "Cancel", [], ['class' => 'btn btn-secondary', 'role' => 'button']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
