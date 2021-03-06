@extends('layouts.admin')

@section('content_header')
    <h1>{{ __('common.edition') }}</h1>
@stop

@section('content_admin')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.update', ['user' => $user]) }}" method="POST">
                @method('PUT')
                @csrf
                <x-forms.input type='date' label='Publish_date' id='publish_date' name='publish_date' value="{{ old('publish_date', $user->firstname) }}"></x-forms.input>
                <x-forms.input type="text" label="Nom" name="firstname" value="{{ old('firstname', $user->firstname) }}"></x-forms.input>
                <x-forms.input type="text" label="Prénom" name="lastname" value="{{ old('lastname', $user->lastname) }}"></x-forms.input>
                <x-forms.input type="email" label="Email" name="email" value="{{ old('email', $user->email) }}"></x-forms.input>
                <x-forms.input type="password" label="Password" name="password"></x-forms.input>
                <x-forms.input type="password" label="{{ __('common.password_confirmation') }}" name="password_confirmation"></x-forms.input>
                <x-forms.select
                    name="roles"
                    multiple="true"
                    :options="$roles"
                    :comparingModel="$user"
                    isDualList="true"
                    methodComparing="hasRole"
                    label="Roles"
                    moveAllLabel="Tout déplacer"
                    removeAllLabel="Tout retirer"></x-forms.select>
                <x-return-and-submit-btns redirectPath="{{ route('users.index', ['id' => $user->id]) }}"></x-return-and-submit-btns>
            </form>
        </div>
    </div>
@stop

@push('js')

@endpush
