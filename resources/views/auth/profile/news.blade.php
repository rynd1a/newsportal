@extends('layouts.master')

@section('title', 'Новости ' . $user->name)

@section('content')
    <div class="bg-light my-3 rounded p-4">
        <h3>Новости <a href="{{ route('profile.show', $user) }}">{{ $user->name }}</a></h3>
        <form action="{{ route('profile.news', $user) }}" method="GET">
            <label for="sort">Сортировать по</label>
            <select name="sort" id="sort">
                <option value="views ASC" {{ old('sort') == 'views ASC' ? 'selected' : '' }}>возрастанию просмотров</option>
                <option value="views DESC" {{ old('sort') == 'views DESC' ? 'selected' : '' }}>убыванию просмотров</option>
                <option value="created_at ASC" {{ old('sort') == 'created_at ASC' ? 'selected' : '' }}>возрастанию даты</option>
                <option value="created_at DESC" {{ old('sort') == 'created_at DESC' ? 'selected' : '' }}>убыванию даты</option>
            </select>
            <button type="submit" class="btn btn-primary">Сортировать</button>
        </form>
        <div>
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
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $(document).ready(function() {
            $('#sort').select2();
        });
    </script>
@endsection
