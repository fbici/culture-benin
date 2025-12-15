<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Blade::directive('adminRoute', function ($expression) {
            return "<?php echo route('admin.' . $expression); ?>";
        });

        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
