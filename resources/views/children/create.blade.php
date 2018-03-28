@extends('layouts.admin')

@section('title', 'Add Child')

@section('content')
    <div class="row">
        <div class="spacer-50"></div>
        <h2 class="center-text">Add Child</h2>
        <div class="spacer-20"></div>
        <div class="card">
            <div class="card-header">Add Child</div>
            <div class="card-block">
                {!! Form::hidden('tim_id_url', route('child.addFetchByTIM'), ['id' => 'tim_id_url']) !!}
                {!! Form::open(['route' => 'child.store', 'method' => 'post']) !!}
                    @include('children.form',['editableID'=>false])
                    <div class="col-md-12">
                        {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
                        {!! link_to_route('child.index', "Cancel", [], ['class' => 'btn btn-secondary', 'role' => 'button']) !!}
                        {!! Form::button('Fetch By ID', ['class' => 'btn btn-info', 'id' => 'button-tim']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/id-checker.js"></script>
    <script src="/js/moment.min.js"></script>
    <script src="/js/combodate.js"></script>
    <script src="/js/select2.min.js"></script>
    <script src="{{ elixir('js/app.js') }}"></script>
    <link rel="stylesheet" type="text/css"  href="/css/select2.min.css" />
    <link rel="stylesheet" type="text/css"  href="/css/font-awesome.min.css" />
@endsection
