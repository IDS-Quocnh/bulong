<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        View::composer(
            ['front.sidebar.left', 'front.includes.sidebar_left'],
            'App\Http\View\Composers\FrontSidebarComposer'
        );
        View::composer(
            'front.sidebar.right',
            'App\Http\View\Composers\Frontend\SponsorComposer'
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
