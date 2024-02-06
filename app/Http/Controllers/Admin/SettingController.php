<?php

/**
 * SettingController
 *
 * PHP version 8.1
 *
 * @package  App\Http\Controllers\Admin
 * @category Controllers
 * @author   Yos Rio
 * @license  http://opensource.org/licenses/MIT MIT License
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

/**
 * SettingController
 *
 * This controller handles setting.
 */
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
