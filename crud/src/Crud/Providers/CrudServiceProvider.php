<?php

namespace Crud\Providers;

use Illuminate\Support\ServiceProvider;

class CrudServiceProvider extends ServiceProvider
{
    
    public function boot()
    {
        /**
         * Define de qual diretório o pacote 
         * deverá carregar as rotas.
         */
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
    
        /**
         * Define em qual diretórios estão 
         * armazenadas as views deste pacote.
         */
        $this->loadViewsFrom(__DIR__ . '/../../views', 'crud');

        /**
         * Define o diretório responsável 
         * pelas migrações deste pacote.
         */
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations/');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}