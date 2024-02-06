<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Roles;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RoleController extends \App\Http\Controllers\Controller
{
    /**
     * Method index
     *
     * @return string|null
     */
    public function index()
    {
        $roles = Roles::get();
        return view('admin.role.index', ['roles' => $roles]);
    }

    /**
     * Method index
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
     * @return string|null
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

            $role = ($request->id) ? Roles::find($request->id) : new Roles;
            $role->role_name = $request->rolename;
            $successMessage = ($request->id) ? 'Successfully Edit Role.' : 'Successfully Add Role.';
            $failedMessage = ($request->id) ? 'Something went wrong. Failed to edit role!' : 'Something went wrong. Failed to add role!';

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
     * @return string|null
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
