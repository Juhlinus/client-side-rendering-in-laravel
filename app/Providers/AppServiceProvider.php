<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Factory as ViewFactory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ViewFactory::macro('component', function ($name, $data = []) {
            return View::make('app', ['name' => $name, 'data' => $data]);
        });

        View::composer('*', function ($view) {
            if (Auth::user()) {
                $view->with('shared', [
                    'auth' => [
                        'user' => [
                            'id' => Auth::user()->id,
                            'name' => Auth::user()->name,
                            'email' => Auth::user()->email,
                        ],
                    ],
                ]);
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
