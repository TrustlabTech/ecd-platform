@extends('layouts.admin')

@section('title', 'Administrators')

@section('content')
    <div class="spacer-50"></div>
    <h2 class="center-text">Administrators</h2>
    <div class="spacer-20"></div>
    {!! link_to_route('admin.create', "Add Administrator", [], ['class' => 'btn btn-primary', 'role' => 'button']) !!}
    <div class="spacer-20"></div>
    <div class="table-bg">
        <table class="table table-bordered">
            <thead>
                <th>ID</th>
                <th>Email</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>#</th>
            </thead>
            <tbody>
                @foreach($administrators as $administrator)
                    <tr>
                        <td>{{$administrator->id}}</td>
                        <td>{{$administrator->user->email}}</td>
                        <td>{{$administrator->first_name}}</td>
                        <td>{{$administrator->last_name}}</td>
                        <td>
                            {!! link_to_route('admin.edit', "Edit", ['admin' => $administrator->id], ['class' => 'btn btn-info btn-sm', 'role' => 'button']) !!}
                            {!! link_to_route('admin.delete', "Delete", ['admin' => $administrator->id], ['class' => 'btn btn-danger btn-sm', 'role' => 'button']) !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="text-xs-center">
        {!! $administrators->render(new \Illuminate\Pagination\BootstrapFourPresenter($administrators)) !!}
    </div>
@endsection
