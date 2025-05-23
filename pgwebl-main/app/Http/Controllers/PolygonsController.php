<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PolygonsModel;

class PolygonsController extends Controller
{
    protected $polygons;

    public function __construct()
    {
        $this->polygons = new PolygonsModel;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // Validate Request
        $request->validate(
            [
                'name' => 'required|unique:polygon,name',
                'description' => 'required',
                'geom_polygon' => 'required',
                'images' => 'nullable|mimes:jpeg,png,jpg|max:50'
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exists',
                'description.required' => 'Description is required',
                'geom_polygon.required' => 'Geometry Polygon is required'
            ]
        );

        // Check if directory exists, if not create it
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        // Check if file is uploaded
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_polygon." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
        } else {
            $name_image = null;
        }

        $data = [
            'geom' => $request->geom_polygon,
            'name' => $request->name,
            'description' => $request->description,
            'images' => $name_image,
            'photo' => $name_image
        ];

        // Create Data
        if (!$this->polygons->create($data)){
            return redirect()->route('map')->with('error', 'Polygon failed to add');
        }

        // Redirect to Map
        return redirect()->route('map')->with('success', 'Polygon has been added successfully');

    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        // Hapus Polygon
        $polygon = $this->polygons->find($id);
        if (!$polygon || !$polygon->delete()) {
            return redirect()->route('map')->with('error', 'Polygons failed to delete');
        }
        return redirect()->route('map')->with('success', 'Polygons has been deleted successfully');
    }
}
