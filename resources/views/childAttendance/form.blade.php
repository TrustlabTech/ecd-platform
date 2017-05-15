<div class="col-md-6">
    @if($create === true)
        <div class="form-group row">
            {!! Form::label('children_id', 'Child', ['class' => 'col-md-5 col-form-label']); !!}
            <div class="col-md-7">
                {!! Form::select('children_id', $children, old('children_id') !== null ? old('children_id') : $childAttendance->children_id, ['class' => 'form-control select2']) !!}
            </div>
        </div>
    @else
        <div class="form-group row">
            {!! Form::label('children_id', 'Child', ['class' => 'col-md-5 col-form-label']); !!}
            <div class="col-md-7">
                {!! Form::select('children_id', $children, old('children_id') !== null ? old('children_id') : $childAttendance->children_id, ['class' => 'form-control', 'disabled' => 'true']) !!}
                {!! Form::hidden('children_id', $childAttendance->children_id) !!}
            </div>
        </div>
    @endif

    <div class="form-group row">
        {!! Form::label('attended', 'Attended', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::select('attended', ['1' => 'Yes', '0' => 'No'], old('attended') !== null ? old('attended') : $childAttendance->attended, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('created_at', 'Date', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            <div class="form-inline">
                {!! Form::text('created_at', old('created_at') !== null ? old('created_at') : date('Y-m-d', strtotime($childAttendance->created_at)), ['class' => 'form-control date-pick-me']) !!}
            </div>
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('latitude', 'Latitude', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('latitude', old('latitude') !== null ? old('latitude') : $childAttendance->latitude, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('longitude', 'Longitude', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('longitude', old('longitude') !== null ? old('longitude') : $childAttendance->longitude, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
