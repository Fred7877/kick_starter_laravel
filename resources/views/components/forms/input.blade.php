{{-- if isInputGroup is true, classic label is diplayed --}}
@if($isInputGroup)
    {{-- if isAppend is true, put the label at the end of field --}}
    <div class="input-group {{ $addGroupClass }} mb-3">

        @if($isAppend)
            <input type="{{$type}}" class="{{ $class }} {{ $addClass }} @error($name) is-invalid @enderror"
                   name="{{$name}}"
                   id="{{ $id }}"
                   placeholder="{{ $placeholder }}"
                   value="{{$value}}"
                   @if($disabled) disabled @endif
            >
            <div class="input-group-append">
                <span class="input-group-text" id="basic-{{ $id }}">{{$label}}</span>
            </div>
        @else
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-{{ $id }}">{{$label}}</span>
            </div>
            <input type="{{$type}}" class="{{ $class }} {{ $addClass }} @error($name) is-invalid @enderror"
                   name="{{$name}}" id="{{ $id }}"
                   placeholder="{{ $placeholder }}"
                   value="{{$value}}"
                   @if($disabled) disabled @endif
            >
        @endif

        @error($name)
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
        @enderror

    </div>

@elseif($type === 'radio')
    <div class="form-check">
        <input class="{{ $class }} {{ $addClass }}" type="radio" value="{{ $value }}" id="{{ $id }}" name="{{ $name }}" @if($disabled) disabled @endif>
        <label class="{{ $classLabel }}" for="{{ $id }}">
            {{ $label }}
        </label>
    </div>
@elseif($type === 'checkbox')
    <div class="form-check">
        <input class="{{ $class }} {{ $addClass }}"
               type="checkbox"
               value="{{ $value }}"
               id="{{ $id }}"
               name="{{ $name }}"
               @if($disabled) disabled @endif
        >
        <label class="{{ $classLabel }}" for="{{ $id }}">
            {{ $label }}
        </label>
    </div>
@else
    <div class="form-group @if($row) row @endif">
        <label for="{{ $id }}" class="{{ $classLabel }}">{{$label}}</label>

        <div class="@if($row) col-sm-10 @endif ">
            <input type="{{$type}}"
                   name="{{$name}}"
                   class="{{ $class }} {{ $addClass }}
                   @error($name) is-invalid @enderror" id="{{ $id }}"
                   placeholder="{{ $placeholder }}"
                   value="{{ $value }}"
                   @if($disabled) disabled @endif
            >

            @error($name)
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
@endif


