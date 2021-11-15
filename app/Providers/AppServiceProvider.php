<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Pusher\PushNotifications\PushNotifications;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PushNotifications::class, function () {
            $config = config('services.beams');
            
            return new PushNotifications([
                'instanceId' => $config['instance_id'],
                'secretKey' => $config['secret_key'],
            ]);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        URL::forceScheme('https');

        Collection::macro('withSortKeys', function($callback) {
            //macros callbacks are bound to collection so we can safely access
            // protected Collection::items
            uksort($this->items,$callback);
            
            return $this;
        });
    }
}
