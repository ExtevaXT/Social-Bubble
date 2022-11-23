{{--КОМПОНЕНТ ДЛЯ ПОЛЯ ВВОДА--}}
<div class="mb-3">
    <label for="input{{$input['name']}}"
           class="form-label">
        {{$input['label']}}
    </label>
    <input type="{{$input['type'] ?? 'text'}}"
           name="{{$input['name']}}"
           class="form-control @error($input['name']) is-invalid @enderror"
           id="input{{$input['name']}}"
           aria-describedby="invalid{{$input['name']}}Feedback"
           value="{{old($input['name'], $input['default'] ?? '')}}" >
    @error($input['name'])
        <div id="invalid{{$input['name']}}Feedback"
             class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
