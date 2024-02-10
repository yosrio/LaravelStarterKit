<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Default data
        view()->composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $userRole = Models\Roles::where('id', $user->role_id)->first();
                $menuList = Models\MenuList::orderBy('sort_order')->get();
                $appName = Models\Configuration::where('name', 'app_name')->first();
                $adminPageTitle = Models\Configuration::where('name', 'admin_page_title')->first();
                $adminLogs = Models\AdminLogActivity::get();
                $view->with([
                    'currentUser'=> $user,
                    'currentUserRole'=> $userRole,
                    'menuList'=> $menuList,
                    'appName'=> $appName,
                    'adminPageTitle'=> $adminPageTitle,
                    'adminLogs'=> $adminLogs
                ]);
            }
        });
    }
}
