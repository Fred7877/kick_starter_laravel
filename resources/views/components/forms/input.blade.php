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
                   @if($wiremodel !== null) wire:model="{{$wiremodel}}" @endif
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
                   @if($wiremodel !== null) wire:model="{{$wiremodel}}" @endif
            >
        @endif

        @error($name)
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
        @enderror

    </div>
@else
    <div class="form-group">
        <label for="{{ $id }}">{{$label}}</label>
        <input type="{{$type}}"
               name="{{$name}}"
               class="{{ $class }} {{ $addClass }}
               @error($name) is-invalid @enderror" id="{{ $id }}"
               placeholder="{{ $placeholder }}"
               value="{{$value}}"
               @if($wiremodel !== null) wire:model="{{$wiremodel}}" @endif
        >

        @error($name)
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
        @enderror
    </div>
@endif


