<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Telegram\Bot\Laravel\Facades\Telegram;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Telegram::setWebhook(['url' => 'https://thoyiburrohman.my.id/6299028154:AAFdMR8vdsUfErXNbBFoqxCnQYEmYnRaBvI/webhook']);
    }
}
