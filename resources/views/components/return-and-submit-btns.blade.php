<div class="mt-5">
    <a href="{{ $redirectPath }}">
        <button type="button" class="{{ config()->get('kick-starter.styles.buttons.button-return') }}">
            Retour
        </button>
    </a>
    <button type="submit" class="{{  config()->get('kick-starter.styles.buttons.button-submit') }}">
        {{ __('common.save') }}
    </button>
</div>
