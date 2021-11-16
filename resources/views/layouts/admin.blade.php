@extends('adminlte::page')

@section('title', 'Dashboard')

@section('css')
@stop

@push('css')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/sweet-alert-toast.js') }}"></script>
@endpush

@section('content')
    @include('layouts.flash-messages')
    @yield('content_admin')
@stop

@push('js')

@endpush
