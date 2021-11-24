<?php

namespace App\Providers;

use App\Repositories\FinnhubStocksRepository;
use App\Repositories\StocksRepository;
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
        $this->app->bind(StocksRepository::class, function () {
            return new FinnhubStocksRepository(env('FINNHUB_API_KEY'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
