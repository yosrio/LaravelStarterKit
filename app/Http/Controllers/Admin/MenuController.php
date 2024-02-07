<?php

/**
 * MenuController
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
use App\Models\MenuList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

/**
 * MenuController
 *
 * This controller handles menu.
 */
class MenuController extends \App\Http\Controllers\Controller
{
    /**
     * Method index
     *
     * @return void
     */
    public function index()
    {
        return view('admin.menu.index');
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
            if ($id != null) {
                $menuSelected = MenuList::find($id);
                return view('admin.menu.edit', ['menuSelected' => $menuSelected]);
            }
        } catch (\Exception $e) {
            Log::channel('exceptions')->error($e);
            return Redirect(route('roles'));
        }
        return view('admin.menu.edit');
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
        $validator = Validator::make($request->all(), [
            'menu_id' => 'required',
            'menu_title' => 'required',
            'route' => 'required',
            'icon' => 'required'
        ]);

        if ($validator->fails()) {
            Log::channel('exceptions')->warning(implode('\n', $validator->errors()->all()));
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $menuItem = [
                'menu_id' => strtolower($request->menu_id),
                'menu_title' => $request->menu_title,
                'route' => strtolower($request->route),
                'icon' => $request->icon
            ];
            if (isset($request->submenu)) {
                $menuItem['items'] = json_decode($request->submenu, true);
                $successMessage = 'Successfully edit menu.';
                $failedMessage = 'Something went wrong. Failed to update menu!';
            }
            if ($request->id) {
                $menu = MenuList::find($request->id);
            } else {
                $menu = new MenuList();
                $successMessage = 'Successfully add menu.';
                $failedMessage = 'Something went wrong. Failed to add menu!';
            }
            $menu->menu_group = ucfirst(strtolower($request->menu_id));
            $menu->menu_item = json_encode($menuItem);
            $menu->sort_order = $request->sort_order;
            if ($menu->save()) {
                DB::commit();
                return redirect(route('menus'))->with('success', $successMessage);
            }
        } catch (\Exception $e) {
            DB::rollback();
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
        $menu = MenuList::find($id);

        try {
            if ($menu->delete()) {
                return redirect(route('menus'))->with('success', 'Successfully delete menu.');
            }
        } catch (\Exception $e) {
            Log::channel('exceptions')->error($e);
        }

        return redirect(route('menus'))->with('error', 'Failed delete menu.');
    }
}
