<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PointsModel;
use Illuminate\Http\Request;

class PointsApiController extends Controller
{
    public function index()
    {
        return response()->json(PointsModel::all());
    }
}
