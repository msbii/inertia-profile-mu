<?php

namespace App\Providers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Sejarah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
    public function boot()
{
    // Kirim data sejarah ke semua halaman
    Inertia::share('sejarah', function () {
        return Sejarah::where('title', 'like', '%Muhammadiyah%')
            ->orWhere('title', 'like', '%Aisyiyah%')
            ->get();
    });

    Inertia::share([
        'auth' => [
            'user' => fn () => Auth::check() ? [
                'id' => Auth::id(),
                'name' => Auth::user()->name,
                'role' => Auth::user()->role,
            ] : null,
        ],
        'darkmode' => fn () => session()->has('darkmode'),
    ]);

}
}
