<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /* Binding interface/abstract classes and instance from classes */
        $this->app->when(\App\Services\RollCallService::class)
            ->needs(\App\Repositories\BaseRepository::class)
            ->give(\App\Repositories\RollCallRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $o_req)
    {
        Schema::defaultStringLength(191);
        if ($o_req->server->has('HTTP_X_ORIGINAL_HOST')) {
            $this->app['url']->forceRootUrl($o_req->server->get('HTTP_X_FORWARDED_PROTO') . '://' . $o_req->server->get('HTTP_X_ORIGINAL_HOST'));
        }
    }
}
