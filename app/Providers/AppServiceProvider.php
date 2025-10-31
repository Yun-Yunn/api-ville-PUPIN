<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema; // ⬅️ ajoute ceci !

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // ⬇️ ajoute cette ligne :
        Schema::defaultStringLength(191);
    }
}
