@extends('layouts.admin')

@section('content_header')
    <h1>{{ __('common.edition') }}</h1>
@stop

@section('content_admin')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('roles-and-permissions.store') }}" method="POST">
                @csrf

                <x-forms.input type="text" label="Nom" name="name" value="{{ old('name') }}"></x-forms.input>

                <hr>
                <h4>Permissions</h4>

                <x-forms.select
                    name="permissions"
                    :options="$permissions"
                    label="permissions"
                    isSelect2="true"
                    size="200"
                    moveAllLabel="Déplacer tout"
                    placeholder="{{ __('common.choose_permissions') }}"
                    removeAllLabel="Retirer tout"></x-forms.select>

                <x-return-and-submit-btns redirectPath="{{ route('roles-and-permissions.index') }}"></x-return-and-submit-btns>
            </form>
        </div>
    </div>
@stop

@push('js')

@endpush
