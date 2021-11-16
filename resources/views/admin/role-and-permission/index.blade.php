@extends('layouts.admin')

@section('content_header')
    <h1>Roles et permissions</h1>
@stop

@section('content_admin')
    <div class="card">
        <div class="card-body">
            <x-new-btn route="{{ route('roles-and-permissions.create') }}"/>
            {{$dataTable->table()}}
        </div>
    </div>
@stop

@push('js')
    {{$dataTable->scripts()}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script>
    <x-livewire-alert::flash />
@endpush
