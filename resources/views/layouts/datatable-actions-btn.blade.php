<div class="btn-group " role="group" aria-label="Basic example">
    <a href="{{ $route }}">
        <i class="{{ config()->get('kick-starter.styles.actions.edit') }}"></i>
    </a>
    @livewire('remove-btn',
        [
        'modelId' => $modelId,
        'modelType' => $modelType,
        'routeRedirect' => route(Request::route()->getName()),
        'messageModalSuccess' => $messageModalSuccess,
        'messageModalError' => $messageModalError,
        'messageModalAsk' => $messageModalAsk,
    ],
    key($id))
</div>
