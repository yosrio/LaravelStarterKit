<?php

/**
 * CacheController
 *
 * PHP version 8.1
 *
 * @package  App\Http\Controllers\Admin
 * @category Controllers
 * @author   Yos Rio
 * @license  http://opensource.org/licenses/MIT MIT License
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Artisan;

/**
 * CacheController
 *
 * This controller handles cache.
 */
class CacheController extends \App\Http\Controllers\Controller
{
    /**
     * Method cache
     *
     * @return void
     */
    public function cache()
    {
        return view('admin.setting.cache_management');
    }

    /**
     * Method cacheAll
     *
     * @return void
     */
    public function cacheAll()
    {
        try {
            Artisan::call('cache:clear');
            return redirect(route('settings_cache_management'))->with('success', 'Successfuly to clear cache.');
        } catch (\Exception $e) {
            return redirect(route('settings_cache_management'))->with('error', 'Something went wrong.');
        }
    }

    /**
     * Method cacheConfig
     *
     * @return void
     */
    public function cacheConfig()
    {
        try {
            Artisan::call('config:clear');
            return redirect(route('settings_cache_management'))->with('success', 'Successfuly to clear cache configuration.');
        } catch (\Exception $e) {
            return redirect(route('settings_cache_management'))->with('error', 'Something went wrong.');
        }
    }

    /**
     * Method cacheRoute
     *
     * @return void
     */
    public function cacheRoute()
    {
        try {
            Artisan::call('route:clear');
            return redirect(route('settings_cache_management'))->with('success', 'Successfuly to clear cache route.');
        } catch (\Exception $e) {
            return redirect(route('settings_cache_management'))->with('error', 'Something went wrong.');
        }
    }

    /**
     * Method cacheView
     *
     * @return void
     */
    public function cacheView()
    {
        try {
            Artisan::call('view:clear');
            return redirect(route('settings_cache_management'))->with('success', 'Successfuly to clear cache view.');
        } catch (\Exception $e) {
            return redirect(route('settings_cache_management'))->with('error', 'Something went wrong.');
        }
    }
}
