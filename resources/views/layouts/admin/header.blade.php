<nav class="navbar navbar-expand-lg navbar-light bg-light py-2 px-5">
    <div class="container">
        <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
            <ul class="navbar-nav d-flex justify-content-between w-100">
                <li class="nav-item">
                    <div class="d-flex">
                        <a class="navbar-brand" href="#">Новости Дона</a>
                        <a class="nav-link" href="{{ route('news.index') }}">Вернуться на сайт</a>
                        <a href="{{ route('admin.index') }}" class="nav-link">Главная</a>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="d-flex">
                        <a href="{{ route('admin.reset-site') }}" class="nav-link">Сбросить сайт</a>
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Выйти
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
