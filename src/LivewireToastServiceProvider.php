<?php

namespace Ascsoftw\LivewireToast;

use Illuminate\Support\ServiceProvider;
use Ascsoftw\LivewireToast\Http\Livewire\LivewireToast;
use Livewire\Livewire;

class LivewireToastServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Livewire::component('livewire-toast', LivewireToast::class);
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'livewire-toast');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/livewire-toast')
        ], 'views');

        $this->publishes([
            __DIR__.'/../config/livewire-toast.php' => base_path('config/livewire-toast.php')
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ .'/../config/livewire-toast.php', 'livewire-toast');
    }
}
