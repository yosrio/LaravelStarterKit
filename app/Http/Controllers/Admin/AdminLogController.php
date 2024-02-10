<?php

/**
 * AdminLogController
 *
 * PHP version 8.1
 *
 * @package  App\Http\Controllers\Admin
 * @category Controllers
 * @author   Yos Rio
 * @license  http://opensource.org/licenses/MIT MIT License
 */

namespace App\Http\Controllers\Admin;

use App\Models\AdminLogActivity;
use Illuminate\Support\Facades\Log;

/**
 * AdminLogController
 *
 * This controller handles dashboard.
 */
class AdminLogController extends \App\Http\Controllers\Controller
{
    /**
     * Method index
     *
     * @return string|null
     */
    public function index()
    {
        return view('admin.report.adminlog');
    }

    /**
     * adminLogDetail
     *
     * @param int $id
     * @return void
     */
    public function adminLogDetail($id)
    {
        try {
            $adminLogSelected = AdminLogActivity::find($id);
            return view('admin.report.adminlog_detail', [
                'adminLogSelected' => $adminLogSelected
            ]);
        } catch (\Exception $e) {
            Log::channel('exceptions')->error($e);
            return Redirect(route('reports_adminlog'));
        }
    }
}
