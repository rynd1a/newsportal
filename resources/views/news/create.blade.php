@extends('layouts.master')

@section('title', 'Новость')

@section('content')
    <div class="bg-light p-5 mt-5">
        <form action=" @isset($news){{ route('news.update', $news) }}@else{{ route('news.store')}}@endisset"
              method="POST" enctype="multipart/form-data">
            @include('includes.create-news-form')
        </form>
    </div>
@endsection
