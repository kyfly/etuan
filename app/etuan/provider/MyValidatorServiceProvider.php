<?php
namespace etuan\provider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use DatabaseValidator;
class MyValidatorServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(){}

    public function boot()
    {
        Validator::resolver(function($translator, $data, $rules, $messages)
        {
            return new DatabaseValidator($translator, $data, $rules, $messages);
        });
    }
}