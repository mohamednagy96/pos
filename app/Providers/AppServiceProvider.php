<?php

namespace App\Providers;

use App\Admin\Setting;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $settings=Setting::pluck('value','key')->toArray();
           $settings = Setting::all('key', 'value')
           ->keyBy('key')
           ->transform(function ($setting) {
               return $setting->value;
           })->toArray();
        // dd($settings);

           config([
               'settings' => $settings
               ]);
            //    dd(config('settings'));

       config(['app.name' => config('settings.app_name')]);

    }
}
