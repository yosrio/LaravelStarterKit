<?php

namespace App\Http\Controllers\Admin\Webhook\Shopify;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductCreate extends Controller
{
    public function handle(Request $request)
    {
        return response()->json('ok');
    }
}
