<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PointsModel;
use App\Models\PolylinesModel;
use App\Models\PolygonsModel;

class ApiController extends Controller
{
    protected $points;
    protected $polylines;
    protected $polygons;
    public function __construct()
    {
        $this->points = new PointsModel();
        $this->polylines = new PolylinesModel();
        $this->polygons = new PolygonsModel();
    }

    public function points()
    {
        $points = $this->points->geojson_points();

        return response()->json($points);
    }

    public function polylines()
    {
        $polylines = $this->polylines->geojson_polylines();

        return response()->json($polylines, 200, [], JSON_NUMERIC_CHECK);
    }

    public function polygons()
    {
        $polygons = $this->polygons->geojson_polygons();

        return response()->json($polygons, 200, [], JSON_NUMERIC_CHECK);
    }
}
