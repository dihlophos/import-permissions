<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        Route::pattern('export', '[0-9]+');
        Route::pattern('indi_export', '[0-9]+');
        Route::pattern('institution', '[0-9]+');
        Route::pattern('organization', '[0-9]+');
        Route::pattern('storage', '[0-9]+');
        Route::pattern('district', '[0-9]+');

        Route::model('transport', App\Models\Transport::class);
        Route::model('purpose', App\Models\Purpose::class);
        Route::model('product_type', App\Models\ProductType::class);
        Route::model('storage', App\Models\Storage::class);
        Route::model('region', App\Models\Region::class);
        Route::model('district', App\Models\District::class);
        Route::model('organization', App\Models\Organization::class);
        Route::model('export', App\Models\Export::class);
        Route::model('indi_export', App\Models\IndiExport::class);
        Route::model('exported_product', App\Models\ExportedProduct::class);
        Route::model('indi_exported_product', App\Models\IndiExportedProduct::class);
        Route::model('processed_product', App\Models\ProcessedProduct::class);
        Route::model('institution', App\Models\Institution::class);
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
