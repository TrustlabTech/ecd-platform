@extends('layouts.admin')

@section('title', 'External Web Users')

@section('content')
    <div class="spacer-50"></div>
    <h2 class="center-text">External Web Users</h2>
    <div class="spacer-20"></div>
    {!! link_to_route('externalUser.create', "Add User", [], ['class' => 'btn btn-primary', 'role' => 'button']) !!}
    <div class="spacer-20"></div>
    <div class="table-bg">
        <table class="table table-bordered">
            <thead>
                <th>ID</th>
                <th>Email</th>
                <th>#</th>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            {!! link_to_route('externalUser.edit', "Edit", ['user' => $user->id], ['class' => 'btn btn-info btn-sm', 'role' => 'button']) !!}
                            {!! link_to_route('externalUser.delete', "Delete", ['user' => $user->id], ['class' => 'btn btn-danger btn-sm', 'role' => 'button']) !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
