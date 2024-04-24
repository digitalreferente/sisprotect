<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/tablero';
    protected $namespace = 'App\Http\Controllers';

    public function boot()
    {
        parent::boot();
    }

    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        $this->mapLicitacionRoutes();
        $this->mapUsuarioRoutes();
        $this->mapArchivoRoutes();
        $this->mapPerfilRoutes();
        $this->mapClienteRoutes();
        $this->mapCustodioRoutes();
        $this->mapTarifarioRoutes();
        $this->mapProgramacionRoutes();

    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }


    protected function mapLicitacionRoutes()
    {
        Route::middleware('web')
            ->prefix('licitacion')
            ->namespace($this->namespace . '\Licitacion')
            ->group(base_path('routes/licitacion.php'));
    }

    protected function mapUsuarioRoutes()
    {
        Route::middleware('web')
            ->prefix('usuario')
            ->namespace($this->namespace . '\Usuario')
            ->group(base_path('routes/usuario.php'));
    }

    protected function mapArchivoRoutes()
    {
        Route::middleware('web')
            ->prefix('archivo')
            ->namespace($this->namespace . '\Archivo')
            ->group(base_path('routes/archivo.php'));
    }


    protected function mapPerfilRoutes()
    {
        Route::middleware('web')
            ->prefix('perfil')
            ->namespace($this->namespace . '\Perfil')
            ->group(base_path('routes/perfil.php'));
    }


    protected function mapClienteRoutes()
    {
        Route::middleware('web')
            ->prefix('cliente')
            ->namespace($this->namespace . '\Cliente')
            ->group(base_path('routes/cliente.php'));
    }

    protected function mapCustodioRoutes()
    {
        Route::middleware('web')
            ->prefix('custodio')
            ->namespace($this->namespace . '\Custodio')
            ->group(base_path('routes/custodio.php'));
    }

    protected function mapTarifarioRoutes()
    {
        Route::middleware('web')
            ->prefix('tarifario')
            ->namespace($this->namespace . '\Tarifario')
            ->group(base_path('routes/tarifario.php'));
    }

    protected function mapProgramacionRoutes()
    {
        Route::middleware('web')
            ->prefix('programacion')
            ->namespace($this->namespace . '\Programacion')
            ->group(base_path('routes/programacion.php'));
    }
    

}
