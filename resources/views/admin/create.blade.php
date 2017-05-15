@extends('layouts.admin')

@section('title', 'Add Administrator')

@section('content')
    <div class="row">
        <div class="spacer-50"></div>
        <h2 class="center-text">Add Administrator</h2>
        <div class="spacer-20"></div>
        <div class="card">
            <div class="card-header">Add Administrator</div>
            <div class="card-block">
                {!! Form::open(['route' => 'admin.store', 'method' => 'post']) !!}
                    @include('admin.form')
                    <div class="col-md-12">
                        {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
                        {!! link_to_route('admin.index', "Cancel", [], ['class' => 'btn btn-secondary', 'role' => 'button']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
