<?php
namespace etuan\provider;
use \Illuminate\Support\ServiceProvider;
use UserfulTool;
class MyToolServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind('UsefulTool',function()
       {
           return new UserfulTool;
       });
    }

}