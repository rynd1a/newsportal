<nav class="navbar navbar-expand-lg navbar-light bg-light py-2 px-5">
    <div class="container">
        <a class="navbar-brand" href="{{ route('news.index') }}">Новости Дона</a>
        <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('news.index') }}">Главная</a>
                </li>
                @newsExist
                <li class="nav-item">
                    <span class="nav-link">Последняя добавленная новость: {{$lastNewsCreated}}</span>
                </li>
                @endnewsExist
            </ul>
            <ul class="navbar-nav">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Войти</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Зарегистрироваться</a>
                        </li>
                    @endif
                @else
                    @isAdmin
                    <li class="nav-item">
                        <a href="{{ route('admin.index') }}" class="nav-link">Админ-панель</a>
                    </li>
                    @endisAdmin
                    <li class="nav-item">
                        <a href="{{ route('profile.show', Auth::user()) }}" class="nav-link">Профиль</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Выйти
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
