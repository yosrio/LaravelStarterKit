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
use App\Models\Configuration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * SettingController
 *
 * This controller handles setting.
 */
class SettingController extends \App\Http\Controllers\Controller
{
    /**
     * Method configuration
     *
     * @return void
     */
    public function configuration()
    {
        $configurations = $this->grouppedConfig(Configuration::get());
        return view('admin.setting.configuration', ["configurations" => $configurations]);
    }

    /**
     * Method configurationSave
     *
     * @param Request $request
     *
     * @return void
     */
    public function configurationSave(Request $request)
    {
        DB::beginTransaction();
        try {
            $requestData = $request->all();
            $configs = $requestData['configs'];
            foreach ($configs as $key => $value) {
                $configSave = Configuration::find($key);
                $configSave->update(['value' => $value]);
            }
            DB::commit();
            return redirect()->back()->with('success', 'Successfuly save configuration.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::channel('exceptions')->error($e);
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    /**
     * Method integration
     *
     * @return void
     */
    public function integration()
    {
        return view('admin.setting.integration');
    }

    /**
     * grouppedConfig function
     *
     * @param Configuration $configurations
     * @return array
     */
    private function grouppedConfig($configurations)
    {
        $groupedData = [];

        foreach ($configurations as $item) {
            $groupName = $item['group'];
            if (!isset($groupedData[$groupName])) {
                $groupedData[$groupName] = [];
            }
            $groupedData[$groupName][] = [
                'id' => $item['id'],
                'name' => $item['name'],
                'type' => $item['type'],
                'value' => $item['value']
            ];
        }

        return $groupedData;
    }
}
