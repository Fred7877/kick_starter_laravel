@extends('layouts.admin')

@section('content_header')
    <h1>{{ __('common.edition') }}</h1>
@stop

@section('content_admin')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <x-forms.input type="text" label="Nom" name="firstname" value="{{ old('firstname') }}"></x-forms.input>
                <x-forms.input type="text" label="Prénom" name="lastname" value="{{ old('lastname') }}"></x-forms.input>
                <x-forms.input type="email" label="Email" name="email" value="{{ old('email') }}"></x-forms.input>
                <x-forms.input type="password" label="Password" name="password" ></x-forms.input>
                <x-forms.input type="password" label="{{ __('common.password_confirmation') }}" name="password_confirmation"></x-forms.input>
                <x-forms.select name="roles" :options="$roles" label="Roles" isSelect2="true" placeholder="Choisir un rôle ou plusieurs rôles"></x-forms.select>
                <x-return-and-submit-btns redirectPath="{{ route('users.index') }}"></x-return-and-submit-btns>
            </form>
        </div>
    </div>
@stop

@push('js')

@endpush
