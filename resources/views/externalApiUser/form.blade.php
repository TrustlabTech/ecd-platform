<div class="col-md-6">
    <div class="form-group row">
        {!! Form::label('email', 'Email', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('email', old('email') !== null ? old('email') : $user->email, ['class' => 'form-control']) !!}
        </div>
    </div>

    @if($user->email === null)
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
