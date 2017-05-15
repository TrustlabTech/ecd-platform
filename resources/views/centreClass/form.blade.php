<div class="col-md-6">
    <div class="form-group row">
        {!! Form::label('name', 'Name', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('name', old('name') !== null ? old('name') : $centreClass->name, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('centre_id', 'Centre', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::select('centre_id', $centres, old('centre_id') !== null ? old('centre_id') : $centreClass->centre_id, ['class' => 'form-control select2']) !!}
        </div>
    </div>
</div>
