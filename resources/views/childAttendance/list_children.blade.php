<div class="row">
<p>Children:</p>
</div>
<div class="form-group">
@foreach($children as $child)
    <div class="form-check row">
        <label class="form-check-label">
            <input type="checkbox" name="attendance[]" value="{{$child->id}}" class="form-check-input">
            {{$child->family_name}} {{$child->given_name}}
        </label>
    </div>
@endforeach
</div>
