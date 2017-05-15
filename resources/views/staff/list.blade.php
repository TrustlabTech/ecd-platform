@extends('layouts.admin')

@section('title', 'Staff')

@section('content')
    <div class="spacer-50"></div>
    @if($search != true)
        <h2 class="center-text">Staff</h2>
    @else
        <h2 class="center-text">Staff - {{$phrase}}
            @if($staff->count() === 0)
                - No Results Found
            @endif
        </h2>
    @endif
    <div class="spacer-20"></div>

    <div class="row">
        {!! Form::open(['route' => 'staff.search', 'method' => 'get']) !!}
            <div class="col-md-12">
                <div class="col-md-7">
                    {!! link_to_route('staff.create', "Add Staff", [], ['class' => 'btn btn-primary', 'role' => 'button']) !!}
                </div>
                <div class="col-md-5">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="col-md-9">
                                {!! Form::text('p', '', ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-3">
                                {!! Form::submit('Search', ['class' => 'btn btn-info']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
    <div class="clearfix"></div>
    <div class="table-bg">
        <table class="table table-bordered">
            <thead>
                <th>ID</th>
                <th>Given Name</th>
                <th>Family Name</th>
                <th>ZA ID Number</th>
                <th>Phone Number</th>
                <th>Centre</th>
                <th>#</th>
            </thead>
            <tbody>
                @foreach($staff as $facilitator)
                <tr>
                    <td>{{$facilitator->id}}</td>
                    <td>{{$facilitator->given_name}}</td>
                    <td>{{$facilitator->family_name}}</td>
                    <td>{{$facilitator->za_id_number}}</td>
                    <td>{{$facilitator->user->username}}</td>
                    <td>{{$facilitator->centre->name}}</td>
                    <td>
                        {!! link_to_route('staff.edit', "Edit", ['staff' => $facilitator->id], ['class' => 'btn btn-info btn-sm', 'role' => 'button']) !!}
                        {!! link_to_route('staff.delete', "Delete", ['staff' => $facilitator->id], ['class' => 'btn btn-danger btn-sm', 'role' => 'button']) !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($search != true)
        <div class="text-xs-center">
            {!! $staff->render(new \Illuminate\Pagination\BootstrapFourPresenter($staff)) !!}
        </div>
    @endif
@endsection
