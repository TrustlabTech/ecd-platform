@extends('layouts.admin')

@section('title', 'Centres')

@section('content')
        <div class="spacer-50"></div>
        @if($search != true)
            <h2 class="center-text">Centres</h2>
        @else
            <h2 class="center-text">Centres - {{$phrase}}
                @if($centres->count() === 0)
                    - No Results Found
                @endif
            </h2>
        @endif
        <div class="spacer-20"></div>
        <div class="row">
            {!! Form::open(['route' => 'centre.search', 'method' => 'get']) !!}
                <div class="col-md-12">
                    <div class="col-md-7">
                        {!! link_to_route('centre.create', "Add Centre", [], ['class' => 'btn btn-primary', 'role' => 'button']) !!}
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
                    <th>Sector</th>
                    <th>Street Address</th>
                    <th>Mobile Number</th>
                    <th>#</th>
                </thead>
                <tbody>
                    @foreach($centres as $centre)
                    <tr>
                        <td>{{$centre->id}}</td>
                        <td>{{$centre->name}}</td>
                        <td>{{$centre->sector}}</td>
                        <td>{{ str_limit($centre->street_address, 40, '...') }}</td>
                        <td>{{$centre->mobile_number}}</td>
                        <td>
                            {!! link_to_route('centre.edit', "Edit", ['centre' => $centre->id], ['class' => 'btn btn-info btn-sm', 'role' => 'button']) !!}
                            {!! link_to_route('centre.delete', "Delete", ['centre' => $centre->id], ['class' => 'btn btn-danger btn-sm', 'role' => 'button']) !!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($search != true)
            <div class="text-xs-center">
                {!! $centres->render(new \Illuminate\Pagination\BootstrapFourPresenter($centres)) !!}
            </div>
        @endif
@endsection
