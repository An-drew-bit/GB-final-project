<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\HomeController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class AppRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')->group(function () {
            Route::get('/', HomeController::class);
        });

        Route::middleware('api')->prefix('api')->group(function () {
            Route::post('/articles', [ArticleController::class, 'getAllArticles']);
            Route::post('/article/{article:id}', [ArticleController::class, 'getArticleById']);
            Route::get('/article/comments/{article:id}', [CommentController::class, 'getComments']);
        });
    }
}
