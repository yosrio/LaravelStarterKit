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

/**
 * ConfigurationController
 *
 * This controller handles api configuration.
 */
class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $configurations = $this->grouppedConfig(Configuration::get());
        return response()->json($configurations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $configurations = $this->grouppedConfig(Configuration::where('id', $id)->get());
        return response()->json($configurations);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
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
