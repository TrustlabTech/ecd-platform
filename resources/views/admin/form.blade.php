<div class="col-md-6">
    <div class="form-group row">
        {!! Form::label('email', 'Email', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('email', old('email') !== null ? old('email') : $admin->user->email, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('first_name', 'First Name', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('first_name', old('first_name') !== null ? old('first_name') : $admin->first_name, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('last_name', 'Last Name', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('last_name', old('last_name') !== null ? old('last_name') : $admin->last_name, ['class' => 'form-control']) !!}
        </div>
    </div>


    @if($admin->user->email === null)
        <div class="form-group row">
            {!! Form::label('password', 'Password', ['class' => 'col-md-5 col-form-label']); !!}
            <div class="col-md-7">
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group row">
            {!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'col-md-5 col-form-label']); !!}
            <div class="col-md-7">
                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
            </div>
        </div>
    @endif
</div>
