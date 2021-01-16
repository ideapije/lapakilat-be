<?php

namespace Tokokilat\ProductModule\Http\Controllers\API;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductApiController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(['data' => 'example products API']);
    }
}