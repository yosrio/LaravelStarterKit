<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class RoleController extends \App\Http\Controllers\Controller
{
    /**
     * Method index
     *
     * @return string|null
     */
    public function index()
    {
        return view('admin.role.index');
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
