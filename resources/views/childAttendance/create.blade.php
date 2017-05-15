@extends('layouts.admin')

@section('title', 'Add Attendance')

@section('content')
    <div class="row">
        <div class="spacer-50"></div>
        <h2 class="center-text">Add Attendance</h2>
        <div class="spacer-20"></div>
        <div class="card">
            <div class="card-header">Add Attendance</div>
            <div class="card-block">
                {!! Form::open(['route' => 'childAttendance.store', 'method' => 'post']) !!}
                    @include('childAttendance.form')
                    <div class="col-md-12">
                        {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
                        {!! link_to_route('childAttendance.index', "Cancel", [], ['class' => 'btn btn-secondary', 'role' => 'button']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/moment.min.js"></script>
    <script src="/js/combodate.js"></script>
    <script src="/js/select2.min.js"></script>
    <script src="{{ elixir('js/attendance.js') }}"></script>
    <link rel="stylesheet" type="text/css"  href="/css/select2.min.css" />
    <link rel="stylesheet" type="text/css"  href="/css/font-awesome.min.css" />
@endsection
