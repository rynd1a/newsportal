<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

/**
 * @method static paginate(int $int)
 * @method static create(array $data)
 * @method static orderBy(string $string, string $string1)
 * @method static published()
 * @method where(string $string, bool $true)
 * @method static latest()
 * @method static notPublished()
 * @method static sort(mixed $sort, ?mixed $published)
 * @property int $views
 * @property mixed $id
 * @property bool $published
 */
class News extends Model
{
    protected $table = 'news';
    protected $fillable = ['header', 'date', 'announce', 'image_id', 'description', 'user_id', 'views'];
    use HasFactory;
    use Searchable;

    /**
     * Получение связанного пользователя
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function toSearchableArray(): array
    {
        return $this->toArray();
    }

    /**
     * Определение, когда модель должна быть доступной для поиска.
     *
     * @return bool
     */
    public function shouldBeSearchable(): bool
    {
        return $this->published;
    }

    public function searchableAs(): string
    {
        return 'news';
    }

    /**
     * Получение опубликованных новостей
     * @param Builder $builder
     * @param bool|null $status
     * @return Builder
     */
    public function scopePublished(Builder $builder, ?bool $status=true): Builder
    {
        return $builder->where('published', $status);
    }

    /**
     * Увеличение просмотров новости на 1
     * @return void
     */
    public function incrementViews(): void
    {
        $this->increment('views');
    }

    /**
     * Публикация новости
     * @return void
     */
    public function setPublished(): void
    {
        $this->published = true;
        $this->save();
    }

    /**
     * Получение отсортированного списка новостей
     * @param $builder
     * @param string|null $sort
     * @param string|null $published
     * @return Builder
     */
    public function scopeSort($builder, ?string $sort, ?string $published=null): Builder
    {
        $news = match ($published) {
            'true' => $builder->published(),
            'false' => $builder->published(false),
            default => $builder,
        };

        if (isset($sort)) {
            $sort = explode(' ', $sort);
            $news = $news->orderBy($sort[0], $sort[1]);
        }

        return $news;
    }

    /**
     * Получение связанного изображения
     * @return BelongsTo
     */
    public function image(): belongsTo
    {
        return $this->belongsTo(Image::class);
    }
}
