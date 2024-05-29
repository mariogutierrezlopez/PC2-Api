<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return response()->json(['message' => 'Admin Dashboard']);
    }

    public function create(Request $request)
    {
        return response()->json(['message' => 'Resource created']);
    }
}
