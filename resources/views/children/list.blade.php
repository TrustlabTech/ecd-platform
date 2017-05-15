@extends('layouts.admin')

@section('title', 'Children')

@section('content')
    <div class="spacer-50"></div>
    @if($search != true)
        <h2 class="center-text">Children</h2>
    @else
        <h2 class="center-text">Children - {{$phrase}}
            @if($children->count() === 0)
                - No Results Found
            @endif
        </h2>
    @endif
    <div class="spacer-20"></div>
    <div class="row">
        {!! Form::open(['route' => 'child.search', 'method' => 'get']) !!}
            <div class="col-md-12">
                <div class="col-md-7">
                    <div class="btn-group">
                        {!! link_to_route('child.create', "Add Child", [], ['class' => 'btn btn-primary', 'role' => 'button']) !!}
                    </div>
                    <div class="btn-group">
                        <div class="dropdown show">
                            <a class="btn btn-secondary dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Reports
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                {!! link_to_route('child.withoutId', "Without ID number", [], ['class' => 'dropdown-item']) !!}
                                {!! link_to_route('child.invalidId', "Invalid ID number", [], ['class' => 'dropdown-item']) !!}
                            </div>
                        </div>
                    </div>
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
                <th>ID Number</th>
                <th>Centre</th>
                <th>Class</th>
                <th>Subsidy</th>
                <th>#</th>
            </thead>
            <tbody>
                @foreach($children as $child)
                <tr>
                    <td>{{$child->id}}</td>
                    <td>{{$child->given_name}}</td>
                    <td>{{$child->family_name}}</td>
                    <td>{{$child->id_number}}</td>
                    <td>{{$child->centreClass->centre->name}}</td>
                    <td>{{$child->centreClass->name}}</td>
                    <td>
                        @if ($child->subsidy === 1)
                            Yes
                        @elseif ($child->subsidy === 0)
                            No
                        @else
                            Unknown
                        @endif
                    </td>
                    <td>
                        {!! link_to_route('child.edit', "Edit", ['staff' => $child->id], ['class' => 'btn btn-info btn-sm', 'role' => 'button']) !!}
                        {!! link_to_route('child.delete', "Delete", ['staff' => $child->id], ['class' => 'btn btn-danger btn-sm', 'role' => 'button']) !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($search != true)
        <div class="text-xs-center">
            {!! $children->render(new \Illuminate\Pagination\BootstrapFourPresenter($children)) !!}
        </div>
    @endif
@endsection
