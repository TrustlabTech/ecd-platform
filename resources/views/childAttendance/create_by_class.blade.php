@extends('layouts.admin')

@section('title', 'Add Attendance')

@section('content')
    <div class="row">
        <div class="spacer-50"></div>
        <h2 class="center-text">Add attendance by class</h2>
        <div class="spacer-20"></div>
        <div class="card">
            <div class="card-header">Add attendance by class</div>
            <div class="card-block">
                {!! Form::open(['route' => 'childAttendance.storeByClass', 'method' => 'post']) !!}
                    <div class="col-md-6">
                        <div class="form-group row">
                            {!! Form::label('centre_id', 'Centre', ['class' => 'col-md-5 col-form-label']); !!}
                            <div class="col-md-7">
                                {{-- {!! Form::select('centre_id', ['' => 'Please Select'] + $centres->lists('name', 'id')->toArray(), null, ['class' => 'form-control select2-centreId', 'id' => 'centre_id']) !!} --}}
                                <select name="centre_id" class="form-control select2-centreId" id="centre_id">
                                    <option value="">Please select</option>
                                    @foreach($centres as $centre)
                                        <option value="{{$centre->id}}">{{$centre->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row hide-row">
                            {!! Form::label('centre_class_id', 'Class', ['class' => 'col-md-5 col-form-label']); !!}
                            <div class="col-md-7">
                                {!! Form::select('centre_class_id', [], null, ['class' => 'form-control select2-classId', 'id' => 'class_id']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('created_at', 'Date', ['class' => 'col-md-5 col-form-label']); !!}
                            <div class="col-md-7">
                                <div class="form-inline">
                                    {!! Form::text('created_at', date('Y-m-d'), ['class' => 'form-control date-pick-me']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-5">
                                <div id="children_list_wrapper"></div>
                            </div>
                        </div>
                    </div>
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
