<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrapFour();

        $websiteLang = 'ar';
        $langs = ['ar'];
        $locales = ['ar'];
        $default = $locales[0];
        $localeSegment = request()->segment(1);
        if (in_array($localeSegment, $locales)) {
            app()->setLocale($localeSegment);
        } else {
            app()->setLocale($websiteLang);
        }

        $segment = request()->segment(3);
        $urlQuery = request()->query();
        // Get current Language
        $locale = app()->getLocale();

        // Get Language Direction
        $dir = 'rtl';


        /**
         * Check if Website in  [ Maintenance Mode ] or Not
         */
        // $websiteStatus = Setting::where('key', 'website_status')->value('value');
        // if ($websiteStatus == '0') {
        //     Artisan::call('down');
        // } else {
        //     Artisan::call('up');
        // }

        view()->share(compact('segment', 'urlQuery', 'locale', 'dir', 'langs'));
    }
}
