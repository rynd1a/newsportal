@isset($news)
    @method('PUT')
@endisset
@csrf
<div class="form-group mb-2">
    <label for="header">Заголовок</label>
    <input type="text" name="header" class="form-control" placeholder="Введите заголовок"
           value="@isset($news){{$news->header}}@else{{ old('header') }}@endisset">
    @error('header')
    <p class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </p>
    @enderror
</div>
<div class="form-group mb-2">
    <label for="announce">Анонс</label>
    <input type="text" name="announce" class="form-control" placeholder="Введите анонс"
           value="@isset($news){{$news->announce}}@else{{ old('announce') }}@endisset">
    @error('announce')
    <p class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </p>
    @enderror
</div>
<div class="form-group mb-2">
    <label for="image">Загрузите картинку(jpeg, gif)</label>
    <input type="file" name="image" class="form-control">
    @error('image')
    <p class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </p>
    @enderror
</div>
<div class="form-group mb-4">
    <label for="description">Текст новости</label>
    <textarea name="description" class="form-control" rows="20" placeholder="Введите текст новости"> @isset($news){{$news->description}}@else{{ old('description') }}@endisset </textarea>
    @error('description')
    <p class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </p>
    @enderror
</div>
<div class="d-flex justify-content-center">
    <button type="submit" class="btn btn-primary px-5">
        @isset($news)
            Обновить новость
        @else
            Предложить новость
        @endisset
    </button>
</div>
