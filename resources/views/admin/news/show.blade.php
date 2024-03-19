@extends('layouts.admin.master')

@section('title', Str::limit($news->header, 10, '...'))

@section('content')
    <div class="bg-light my-5 p-5">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('admin.news.index') }}" class="btn btn-primary px-4">Назад</a>
        </div>
        <table class="table">
            <tbody>
            <tr>
                <td>id:</td>
                <td>{{ $news->id }}</td>
            </tr>
            <tr>
                <td>Заголовок:</td>
                <td>{{ $news->header }}</td>
            </tr>
            <tr>
                <td>Анонс:</td>
                <td>{{ $news->announce }}</td>
            </tr>
            <tr>
                <td>Описание:</td>
                <td>{{ $news->description }}}</td>
            </tr>
            <tr>
                <td>Просмотры:</td>
                <td>{{ $news->views }}</td>
            </tr>
            <tr>
                <td>Пользователь:</td>
                <td><a href="{{ route('admin.users.show', $news->user) }}">{{ $news->user->name }}</a></td>
            </tr>
            <tr>
                <td>Опубликована:</td>
                <td>{{ $news->published ? 'Да' : 'Нет' }}</td>
            </tr>
            <tr>
                <td>Изображение:</td>
                @isset($news->image)
                    <td>
                        <a href="">
                            <img src="{{ asset($news->image->path) }}" alt="">
                        </a>
                    </td>
                @else
                    <td>Отсутствует</td>
                @endisset
            </tr>
            <tr>
                <td>Создана:</td>
                <td>{{ $news->created_at }}</td>
            </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-center w-50 mx-auto">
            <a href="{{ route('admin.news.edit', $news) }}" class="btn btn-warning mx-4">Редактировать</a>
            <button class="btn btn-danger" onclick="document.getElementById('news-delete-form').submit()">Удалить</button>
            <form action="{{ route('admin.news.destroy', $news) }}" method="POST" id="news-delete-form">
                @csrf
            </form>
        </div>
    </div>
@endsection
