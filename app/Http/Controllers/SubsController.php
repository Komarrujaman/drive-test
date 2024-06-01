<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubsController extends Controller
{
    public function index(Request $request)
    {
        // Log the request body
        Log::debug(json_encode($request->post()));

        // Respond with acknowledgement
        return response()->json(['message' => 'ack']);
    }
}
