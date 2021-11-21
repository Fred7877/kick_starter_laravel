@extends('layouts.admin')

@section('content_header')
    <h1>Banane</h1>
@stop

@section('content_admin')
    <div class="card">
        <div class="card-body">
            <x-new-btn route="{{ route('bananes.create') }}"/></x-new-btn>
            {{$dataTable->table()}}
        </div>
    </div>
@stop

@push('js')
    <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script>
    <x-livewire-alert::flash/>
    {{$dataTable->scripts()}}
@endpush
