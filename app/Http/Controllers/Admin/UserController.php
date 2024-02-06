<?php

/**
 * UserController
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
 * UserController
 *
 * This controller handles users.
 */
class UserController extends \App\Http\Controllers\Controller
{
    /**
     * Method index
     *
     * @return string|null
     */
    public function index()
    {
        return view('admin.user.index');
    }

    /**
     * Method index
     *
     * @return string|null
     */
    public function addOrUpdate()
    {
        return view('admin.role.edit');
    }
}
