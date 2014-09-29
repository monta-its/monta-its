<?php 
/**
 * SimtaHasherServiceProvider
 * digunakan untuk IoC (meng-inject) komponen 'hash'.
 */
namespace Simta\Libraries;
use Illuminate\Support\ServiceProvider;

class SimtaHasherServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind('hash', function()
        {
            return new SimtaHasher;
        });
    }

}