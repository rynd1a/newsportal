@extends('layouts.admin.master')

@section('title', 'Админ-панель')

@section('content')
    <div class="bg-light my-5 p-5">
        @if(session()->has('reset'))
            <div class="alert alert-success text-center mt-2" role="alert">
            {{ Session::get('reset') }}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Название таблицы</th>
                    <th scope="col">Количество записей</th>
                    <th scope="col">Последняя запись</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a href="{{ route('admin.users.index') }}">Пользователи</a></td>
                    <td>{{ $usersCount }}</td>
                    <td>{{ $lastUser->name }} — {{ $lastUser->created_at }}</td>
                </tr>
                <tr>
                    <td><a href="{{ route('admin.news.index') }}">Новости</a></td>
                    <td>{{ $newsCount }}</td>
                    <td>{{ Str::limit($lastNews->header, 15, '...') }} — {{ $lastNews->created_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
