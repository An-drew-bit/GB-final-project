<?php

namespace App\Models;

use App\Enums\ArticleStatus;
use App\Models\Comment;
use Carbon\Carbon;
use Domain\Category\Models\Category;
use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'views',
        'user_id',
        'category_id',
        'status'
    ];

    protected $casts = [
        'status' => ArticleStatus::class,
        'created_at' => 'date:Y-m-d'
    ];

    protected $hidden = [
        'updated_at'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)
            ->withTimestamps();
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function setArticleDate(): string
    {
        return Carbon::parse($this->created_at)
            ->subDay()
            ->diffForHumans(['options' => Carbon::ONE_DAY_WORDS]);
    }
}
