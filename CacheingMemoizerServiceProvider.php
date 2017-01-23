<?php

namespace CyberDuck\LaravelCacheingMemoizer;

use Illuminate\Support\ServiceProvider;
use CyberDuck\CacheingMemoizer\CacheingMemoizer;

class CacheingMemoizerServiceProvider extends ServiceProvider {

    public function boot()
    {
        CacheingMemoizer::addShutdownFunction(function($key, $value){
            \Cache::put($key, $value, CacheingMemoizer::getCacheDuration());
        });

        CacheingMemoizer::setCacheRetrievalFunction([\Cache::getFacadeRoot(), 'get']);

        app()->terminating(function(){
            CacheingMemoizer::shutdown();
        });

    }

    public function register()
    {
        //ooo eee ooo aaa aaa ting tang walla walla wing bang
    }

}