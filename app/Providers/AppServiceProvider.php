<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route; 

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
        Blade::directive('adminRoute', function ($expression) {
            // $expression est le nom de la route sans 'admin.' (ex: 'langues.create')
            // Nous retournons une instruction PHP qui ajoute 'admin.' et appelle la fonction route()
            return "<?php echo route('admin.' . $expression); ?>";
        });
        //

        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
