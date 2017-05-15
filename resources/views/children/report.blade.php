@extends('layouts.admin')

@section('title', 'Children')

@section('content')
    <div class="spacer-50"></div>
        <h2 class="center-text">{{ $heading }}: {{ $children->count() }}</h2>
    <div class="spacer-20"></div>
    <div class="col-md-7">
        <div class="btn-group no-print">
            {!! link_to_route('child.index', "Go Back", [], ['class' => 'btn btn-primary', 'role' => 'button']) !!}
        </div>
        <div class="btn-group no-print">
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
    <div class="spacer-50"></div>
    <div class="clearfix"></div>
    <div class="table-bg">
        <table class="table table-bordered">
            <thead>
                <th>ID</th>
                <th>Given Name</th>
                <th>Family Name</th>
                <th>Centre</th>
                <th>Class</th>
                <th class="no-print">#</th>
            </thead>
            <tbody>
                @foreach($children as $child)
                <tr>
                    <td>{{$child->id}}</td>
                    <td>{{$child->given_name}}</td>
                    <td>{{$child->family_name}}</td>
                    <td>{{$child->centreClass->centre->name}}</td>
                    <td>{{$child->centreClass->name}}</td>
                    <td class="no-print">
                        {!! link_to_route('child.edit', "Edit", ['staff' => $child->id], ['class' => 'btn btn-info btn-sm', 'role' => 'button']) !!}
                        {!! link_to_route('child.delete', "Delete", ['staff' => $child->id], ['class' => 'btn btn-danger btn-sm', 'role' => 'button']) !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="spacer-20"></div>
@endsection
