<div>
    <div class="form-group">
        <label for="{{$id ?? ''}}">{{$label ?? '' ?? ''}}</label>
        <input type="number" min="0.00" step="0.01" class="form-control {{$class ?? ''}}" id="{{$id ?? ''}}" name="{{$id ?? ''}}" placeholder="{{$placeholder ?? ''}}" value="{{$value ?? ''}}">
      </div>
</div>
