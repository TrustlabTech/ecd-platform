@extends('layouts.admin')

@section('title', 'Attendance')

@section('content')
    <div class="spacer-50"></div>
    <h2 class="center-text">Attendance</h2>
    <div class="spacer-20"></div>
    {!! link_to_route('childAttendance.create', "Add Individual Attendance", [], ['class' => 'btn btn-primary', 'role' => 'button']) !!}
    {!! link_to_route('childAttendance.createByClass', "Add Class Attendance", [], ['class' => 'btn btn-primary', 'role' => 'button']) !!}
    <div class="spacer-20"></div>
    <div class="table-bg">
        <table class="table table-bordered">
            <thead>
                <th>ID</th>
                <th>Date</th>
                <th>Child</th>
                <th>Class</th>
                <th>Attended</th>
                <th>#</th>
            </thead>
            <tbody>
                @foreach($childAttendances as $attendance)
                <tr>
                    <td>{{$attendance->id}}</td>
                    <td>{{$attendance->created_at}}</td>
                    <td>{{$attendance->children->given_name}} {{$attendance->children->family_name}}</td>
                    <td>{{$attendance->children->centreClass->name}}</td>
                    <td>{{$attendance->attended === 0 ? "No" : "Yes"}}</td>
                    <td>
                        {!! link_to_route('childAttendance.edit', "Edit", ['childAttendance' => $attendance->id], ['class' => 'btn btn-info btn-sm', 'role' => 'button']) !!}
                        {!! link_to_route('childAttendance.delete', "Delete", ['childAttendance' => $attendance->id], ['class' => 'btn btn-danger btn-sm', 'role' => 'button']) !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="text-xs-center">
        {!! $childAttendances->render(new \Illuminate\Pagination\BootstrapFourPresenter($childAttendances)) !!}
    </div>
@endsection
