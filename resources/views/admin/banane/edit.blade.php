@extends('layouts.admin')

@section('content_header')
    <h1>{{ __('common.edition') }}</h1>
@stop

@section('content_admin')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('bananes.update', ['banane' => $banane]) }}" method="POST">
                 @method('PUT')
                 @csrf
                 
                <x-return-and-submit-btns redirectPath="{{ route('bananes.index') }}"></x-return-and-submit-btns>
            </form>
        </div>
    </div>
@stop

@push('js')

@endpush
