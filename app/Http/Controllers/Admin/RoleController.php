<?php

/**
 * RoleController
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
use App\Models\Roles;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

/**
 * RoleController
 *
 * This controller handles role.
 */
class RoleController extends \App\Http\Controllers\Controller
{
    /**
     * Method index
     *
     * @return void
     */
    public function index()
    {
        $roles = Roles::get();
        return view('admin.role.index', ['roles' => $roles]);
    }

    /**
     * Method addOrUpdate
     *
     * @param int|string|null $id
     *
     * @return void
     */
    public function addOrUpdate($id = null)
    {
        try {
            $roles = Roles::get();
            if ($id != null) {
                $roleSelected = Roles::find($id);
                return view('admin.role.edit', ['roleSelected' => $roleSelected]);
            }
        } catch (\Exception $e) {
            Log::channel('exceptions')->error($e);
            return Redirect(route('roles'));
        }
        return view('admin.role.edit');
    }

    /**
     * Method save
     *
     * @param Request $request
     *
     * @return void
     */
    public function save(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'rolename' => ['required', 'string', 'regex:/^[^0-9]*$/'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if ($request->id) {
                $role = Roles::find($request->id);
                $successMessage = 'Successfully edit role.';
                $failedMessage = 'Something went wrong. Failed to edit role!';
            } else {
                $role = new Roles();
                $successMessage = 'Successfully add role.';
                $failedMessage = 'Something went wrong. Failed to add role!';
            }

            $role->role_name = $request->rolename;
            $allowedPerm = $request->allow;
            $permissions = $this->getPermissions($allowedPerm);
            $permissions = json_encode($permissions);
            $role->permission = $permissions;

            if ($role->save()) {
                return redirect(route('roles'))->with('success', $successMessage);
            }
        } catch (\Exception $e) {
            Log::channel('exceptions')->error($e);
            return redirect()->back()->with('error', $failedMessage);
        }
    }

    /**
     * Method delete
     *
     * @param int|string $id
     *
     * @return void
     */
    public function delete($id)
    {
        $roles = Roles::find($id);

        try {
            if ($roles->delete()) {
                return redirect(route('roles'))->with('success', 'Successfully delete role.');
            }
        } catch (\Exception $e) {
            Log::channel('exceptions')->error($e);
        }

        return redirect(route('roles'))->with('error', 'Failed delete role.');
    }

    /**
     * Method getPermissions
     *
     * @param $allowedPerm $allowedPerm
     *
     * @return array
     */
    public function getPermissions($allowedPerm)
    {
        $permissions = array();
        foreach ($allowedPerm as $allow) {
            $arr = explode('|', $allow);
            $temp = array();
            if (array_key_exists($arr[0], $permissions)) {
                $temp = $permissions[$arr[0]];
                array_push($temp, $arr[1]);
                $permissions[$arr[0]] = $temp;
                continue;
            }
            $permissions[$arr[0]] = [$arr[1]];
        }

        return $permissions;
    }
}
