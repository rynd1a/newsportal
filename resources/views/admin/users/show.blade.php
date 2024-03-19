@extends('layouts.admin.master')

@section('title', $user->name)

@section('content')
    <div class="bg-light my-5 p-5">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary px-4">Назад</a>
        </div>
        <table class="table">
            <tbody>
                <tr>
                    <td>id:</td>
                    <td>{{ $user->id }}</td>
                </tr>
                <tr>
                    <td>Имя:</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <td>Email подтвержден</td>
                    <td>{{ $user->email_verified_at }}}</td>
                </tr>
                <tr>
                    <td>Хеш пароля</td>
                    <td>{{ $user->password }}</td>
                </tr>
                <tr>
                    <td>Remember токен</td>
                    <td>{{ $user->remember_token }}</td>
                </tr>
                <tr>
                    <td>Зарегистрировался</td>
                    <td>{{ $user->created_at }}</td>
                </tr>
                <tr>
                    <td>Обновлен</td>
                    <td>{{ $user->updated_at }}</td>
                </tr>
                <tr>
                    <td>Роли</td>
                    <td>
                        <ul>
                            @foreach($user->roles as $role)
                                <li class="mb-3">
                                    {{ $role->name }}
                                    <button class="btn btn-sm btn-danger" onclick="document.getElementById('{{ 'remove-role-form-' . $role->id }}').submit()">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </button>
                                    <form action="{{ route('admin.users.remove-role', [$user, $role])  }}" method="POST" id="{{ 'remove-role-form-' . $role->id }}">
                                        @csrf
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                        <form action="{{ route('admin.users.add-role', $user) }}" method="POST" id="add-role-form" style="display: none">
                            @csrf
                            <div class="form-group">
                                @if(!$roles->count() > 0)
                                    <div class="alert alert-warning" role="alert">
                                        У пользователя есть все роли
                                    </div>
                                @else
                                    <label for="role">Роль</label>
                                    <select name="role" id="role">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-around w-50 mx-auto">
            <button class="btn btn-success" onclick="addRole()">Добавить роль</button>
            <button class="btn btn-danger" onclick="document.getElementById('user-delete-form').submit()">Удалить пользователя</button>
            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" id="user-delete-form">
                @csrf
            </form>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        let showed = false
        let form = document.getElementById('add-role-form')
        function addRole() {
            if (!showed) {
                form.style.display = 'block'
                showed = true
            }
            else {
                form.submit()
            }
        }
    </script>
@endsection

@section('footer')
    <script>
        $(document).ready(function() {
            $('#role').select2();
        });
    </script>
@endsection
