@extends('layouts.master')

@section('title', 'Новостная лента')

@section('content')
    @if(Session::has('success'))
        <div class="alert alert-primary text-center mt-2" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    @auth
        <div class="d-flex justify-content-center m-5">
            <a href="{{ route('news.create') }}" class="btn btn-primary px-5">Предложить новость</a>
        </div>
        <form action="{{ route('news.index') }}" method="GET">
            <div class="d-flex justify-content-between">
                <div>
                    <label for="sort">Сортировать по</label>
                    <select name="sort" id="sort" class="sort">
                        <option value="views ASC" {{ old('sort') == 'views ASC' ? 'selected' : '' }}>возрастанию просмотров</option>
                        <option value="views DESC" {{ old('sort') == 'views DESC' ? 'selected' : '' }}>убыванию просмотров</option>
                        <option value="created_at ASC" {{ old('sort') == 'created_at ASC' ? 'selected' : '' }}>возрастанию даты</option>
                        <option value="created_at DESC" {{ old('sort') == 'created_at DESC' ? 'selected' : '' }}>убыванию даты</option>
                    </select>
                    <button type="submit" class="btn btn-outline-primary">Сортировать</button>
                </div>
                <div class="d-flex">
                    <input class="form-control me-2" name="search" type="search" placeholder="Поиск" aria-label="Поиск" value="{{old('search')}}">
                    <button class="btn btn-outline-primary" type="submit">Найти</button>
                </div>
            </div>
        </form>

    @endauth
    @foreach($news as $newsItem)
        <div class="bg-light d-flex my-3 rounded p-4">
            @isset($newsItem->image)
                <img src="{{ asset($newsItem->image->path) }}" alt="" style="min-width: 300px">
            @endisset
            <div class="p-3 w-100">
                <a href="{{ route('news.show', $newsItem) }}"><h1>{{ $newsItem->created_at->format('Y-m-d') }} — {{ Str::limit($newsItem->header, 25, '...') }}</h1></a>
                <div>{{ Str::limit($newsItem->announce, 500, '...') }}</div>
                <div class="d-flex justify-content-end mt-5">
                    <div>Просмотров: {{ $newsItem->views }}</div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="d-flex justify-content-center">
        {{ $news->onEachSide(3)->appends($_GET)->links() }}
    </div>
@endsection

@section('footer')
    <script>
        $(document).ready(function() {
            $('.sort').select2();
        });
    </script>
@endsection
