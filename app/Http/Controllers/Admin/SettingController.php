<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class SettingController extends \App\Http\Controllers\Controller
{
    /**
     * Method index
     *
     * @return string|null
     */
    public function configuration()
    {
        return view('admin.setting.configuration');
    }
    
    /**
     * Method index
     *
     * @return string|null
     */
    public function integration()
    {
        return view('admin.setting.integration');
    }
}
