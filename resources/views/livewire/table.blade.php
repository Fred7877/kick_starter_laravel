<div>
    <div class="row col-3">
        <x-forms.input type="text" label="Search" name="search" value="" wiremodel="search"></x-forms.input>
    </div>

    <div class="card">
        <div class="card-body ">
            <div wire:loading>
                <div class="spinner-border text-info align-items-center" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>

            <div class="overflow-auto">
                <table class="table table-striped" wire:loading.remove>
                    <thead>
                    @foreach($columns as $column)
                        <th>{{ $column }}</th>
                    @endforeach
                    <th>Actions</th>
                    </thead>
                    @foreach($models as $item)
                        <tr>
                            @foreach($columns as $column)
                                <td> {{ $item->$column }}</td>
                            @endforeach
                            <td>
                                <div class="btn-group " role="group" aria-label="Basic example">
                                    <a href="{{ route('users.edit', $item) }}">
                                        <i class="fas fa-edit mr-2"></i>
                                    </a>
                                    @livewire('remove-btn',
                                    [
                                    'modelId' => $item->id,
                                    'modelType' => get_class($item),
                                    'routeRedirect' => route(Request::route()->getName()),
                                    'messageModalAsk' => 't\'es sur ?',
                                    ],
                                    key($item->id))
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div class="row" wire:loading.remove>
                <div class="col">
                    <div class="float-left">
                        <select wire:model="numberResult" class="form-control">
                            @foreach([10, 20, 30,40 , 50] as $number)
                                <option value="{{ $number }}">{{ $number }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="float-right">
                        {{ $models->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
