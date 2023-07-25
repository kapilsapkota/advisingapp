<?php

namespace Assist\CaseModule\Providers;

use Filament\Panel;
use Assist\CaseModule\CasePlugin;
use Illuminate\Support\ServiceProvider;

class CaseModuleServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Note: If an additional Filament panel is created and used, we will need to modify these plugins to only ever load on certain panels
        Panel::configureUsing(fn (Panel $panel) => $panel->plugin(new CasePlugin()));
    }

    //public function boot()
    //{
    //    filament()->getPanel('admin')
    //        ->plugin(new CasePlugin());
    //}
}
