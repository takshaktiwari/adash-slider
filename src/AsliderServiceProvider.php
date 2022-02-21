<?php

namespace Takshak\Aslider;
use Illuminate\Support\ServiceProvider;
use Takshak\Aslider\Console\InstallCommand;
use Illuminate\Pagination\Paginator;

class AsliderServiceProvider extends ServiceProvider
{
	public function boot()
	{
	    $this->commands([ InstallCommand::class ]);
	    $this->loadViewsFrom(__DIR__.'/../resources/views/admin/sliders', 'aslider');
	   /* $this->loadViewComponentsAs('ablog', [
	        View\Components\Blog\PostCard::class,
	        View\Components\Blog\PostGallery::class,
	        View\Components\Blog\Sidebar::class,
	        View\Components\Blog\Comment::class,
	    ]);*/

	    Paginator::useBootstrap();
	    $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    	$this->publishes([
            __DIR__.'/../resources/views' => resource_path('views'),
        ]);
	}

}
