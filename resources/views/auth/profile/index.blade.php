@extends('layouts.master')

@section('title', $user->name)

@section('content')
    <div class="bg-light d-flex justify-content-between my-3 rounded p-4">
        <div>
            <p>Имя пользователя: {{ $user->name }}</p>
            <p>Email: {{ $user->email }}</p>
            <p>Общее количество просмотров новостей: {{ $user->summaryViews() }}</p>
        </div>
        <div class="d-block">
            <p>
                <a href="{{ route('profile.news', $user) }}" class="btn btn-sm btn-primary">Посмотреть новости пользователя</a>
            </p>
        </div>
    </div>
@endsection
