<?php

namespace App\Providers;

use DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

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
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        # dd(request()->getHost());
       

        if (request()->getHost() == env("APP_DOMAIN", "membership.local") || app()->runningInConsole())
        {
            $this->mapApiRoutes();
            $this->mapWebRoutes();
        } else {
            # TODO: Get artists from DB
            $this->mapApiArtistRoutes();
            $_domain=request()->getHost();
            $artist = DB::table('contact_information')
            ->where('domain', $_domain)
            ->first();

            if (! $artist || $artist->domain!=request()->getHost())
                abort(404);

            $this->mapWebArtist();
        }
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

    protected function mapWebArtist()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/artist.php'));
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
    protected function mapApiArtistRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/apiartist.php'));
    }
}
