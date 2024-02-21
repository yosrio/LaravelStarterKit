<?php

/**
 * ConfigurationController
 *
 * PHP version 8.1
 *
 * @package  App\Http\Controllers\Admin\Api\Rest
 * @category Rest Api Controllers
 * @author   Yos Rio
 * @license  http://opensource.org/licenses/MIT MIT License
 */

namespace App\Http\Controllers\Admin\Api\Rest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Configuration;
use Illuminate\Support\Facades\Log;

/**
 * ConfigurationController
 *
 * This controller handles api configuration.
 */
class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $name = $request->input('name');
        $group = $request->input('group');
        try {
            $configurations = Configuration::select('id', 'group', 'name', 'type', 'value');
            if ($name) {
                $configurations->where('name', $name);
                if ($group) {
                    $configurations->where('group', $group);
                }
            } elseif ($group) {
                $configurations->where('group', $group);
            }
            if ($configurations->get()->isEmpty()) {
                return response()->json(
                    [
                        'error' => [
                            'message' => 'Data not found.'
                        ]
                    ],
                    404
                );
            }
            return response()->json($configurations->get(), 200);
        } catch (\Exception $e) {
            Log::channel('api_exceptions')->error($e);
            return response()->json(
                [
                    'error' => [
                        'message' => 'Internal server error. Something went wrong on the server.'
                    ]
                ],
                500
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return void
     */
    public function show($id)
    {
        try {
            $configurations = Configuration::select('id', 'group', 'name', 'type', 'value')
                                ->where('id', $id)->get();
            if ($configurations->isEmpty()) {
                return response()->json(
                    [
                        'error' => [
                            'message' => 'Data not found.'
                        ]
                    ],
                    404
                );
            }
            return response()->json($configurations, 200);
        } catch (\Exception $e) {
            Log::channel('api_exceptions')->error($e);
            return response()->json(
                [
                    'error' => [
                        'message' => 'Internal server error. Something went wrong on the server.'
                    ]
                ],
                500
            );
        }
    }
}
