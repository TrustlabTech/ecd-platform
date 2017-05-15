@extends('layouts.admin')

@section('title', 'Classes')

@section('content')
    <div class="spacer-50"></div>
    @if($search != true)
        <h2 class="center-text">Classes</h2>
    @else
        <h2 class="center-text">Classes - {{$phrase}}
            @if($centreClasses->count() === 0)
                - No Results Found
            @endif
        </h2>
    @endif
    <div class="spacer-20"></div>
    <div class="row">
        {!! Form::open(['route' => 'centreClass.search', 'method' => 'get']) !!}
            <div class="col-md-12">
                <div class="col-md-7">
                    {!! link_to_route('centreClass.create', "Add Class", [], ['class' => 'btn btn-primary', 'role' => 'button']) !!}
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
                <th>Name</th>
                <th>Centre</th>
                <th>#</th>
            </thead>
            <tbody>
                @foreach($centreClasses as $centreClass)
                    <tr>
                        <td>{{$centreClass->id}}</td>
                        <td>{{$centreClass->name}}</td>
                        <td>{{$centreClass->centre->name}}</td>
                        <td>
                            {!! link_to_route('centreClass.edit', "Edit", ['centre' => $centreClass->id], ['class' => 'btn btn-info btn-sm', 'role' => 'button']) !!}
                            {!! link_to_route('centreClass.delete', "Delete", ['centre' => $centreClass->id], ['class' => 'btn btn-danger btn-sm', 'role' => 'button']) !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($search != true)
        <div class="text-xs-center">
            {!! $centreClasses->render(new \Illuminate\Pagination\BootstrapFourPresenter($centreClasses)) !!}
        </div>
    @endif
@endsection
