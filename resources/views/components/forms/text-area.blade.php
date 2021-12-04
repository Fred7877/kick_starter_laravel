<div>
    <div class="form-group">
        @if($label)
            <label for="{{ $id }}">{{ $label }}</label>
        @endif
        <textarea class="{{ $class }} {{ $addClass }}" id="{{ $id }}" name="{{ $name }}"
                  rows={{ $rows }} cols={{ $cols }} >{{ $slot }}</textarea>
    </div>
</div>
