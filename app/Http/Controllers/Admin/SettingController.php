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
use App\Models\Integration;
use App\Models\AdminLogActivity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        $activityDesc = '';
        $activityType = '';
        DB::beginTransaction();
        try {
            $loggedUser = Auth::user();
            $requestData = $request->all();
            $configs = $requestData['configs'];
            foreach ($configs as $key => $value) {
                $configSave = Configuration::find($key);
                $configSave->update(['value' => $value]);
            }
            $activityDesc = $loggedUser->name .' edit configuration';
            $activityType = 'update_configuration';
            DB::commit();
            AdminLogActivity::create([
                'user_id' => $loggedUser->id,
                'activity_type' => $activityType,
                'activity_description' => $activityDesc,
                'activity_date' => \Carbon\Carbon::now(),
            ]);
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
        $userLoggedIn = Auth::user();
        $integrations = Integration::where('user_id',$userLoggedIn->id)->get();
        return view('admin.setting.integration', ['integrations' => $integrations]);
    }

    /**
     * Method integrationSave
     *
     * @param Request $request
     *
     * @return void
     */
    public function integrationSave(Request $request)
    {
        $successMessage = '';
        $failedMessage = '';
        $activityDesc = '';
        $activityType = '';
        $activityData = [];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            Log::channel('exceptions')->warning(implode('\n', $validator->errors()->all()));
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $userLoggedIn = Auth::user();
            if ($request->id) {
                $successMessage = 'Successfully edit integration.';
                $failedMessage = 'Something went wrong. Failed to edit integration!';
                $activityDesc = $userLoggedIn->name .' edit integration named "' . $request->name . '"';
                $activityType = 'update_integration';

                $integration = Integration::find($request->id);
                $oldIntegration = Integration::find($request->id);
                $activityData[] = [
                    'old' => $oldIntegration
                ];
            } else {
                $successMessage = 'Successfully add integration.';
                $failedMessage = 'Something went wrong. Failed to add integration!';
                $activityDesc = $userLoggedIn->name .' add a new integration named "' . $request->name . '"';
                $activityType = 'create_integration';

                $integration = new Integration();
                $activityData[] = [
                    'old' => []
                ];
                $expiredTime = 2592000; #30 days
                $expiredDate = date('Y-m-d', time() + $expiredTime);
                $token = $this->generateToken($userLoggedIn->id, $request->token_type, $expiredTime);
                $integration->token = $token;
                $integration->expired_at = $expiredDate;
                $integration->token_type = $request->token_type;
            }
            $integration->name = $request->name;
            $integration->permissions = json_encode($request->allow);
            $integration->user_id = $userLoggedIn->id;
            if ($integration->save()) {
                DB::commit();
                $activityData[] = [
                    'new' =>  $integration->fresh()
                ];
                $activityData = json_encode($activityData);
                AdminLogActivity::create([
                    'user_id' => $userLoggedIn->id,
                    'activity_type' => $activityType,
                    'activity_description' => $activityDesc,
                    'activity_date' => \Carbon\Carbon::now(),
                    'activity_data' => $activityData,
                ]);
                return redirect(route('settings_integration'))->with('success', $successMessage);
            }
        } catch (\Exception $e) {
            DB::rollback();
            Log::channel('exceptions')->error($e);
            return redirect()->back()->with('error', $failedMessage);
        }
    }

    /**
     * Method integrationAddOrUpdate
     *
     * @param int|string|null $id
     *
     * @return void
     */
    public function integrationAddOrUpdate($id = null)
    {
        try {
            $integrationMasterData = config('masterdataintegration');
            if ($id != null) {
                $integrationSelected = Integration::find($id);
                return view('admin.setting.integration_edit', [
                    'integrationSelected' => $integrationSelected,
                    'integrationMasterData' => $integrationMasterData
                ]);
            }
            return view('admin.setting.integration_edit', [
                'integrationMasterData' => $integrationMasterData
            ]);
        } catch (\Exception $e) {
            Log::channel('exceptions')->error($e);
            return Redirect(route('settings_integration'));
        }
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
    
    /**
     * generateToken
     *
     * @param  mixed $user_id
     * @param  string $token_type
     * @param  mixed $expiration_time
     * @return string
     */
    private function generateToken($user_id, $token_type, $expiration_time = 3600)
    {
        $header = [
            'alg' => 'HS256', // Algorithm yang digunakan (HMAC SHA-256)
            'typ' => 'JWT'    // Tipe token, dalam hal ini adalah JWT
        ];

        $header = base64_encode(json_encode($header));

        $payload = [
            'user_id' => $user_id,  // Informasi pengguna atau data lain yang ingin Anda sertakan dalam token
            'exp' => time() + $expiration_time // Waktu kadaluarsa token
        ];

        $payload = base64_encode(json_encode($payload));

        // Membuat signature menggunakan HMAC SHA-256
        $signature = hash_hmac('sha256', "$header.$payload", $token_type, true);
        $signature = base64_encode($signature);

        // Menggabungkan header, payload, dan signature untuk membentuk token
        $token = "$header.$payload.$signature";

        return $token;
    }
}
