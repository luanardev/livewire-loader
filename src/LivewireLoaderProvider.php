<?php

namespace Luanardev\LivewireLoader;
use Luanardev\LivewireLoader\LivewireLoader;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Livewire\Livewire;


class LivewireLoaderProvider extends ServiceProvider
{
   
	public function boot()
    {
        $this->registerViews();
        $this->registerDirectives();
        $this->registerPublishables();;
        $this->registerLivewireComponents();
    }

    private function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'livewire-loader');
    }

    private function registerDirectives()
    {
        Blade::directive('livewireLoaderScripts', function () {
            return '<script src="' . asset("/vendor/livewire-loader/loader.js") . '"></script>';
        });
    }

    private function registerPublishables(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/livewire-loader'),
            ], 'livewire-loader:views');

            $this->publishes([
                __DIR__ . '/../resources/js' => public_path('vendor/livewire-loader'),
            ], 'livewire-loader:scripts');
        }
    }

    private function registerLivewireComponents(): void
    {
        Livewire::component('livewire-loader', LivewireLoader::class);
    }

    
	
	
}
