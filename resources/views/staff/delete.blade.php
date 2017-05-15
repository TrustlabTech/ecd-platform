@extends('layouts.admin')

@section('title', 'Delete Staff')

@section('content')
    <div class="row">
        <div class="spacer-50"></div>
        <h2 class="center-text">Delete Staff</h2>
        <div class="spacer-20"></div>
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">Are you sure you want to delete {{ $staff->given_name }} {{ $staff->family_name }}?</div>
                <div class="card-block">
                    {!! link_to_route('staff.destroy', "Delete", ['staff' => $staff->id], ['class' => 'btn btn-danger btn-sm', 'role' => 'button']) !!}

                    {!! link_to_route('staff.index', "Cancel", [], ['class' => 'btn btn-secondary btn-sm', 'role' => 'button']) !!}
                </div>
            </div>
        </div>
    </div>
@endsection
