<div class="col-md-6">
    <div class="form-group row">
        {!! Form::label('did', 'DID', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('did', old('did') !== null ? old('did') : $child->did, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('id_number', 'ID Number', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('id_number', old('id_number') !== null ? old('id_number') : $child->id_number, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('passport_number', 'Passport Number', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('passport_number', old('passport_number') !== null ? old('passport_number') : $child->passport_number, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('given_name', 'Given Name', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('given_name', old('given_name') !== null ? old('given_name') : $child->given_name, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('family_name', 'Family Name', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('family_name', old('family_name') !== null ? old('family_name') : $child->family_name, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('gender', 'Gender', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::select('gender',['' => 'Please Select','female' => 'Female', 'male' => 'Male'], old('gender') !== null ? old('gender') : $child->gender, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group row">
        {!! Form::label('citizenship', 'Citizenship', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::select('citizenship', (['' => 'Please Select'] + $child->getCountryCodes()), old('citizenship') !== null ? old('citizenship') : $child->citizenship, ['class' => 'form-control'], ['class' => 'form-control'])!!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('subsidy', 'Subsidy', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::select('subsidy', ([false => 'No', true => 'Yes']), old('subsidy') !== null ? old('subsidy') : $child->subsidy, ['class' => 'form-control'], ['class' => 'form-control'])!!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('date_of_birth', 'Date of Birth', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            <div class="form-inline">
                {!! Form::text('date_of_birth', old('date_of_birth') !== null ? old('date_of_birth') : $child->date_of_birth, ['class' => 'form-control date-pick-me']) !!}
            </div>
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('registration_latitude', 'Registration Latitude', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('registration_latitude', old('registration_latitude') !== null ? old('registration_latitude') : $child->registration_latitude, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('registration_longitude', 'Registration Longitude', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('registration_longitude', old('registration_longitude') !== null ? old('registration_longitude') : $child->registration_longitude, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('centre_class_id', 'Class', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::select('centre_class_id', $centreClasses, old('centre_class_id') !== null ? old('centre_class_id') : $child->centre_class_id, ['class' => 'form-control select2']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('race', 'Race', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::select('race', $races, old('race') !== null ? old('race') : $child->race, ['class' => 'form-control select2']) !!}
        </div>
    </div>
</div>
