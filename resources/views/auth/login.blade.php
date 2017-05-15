@extends('layouts.admin')

@section('title', 'Home')

@section('content')
    <div class="spacer-50"></div>
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">Login</div>
            <div class="card-block">
                {!! Form::open(['url' => URL::route('postLogin'), 'method' => 'post']) !!}
                    <div class="form-group row">
                        {!! Form::label('email', 'Email', [
                            'class' => 'col-md-4 col-form-label'
                        ]); !!}
                        <div class="col-md-8">
                            {!! Form::text('email', '', [
                                'class' => 'form-control',
                                'placeholder' => 'Email'
                            ]);!!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('password', 'Password', [
                            'class' => 'col-md-4 col-form-label'
                        ]); !!}
                        <div class="col-md-8">
                            {!! Form::password('password', [
                                'placeholder' => 'Password',
                                'class' => 'form-control'
                            ]); !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::submit('Login', [
                                'class' => 'btn btn-primary'
                            ]); !!}
                            <a href="{{URL::route('home')}}" role="button" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
