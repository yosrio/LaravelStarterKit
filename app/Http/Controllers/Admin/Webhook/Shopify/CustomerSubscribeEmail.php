<?php

namespace App\Http\Controllers\Admin\Webhook\Shopify;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomerSubscribeEmail extends Controller
{
    public function handle(Request $request)
    {
        Log::channel('exceptions')->info(json_encode($request->all()));
        return response()->json('ok');
    }
}
