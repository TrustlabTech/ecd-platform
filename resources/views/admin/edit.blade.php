@extends('layouts.admin')

@section('title', 'Edit Administrator')

@section('content')
    <div class="row">
        <div class="spacer-50"></div>
        <h2 class="center-text">Edit Administrator</h2>
        <div class="spacer-20"></div>
        <div class="card">
            <div class="card-header">Edit Administrator</div>
            <div class="card-block">
                {!! Form::open(['route' => ['admin.update', $admin->id], 'method' => 'patch']) !!}
                    @include('admin.form')
                    <div class="col-md-12">
                        {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                        {!! link_to_route('admin.index', "Cancel", [], ['class' => 'btn btn-secondary', 'role' => 'button']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
