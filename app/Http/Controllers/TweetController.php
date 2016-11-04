<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TweetController extends Controller
{
    public function store(Request $request)
    {
        Log::info($request->all());
    }
}
