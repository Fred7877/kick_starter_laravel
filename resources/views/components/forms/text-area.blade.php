<div>
    <div class="form-group">
        @if($label)
            <label for="{{ $id }}">{{ $label }}</label>
        @endif
        <textarea class="{{ $class }} {{ $addClass }}" id="{{ $id }}"
                  rows={{ $rows }} cols={{ $cols }} >{{ $slot }}</textarea>
    </div>
</div>
