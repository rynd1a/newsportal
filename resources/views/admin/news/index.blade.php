@extends('layouts.admin.master')

@section('title', 'Новости')

@section('content')
    <div class="bg-light my-5 p-4">

        <form action="{{ route('admin.news.index') }}" method="GET">
            <label for="sort">Сортировать по</label>
            <select name="sort" id="sort">
                <option value="views ASC" {{ old('sort') == 'views ASC' ? 'selected' : '' }}>возрастанию просмотров</option>
                <option value="views DESC" {{ old('sort') == 'views DESC' ? 'selected' : '' }}>убыванию просмотров</option>
                <option value="created_at ASC" {{ old('sort') == 'created_at ASC' ? 'selected' : '' }}>возрастанию даты</option>
                <option value="created_at DESC" {{ old('sort') == 'created_at DESC' ? 'selected' : '' }}>убыванию даты</option>
            </select>
            <label for="published">Статус</label>
            <select name="published" id="published">
                <option value="all" {{ old('published') == 'all' ? 'selected' : '' }}>все</option>
                <option value="true" {{ old('published') == 'true' ? 'selected' : '' }}>опубликованные</option>
                <option value="false" {{ old('published') == 'false' ? 'selected' : '' }}>неопубликованные</option>
            </select>
            <button type="submit" class="btn btn-primary">Сортировать</button>
        </form>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Заголовок</th>
                <th scope="col">Анонс</th>
                <th scope="col">Описание</th>
                <th scope="col">Просмотры</th>
                <th scope="col">Дата создания</th>
                <th scope="col">Опубликована</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($news as $newsItem)
                <tr>
                    <td>{{ Str::limit($newsItem->header, 15, '...') }}</td>
                    <td>{{ Str::limit($newsItem->announce, 20, '...') }}</td>
                    <td>{{ Str::limit($newsItem->description, 20, '...') }}</td>
                    <td>{{ $newsItem->views }}</td>
                    <td>{{ $newsItem->created_at }}</td>
                    <td>{{ $newsItem->published ? 'Да' : 'Нет' }}</td>
                    <td class="d-flex">
                        <div class="container row">
                            <div class="col-4">
                                @if(!$newsItem->published)
                                    <a href="{{ route('admin.news.publish', $newsItem) }}" class="btn btn-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                                        </svg>
                                    </a>
                                @endif
                            </div>
                            <div class="col-4">
                                <a href="{{ route('admin.news.show', $newsItem) }}" class="btn btn-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                    </svg>
                                </a>
                            </div>
                            <div class="col-4">
                                <button class="btn btn-danger" onclick="document.getElementById('user-delete-form').submit()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </button>
                                <form action="{{ route('admin.news.destroy', $newsItem) }}" method="POST" id="user-delete-form">
                                    @method('DELETE')
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $news->onEachSide(3)->appends($_GET)->links() }}
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $(document).ready(function() {
            $('#sort').select2();
            $('#published').select2();
        });
    </script>
@endsection
