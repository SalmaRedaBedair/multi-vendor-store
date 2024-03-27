<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeviceTokenController extends Controller
{
    public function store(Request $request)
    {
        $user=Auth::guard('sanctum')->user();
        $exists=$user->deviceTokens()
            ->where('device_token');
    }
}
