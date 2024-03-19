@extends('layouts.master')

@section('title', Str::limit($news->header, 10))

@section('content')
    <div class="bg-light m-5 p-4 rounded">
        <h1 class="text-center mb-4">{{ $news->created_at->format('Y-m-d') }} - {{ $news->header }}</h1>
        <div class="d-flex">
            <div>
                @isset($news->image)
                    <img src="{{ asset($news->image->path) }}" alt="">
                @endisset
                @isset($news->user)
                    <p class="">Предложена: <a href="{{ route('profile.show', $news->user) }}">{{ $news->user->name }}</a></p>
                @endisset
            </div>
            <div class="p-5">{{ $news->description }}</div>
        </div>
        @canUpdateNews($news)
            <div class="d-flex justify-content-end">
                <a class="btn btn-primary" href="{{ route('news.edit', $news) }}">Обновить новость</a>
            </div>
        @endcanUpdateNews
    </div>
@endsection
