<!doctype html>
<html lang="ru">
<body>
    <h1>Запись <a href="{{ route('news.show', $news) }}">{{ Str::limit($news->header, 25, '...') }}</a> набрала 10 просмотров!</h1>
</body>
</html>
