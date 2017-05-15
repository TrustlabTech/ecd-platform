@extends('layouts.admin')

@section('title', 'Add External User')

@section('content')
    <div class="row">
        <div class="spacer-50"></div>
        <h2 class="center-text">Add External User</h2>
        <div class="spacer-20"></div>
        <div class="card">
            <div class="card-header">Add External User</div>
            <div class="card-block">
                {!! Form::open(['route' => 'externalUser.store', 'method' => 'post']) !!}
                    @include('externalUser.form')
                    <div class="col-md-12">
                        {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
                        {!! link_to_route('externalUser.index', "Cancel", [], ['class' => 'btn btn-secondary', 'role' => 'button']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
