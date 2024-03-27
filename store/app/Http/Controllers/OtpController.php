<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OtpController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'mobile'=>['required']
        ]);
    }
}
