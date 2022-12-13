<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Article\ArticleCollection;
use App\Http\Resources\Api\Article\ArticleRelationResource;
use Domain\Information\Models\Article;
use Domain\Information\Queries\ArticleBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    public function getAllArticles(ArticleBuilder $builder): ArticleCollection
    {
        return new ArticleCollection($builder->getAllApprovedArticles());
    }

    public function getArticleById(ArticleBuilder $builder, int $id): JsonResponse
    {
        $article = $builder->getArticleById($id);

        if (!$article) {
            return response()->json([
                'message' => 'Такой статьи нет'
            ]);
        }

        if ($article->user_id !== auth('sanctum')->id()) {
            $this->addViews($article);
        }

        return response()->json([
            'article' => new ArticleRelationResource($article)
        ]);
    }

    private function addViews(Article|Model $article): void
    {
        $article->views += 1;

        $article->update();
    }
}
