<?php

namespace Devtical\DrunkOn419;

use Devtical\DrunkOn419\Http\Middleware\HandleDrunkOn419;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'drunkon419');

        $this->publishes([
            __DIR__.'/../lang' => $this->app->langPath('vendor/drunkon419'),
        ], 'drunkon419-translations');

        $kernel = $this->app->make(Kernel::class);
        $groups = $kernel->getMiddlewareGroups();

        if (isset($groups['web'])) {
            $webGroup = $groups['web'];
            $newWebGroup = [];

            foreach ($webGroup as $middleware) {
                if ($middleware == 'Illuminate\Foundation\Http\Middleware\ValidateCsrfToken') {
                    $newWebGroup[] = HandleDrunkOn419::class;
                }
                $newWebGroup[] = $middleware;
            }

            $groups['web'] = $newWebGroup;
        }

        $kernel->setMiddlewareGroups($groups);
    }
}
