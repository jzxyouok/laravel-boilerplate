<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PostRepository;
use App\Repositories\Contracts\TagRepository;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class FrontendController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        Route::bind('post', function ($value) {
            /** @var PostRepository $posts */
            $posts = app(PostRepository::class);

            return $posts->findBySlug($value);
        });

        Route::bind('tag', function ($value) {
            /** @var PostRepository $posts */
            $tags = app(TagRepository::class);

            return $tags->findBySlug($value);
        });

        Route::bind('user', function ($value) {
            /** @var UserRepository $posts */
            $users = app(UserRepository::class);

            return $users->findBySlug($value);
        });
    }

    public function index()
    {
        return view('frontend.home');
    }

    /**
     * Push attributes in order to correctly localize slugs.
     *
     * @param $attributes
     */
    protected function setLocalesAttributes($attributes)
    {
        View::composer(['partials.alternates', 'partials.locales'], function (\Illuminate\View\View $view) use ($attributes) {
            $view->withAttributes($attributes);
        });
    }

    /**
     * Push translatable object in order to correctly localize slugs.
     *
     * @param $translatable
     */
    protected function setTranslatable($translatable)
    {
        View::composer(['partials.alternates', 'partials.locales'], function (\Illuminate\View\View $view) use ($translatable) {
            $view->withTranslatable($translatable);
        });
    }
}
