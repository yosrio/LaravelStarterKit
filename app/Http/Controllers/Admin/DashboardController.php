<?php

namespace App\Http\Controllers\Admin;

/**
 * DashboardController
 */
class DashboardController extends \App\Http\Controllers\Controller
{
    
    /**
     * Method index
     *
     * @return string|null
     */
    public function index()
    {
        return view('admin.dashboard.index');
    }
}
