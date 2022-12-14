<?php

namespace App\Providers;

use App\Contracts\RouteRegistrar;
use App\Routing\AdminRegistrar;
use App\Routing\AppRegistrar;
use Domain\Information\Routing\ArticleRegistrar;
use Domain\Information\Routing\CategoryRegistrar;
use Domain\Information\Routing\TagRegistrar;
use Domain\Interactive\Routing\BookmarkRegistrar;
use Domain\Interactive\Routing\LikeRegistrar;
use Domain\Interactive\Routing\NotificationRegistrar;
use Domain\User\Routing\AuthRegistrar;
use Domain\User\Routing\CommentRegistrar;
use Domain\User\Routing\ProfileRegistrar;
use Domain\User\Routing\SocialiteRegistrar;
use Domain\User\Routing\UserArticleRegistrar;
use Domain\User\Routing\UserCommentRegistrar;
use Domain\User\Routing\UserRegistrar;
use Domain\User\Routing\VerifyEmailRegistrar;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use RuntimeException;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    protected array $registrars = [
        AdminRegistrar::class,
        AppRegistrar::class,
        AuthRegistrar::class,
        SocialiteRegistrar::class,
        CategoryRegistrar::class,
        ArticleRegistrar::class,
        VerifyEmailRegistrar::class,
        ProfileRegistrar::class,
        CommentRegistrar::class,
        TagRegistrar::class,
        UserRegistrar::class,
        LikeRegistrar::class,
        BookmarkRegistrar::class,
        UserArticleRegistrar::class,
        UserCommentRegistrar::class,
        NotificationRegistrar::class,
    ];

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(fn(Registrar $router) => $this->mapRoutes($router, $this->registrars));
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for('auth', fn(Request $request) => Limit::perMinute(20)
            ->by($request->ip()));

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }

    protected function mapRoutes(Registrar $router, array $registrars): void
    {
        foreach ($registrars as $registrar) {
            if (!class_exists($registrar) || !is_subclass_of($registrar, RouteRegistrar::class)) {
                throw new RuntimeException(sprintf(
                    'Cannot map routes \'%s\', it is not valid route class',
                    $registrar
                ));
            }

            (new $registrar)->map($router);
        }
    }
}
