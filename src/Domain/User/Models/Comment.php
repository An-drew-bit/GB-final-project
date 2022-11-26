<?php

namespace Domain\User\Models;

use Domain\Information\Models\Article;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Support\Traits\DateConversion;

class Comment extends Model
{
    use HasFactory, DateConversion;

    protected $fillable = [
        'comment',
        'user_id',
        'article_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}
