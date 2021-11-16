@if($isInputGroup)
    @if($isAppend)
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <button class="btn btn-outline-secondary" type="button">{{ $label }}</button>
            </div>
            <select @if($multiple) multiple="multiple" size="{{$size}}" @endif class="custom-select" id="{{ $id }}"
                    name="{{$name}}@if($multiple)[]@endif">
                @if($placeholder !== null)
                    <option value="">{{ $placeholder }}</option>
                @endif
                @foreach($options as $option)
                    <option value="{{ $option->id }}"
                            @if($comparingModel !== null && !$comparingModel instanceof \Illuminate\Database\Eloquent\Collection && $comparingModel->$methodComparing($option->id)) selected="selected" @endif>{{ $option->name }}</option>
                @endforeach
            </select>
        </div>
    @else
        <div class="form-group">
            @if($label !== '')
                <label for="{{ $id }}">{{$label}}</label>
            @endif
            <select @if($multiple) multiple="multiple" size="{{$size}}" @endif class="custom-select"
                    name="{{$name}}@if($multiple)[]@endif" id="{{ $id }}">
                @if($placeholder !== null)
                    <option value="">{{ $placeholder }}</option>
                @endif
                @foreach($options as $option)
                    <option value="{{ $option->id }}"
                            @if($comparingModel !== null && !$comparingModel instanceof \Illuminate\Database\Eloquent\Collection && $comparingModel->$methodComparing($option->id)) selected="selected" @endif>{{ $option->name }}</option>
                @endforeach
            </select>

            @error($name)
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
            @enderror
        </div>
    @endif

@elseif($isDualList)

    {{-- DUAL LIST --}}

    @push('css')
        <link rel="stylesheet" type="text/css"
              href="{{ mix('css/bootstrap-duallistbox.min.css') }}">
        <link rel="stylesheet" type="text/css"
              href="{{ mix('css/style-dualbox.css') }}">
    @endpush

    <select multiple="multiple" size="{{$size}}" class="custom-select d-none"
            name="{{$name}}@if($multiple)[]@endif" id="{{ $id }}">
        @if($placeholder !== null)
            <option value="">{{ $placeholder }}</option>
        @endif
        @foreach($options as $option)
            <option value="{{ $option->id }}"
                    @if($comparingModel !== null && !$comparingModel instanceof \Illuminate\Database\Eloquent\Collection && $comparingModel->$methodComparing($option->id)) selected="selected" @endif>
                {{ $option->name }}
            </option>
        @endforeach
    </select>

    @push('js')
        <script src="{{ mix('js/jquery.bootstrap-duallistbox.min.js') }}"></script>

        <script>
            $(document).ready(function () {
                $('select[name="{{$name}}@if($multiple)[]@endif"]').bootstrapDualListbox({
                    nonSelectedListLabel: '{{ $nonSelectedListLabel }}',
                    selectedListLabel: '{{ $selectedListLabel }}',
                    preserveSelectionOnMove: '{{ $preserveSelectionOnMove }}',
                    moveAllLabel: '{{ $moveAllLabel }}',
                    removeAllLabel: '{{ $removeAllLabel }}',
                    selectorMinimalHeight: {{$size}}
                });
            });
        </script>
    @endpush

@elseif($isSelect2)

    {{-- Select 2 --}}

    @push('css')
        <link rel="stylesheet" type="text/css"
              href="{{ mix('css/select2.min.css') }}">
    @endpush

    @if($label !== '')
        <label for="{{ $id }}">{{$label}}</label>
    @endif
    <select multiple="multiple" size="{{$size}}" class="custom-select d-none"
            name="{{$name}}@if($multiple)[]@endif" id="{{ $id }}">

        @if($placeholder !== null)
            <option></option>
        @endif

        @foreach($options as $option)
            @if($placeholder !== null)
                <option value="">{{ $placeholder }}</option>
            @endif
            <option value="{{ $option->id }}"
                    @if($comparingModel !== null && !$comparingModel instanceof \Illuminate\Database\Eloquent\Collection && $comparingModel->$methodComparing($option->id)) selected="selected" @endif>
                {{ $option->name }}
            </option>
        @endforeach
    </select>

    @push('js')
        <script src="{{ mix('js/select2.min.js') }}"></script>

        <script>
            $(document).ready(function () {
                $('select[name="{{$name}}@if($multiple)[]@endif"]').select2({
                    theme: 'classic',
                    width: '100%',
                    closeOnSelect: false,
                    placeholder: '{{ $placeholder }}',
                });
            });
        </script>
    @endpush
@else

    <div class="form-group">
        @if($label !== '')
            <label for="{{ $id }}">{{$label}}</label>
        @endif
        <select @if($multiple) multiple="multiple" size="{{$size}}" @endif class="custom-select"
                name="{{$name}}@if($multiple)[]@endif" id="{{ $id }}">
            @if($placeholder !== null)
                <option value="">{{ $placeholder }}</option>
            @endif
            @foreach($options as $option)
                <option value="{{ $option->id }}"
                        @if($comparingModel !== null && !$comparingModel instanceof \Illuminate\Database\Eloquent\Collection && $comparingModel->$methodComparing($option->id)) selected="selected" @endif>{{ $option->name }}</option>
            @endforeach
        </select>

        @error($name)
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
        @enderror
    </div>
@endif


