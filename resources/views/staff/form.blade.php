
<div class="col-md-6">
    <div class="form-group row">
        {!! Form::label('did', 'DID', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('did', old('did') !== null ? old('did') : $staff->did, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('id_number', 'ZA ID Number', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('id_number', old('id_number') !== null ? old('id_number') : $staff->id_number, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('given_name', 'Given Name', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('given_name', old('given_name') !== null ? old('given_name') : $staff->given_name, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('family_name', 'Family Name', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('family_name', old('family_name') !== null ? old('family_name') : $staff->family_name, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('principle', 'Principle', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::select('principle', ['1' => 'Yes', '0' => 'No'], old('principle') !== null ? old('principle') : $staff->principle, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('practitioner', 'Practitioner', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::select('practitioner', ['1' => 'Yes', '0' => 'No'], old('practitioner') !== null ? old('practitioner') : $staff->practitioner, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('volunteer', 'Volunteer', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::select('volunteer', ['1' => 'Yes', '0' => 'No'], old('volunteer') !== null ? old('volunteer') : $staff->volunteer, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('cook', 'Cook', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::select('cook', ['1' => 'Yes', '0' => 'No'], old('cook') !== null ? old('cook') : $staff->cook, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('gender', 'Gender', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::select('gender',['' => 'Please Select','female' => 'Female', 'male' => 'Male'], old('gender') !== null ? old('gender') : $staff->gender, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('citizenship', 'Citizenship', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::select('citizenship',(['' => 'Please Select'] + $staff->getCountryCodes()), old('citizenship') !== null ? old('citizenship') : $staff->citizenship, ['class' => 'form-control'], ['class' => 'form-control'])!!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('date_of_birth', 'Date of Birth', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            <div class="form-inline">
                {!! Form::text('date_of_birth', old('date_of_birth') !== null ? old('date_of_birth') : $staff->date_of_birth, ['class' => 'form-control date-pick-me']) !!}
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group row">
        {!! Form::label('nationality', 'Nationality', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('nationality', old('nationality') !== null ? old('nationality') : $staff->nationality, ['class' => 'form-control']) !!}
        </div>
    </div>


    <div class="form-group row">
        {!! Form::label('other', 'Other', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::select('other', ['1' => 'Yes', '0' => 'No'], old('other') !== null ? old('other') : $staff->other, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('registration_latitude', 'Registration Latitude', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('registration_latitude', old('registration_latitude') !== null ? old('registration_latitude') : $staff->registration_latitude, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('registration_longitude', 'Registration Longitude', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('registration_longitude', old('registration_longitude') !== null ? old('registration_longitude') : $staff->registration_longitude, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('ecd_qualification_id', 'ECD Qualification', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::select('ecd_qualification_id', $qualifications->lists('name', 'id'), old('ecd_qualification_id') !== null ? old('ecd_qualification_id') : $staff->ecd_qualification_id, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('centre_id', 'Centre', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::select('centre_id', $centres, old('centre_id') !== null ? old('centre_id') : $staff->centre_id, ['class' => 'form-control select2']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('phone_number', 'Phone Number', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('phone_number', old('phone_number') !== null ? old('phone_number') : $staff->user->username, ['class' => 'form-control']) !!}
        </div>
    </div>

    @if($staff->user->username === null)
        <div class="form-group row">
            {!! Form::label('password', 'Pin', ['class' => 'col-md-5 col-form-label']); !!}
            <div class="col-md-7">
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group row">
            {!! Form::label('password_confirmation', 'Confirm Pin', ['class' => 'col-md-5 col-form-label']); !!}
            <div class="col-md-7">
                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
            </div>
        </div>
    @else
        <div class="form-group row">
                {!! Form::label('password_rest', 'Change Pin', ['class' => 'col-md-5 col-form-label font-weight-bold']); !!}
        </div>
        <div class="form-group row">
            {!! Form::label('password', 'New Pin', ['class' => 'col-md-5 col-form-label']); !!}
            <div class="col-md-7">
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group row">
            {!! Form::label('password_confirmation', 'Confirm Pin', ['class' => 'col-md-5 col-form-label']); !!}
            <div class="col-md-7">
                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
            </div>
        </div>
    @endif
</div>
