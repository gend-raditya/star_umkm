<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

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
        View::composer('*', function ($view) {
        $count = 0;
        if (Auth::check()) {
            $count = Keranjang::where('user_id', Auth::id())->sum('jumlah');
        }
        $view->with('keranjang_count', $count);
    });
    }
}
