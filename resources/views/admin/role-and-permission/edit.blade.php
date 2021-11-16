@extends('layouts.admin')

@section('content_header')
    <h1>{{ __('common.edition') }}</h1>
@stop

@section('content_admin')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('roles-and-permissions.update', ['roles_and_permission' => $role]) }}" method="POST">
                @method('PUT')
                @csrf

                <x-forms.input type="text" label="Nom" name="firstname" value="{{ old('name', $role->name) }}"/>

                <hr>
                <h4>Permissions</h4>

                <x-forms.select
                    name="permissions"
                    :options="$permissions"
                    label="permissions"
                    isSelect2="true"
                    size="200"
                    :comparingModel="$role"
                    methodComparing="hasPermissionTo"
                    moveAllLabel="Déplacer tout"
                    removeAllLabel="Retirer tout"
                />

                <x-return-and-submit-btns redirectPath="{{ route('roles-and-permissions.index') }}"/>
            </form>
        </div>
    </div>
@stop

@push('js')

@endpush
