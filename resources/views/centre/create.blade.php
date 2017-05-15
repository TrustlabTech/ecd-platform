@extends('layouts.admin')

@section('title', 'Add Centre')

@section('content')
    <div class="row">
        <div class="spacer-50"></div>
        <h2 class="center-text">Add Centre</h2>
        <div class="spacer-20"></div>
        <div class="card">
            <div class="card-header">Add Centre</div>
            <div class="card-block">
                {!! Form::open(['route' => 'centre.store', 'method' => 'post']) !!}
                    @include('centre.form')
                    <div class="col-md-12">
                        {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
                        {!! link_to_route('centre.index', "Cancel", [], ['class' => 'btn btn-secondary', 'role' => 'button']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/moment.min.js"></script>
    <script src="/js/combodate.js"></script>
    <script src="{{ elixir('js/app.js') }}"></script>
    <link rel="stylesheet" type="text/css"  href="/css/font-awesome.min.css" />
@endsection
