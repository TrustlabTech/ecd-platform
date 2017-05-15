@extends('layouts.admin')

@section('title', 'Add Class')

@section('content')
    <div class="row">
        <div class="spacer-50"></div>
        <h2 class="center-text">Add Class</h2>
        <div class="spacer-20"></div>
        <div class="card">
            <div class="card-header">Add Class</div>
            <div class="card-block">
                {!! Form::open(['route' => 'centreClass.store', 'method' => 'post']) !!}
                    @include('centreClass.form')
                    <div class="col-md-12">
                        {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
                        {!! link_to_route('centreClass.index', "Cancel", [], ['class' => 'btn btn-secondary', 'role' => 'button']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/combodate.js"></script>
    <script src="/js/select2.min.js"></script>
    <script src="{{ elixir('js/app.js') }}"></script>
    <link rel="stylesheet" type="text/css"  href="/css/select2.min.css" />
@endsection
