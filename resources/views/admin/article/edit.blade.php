@extends('layouts.admin')

@section('content_header')
    <h1>{{ __('common.edition') }}</h1>
@stop

@section('content_admin')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('articles.update', ['article' => $article]) }}" method="POST">
                @method('PUT')
                @csrf
                <x-forms.input type='text' label='Title' id='title' name='title'
                               value="{{ old('title', $article->title) }}"></x-forms.input>
                <x-forms.input type='text' label='Subtitle' id='subtitle' name='subtitle'
                               value="{{ old('subtitle', $article->subtitle) }}"></x-forms.input>
                <x-forms.text-area type='text' label='Body' id='body'
                                   name='body'>{{old('body', $article->body) }}</x-forms.text-area>
                <x-forms.input type='text' label='Status' id='status' name='status'
                               value="{{ old('status', $article->status) }}"></x-forms.input>
                <x-forms.select name='toto'></x-forms.select>
                <x-forms.input type='date' label='Start publish date' id='start_publish_date' name='start_publish_date'
                               value="{{ old('start_publish_date', $article->start_publish_date) }}"></x-forms.input>
                <x-forms.input type='date' label='End publish date' id='end_publish_date' name='end_publish_date'
                               value="{{ old('end_publish_date', $article->end_publish_date) }}"></x-forms.input>
                <x-forms.input type='date' label='Publish date' id='publish_date' name='publish_date'
                               value="{{ old('publish_date', $article->publish_date) }}"></x-forms.input>
                <x-return-and-submit-btns redirectPath="{{ route('articles.index') }}"></x-return-and-submit-btns>
            </form>
        </div>
    </div>
@stop

@push('js')

@endpush
