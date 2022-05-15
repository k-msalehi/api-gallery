<?php

namespace App\Http\Controllers\Survey;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Order extends Controller
{
    public function insert(Request $request)
    {
        return response()->json($request->all());
    }
}
