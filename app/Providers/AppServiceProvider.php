<?php

namespace App\Providers;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\Traits\DateHelperTrait;

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
        Blade::directive('shortTime', function ($expression) {
            return "<?php echo App\Traits\DateHelperTrait::formatShortTime($expression); ?>";
        });
    }
}
