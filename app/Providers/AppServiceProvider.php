<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Please note the different namespace
        // and please add a \ in front of your classes in the global namespace
        \Event::listen('cron.collectJobs', function () {

            \Cron::add('example1', '* * * * *', function () {
                $this->index();

                return 'No';
            });

            \Cron::add('example2', '*/2 * * * *', function () {
                // Do some crazy things successfully every two minute

            });

            \Cron::add('disabled job', '0 * * * *', function () {
                // Do some crazy things successfully every hour
            }, false);
        });
    }

    /**
     * Register any application services.
     *
     * This service provider is a great spot to register your various container
     * bindings with the application. As you can see, we are registering our
     * "Registrar" implementation here. You can add your own bindings too!
     *
     * @return void
     */
    public function register()
    {
        //if ($this->app->environment() == 'local') {

        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}
