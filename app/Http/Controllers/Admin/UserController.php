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
use App\Models\User;
use App\Models\Roles;
use App\Models\AdminLogActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
     * @return void
     */
    public function index()
    {
        $users = User::get();
        return view('admin.user.index', ['users' => $users]);
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
                $userSelected = User::find($id);
                return view('admin.user.edit', [
                    'roles' => $roles,
                    'userSelected' => $userSelected
                ]);
            }
            return view('admin.user.edit', ['roles' => $roles]);
        } catch (\Exception $e) {
            Log::channel('exceptions')->error($e);
            return Redirect(route('users'));
        }
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
        $successMessage = '';
        $failedMessage = '';
        $activityDesc = '';
        $activityType = '';
        $activityData = [];
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
            'phone' => 'required'
        ]);

        if ($validator->fails()) {
            Log::channel('exceptions')->warning(implode('\n', $validator->errors()->all()));
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $loggedUser = Auth::user();
        $status = $request->status == 'on' ? true : false;
        DB::beginTransaction();
        try {
            if ($request->id) {
                $user = User::find($request->id);
                $oldUser = User::find($request->id);
                $activityData[] = [
                    'old' => $oldUser
                ];
                $user->name = $request->name;
                $user->email = $request->email;
                $user->username = $request->username;
                $user->status = $status;
                if ($request->password) {
                    $validator = Validator::make($request->all(), [
                        'password' => [
                            'min:8',
                            'max:64',
                            'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,64}$/'
                        ]
                    ]);

                    if ($validator->fails()) {
                        Log::channel('exceptions')->warning(implode('\n', $validator->errors()->all()));
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
                    $user->password = Hash::make($request->password);
                }
                $successMessage = 'Successfully edit user.';
                $failedMessage = 'Something went wrong. Failed to edit user!';
                $activityDesc = $loggedUser->name . ' edit admin user "' . $request->username . '"';
                $activityType = 'update_user';
            } else {
                $user = new User();
                $activityData[] = [
                    'old' => []
                ];
                $validator = Validator::make($request->all(), [
                    'password' => [
                        'required',
                        'min:8',
                        'max:64',
                        'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,64}$/'
                    ],
                    'email' => 'required|email:rfc,dns|unique:users,email',
                ]);

                if ($validator->fails()) {
                    Log::channel('exceptions')->warning(implode('\n', $validator->errors()->all()));
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                $user->name = $request->name;
                $user->username = $request->username;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->status = $status;
                $successMessage = 'Successfully add user.';
                $failedMessage = 'Something went wrong. Failed to add user!';
                $activityDesc = $loggedUser->name . ' created a new admin user, username is "' .
                                $request->username . '"';
                $activityType = 'create_user';
            }
            $roles = Roles::find($request->role_id);
            $user->role_id = $roles->id;
            $user->phone = $request->phone;
            if ($user->save()) {
                DB::commit();
                $activityData[] = [
                    'new' =>  $user->fresh()
                ];
                $activityData = json_encode($activityData);
                AdminLogActivity::create([
                    'user_id' => $loggedUser->id,
                    'activity_type' => $activityType,
                    'activity_description' => $activityDesc,
                    'activity_date' => \Carbon\Carbon::now(),
                    'activity_data' => $activityData,
                ]);
                return redirect(route('users'))->with('success', $successMessage);
            }
        } catch (\Exception $e) {
            DB::rollback();
            Log::channel('exceptions')->error($e);
            return redirect()->back()->with('error', $failedMessage);
        }
        return;
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
        $activityData = [];
        $loggedUser = Auth::user();
        $user = User::find($id);
        $oldUser = User::find($id);

        try {
            $activityData = [
                'old' => $oldUser,
                'new' => []
            ];
            $activityData = json_encode($activityData);
            $activityDesc = $loggedUser->name . ' deleted admin user "' . $oldUser->username . '"';

            if ($id === 1) {
                return redirect(route('users'))->with('error', 'Failed to delete default user.');
            }

            if ($loggedUser->id === $user->id) {
                return redirect(route('users'))->with('error', 'Cannot delete the user you are currently using!');
            }

            if ($user->delete()) {
                AdminLogActivity::create([
                    'user_id' => Auth::user()->id,
                    'activity_type' => 'delete_user',
                    'activity_description' => $activityDesc,
                    'activity_date' => \Carbon\Carbon::now(),
                    'activity_data' => $activityData,
                ]);
                return redirect(route('users'))->with('success', 'Successfully delete user.');
            }
        } catch (\Exception $e) {
            Log::channel('exceptions')->error($e);
        }

        return redirect(route('users'))->with('error', 'Failed to delete user.');
    }
}
