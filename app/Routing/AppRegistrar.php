<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\HomeController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class AppRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')->group(function () {
            Route::get('/', [HomeController::class, 'index']);
        });

        Route::middleware('api')->prefix('api')->group(function () {
            Route::post('/articles', [HomeController::class, 'getAllArticles']);
            Route::post('/categories', [HomeController::class, 'getAllCategories']);
        });
    }
}
