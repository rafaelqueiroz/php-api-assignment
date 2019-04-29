<?php

namespace App\Providers;

use App\Http\Clients\NCAPClient;
use App\Http\Clients\NCAPHttpClient;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class NCAPClientProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            NCAPClient::class,
            NCAPHttpClient::class
        );
    }
}
