<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PolylinesModel;

class PolylinesController extends Controller
{
    protected $polylines;
    public function __construct()
    {
        $this->polylines = new PolylinesModel;
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
                'name' => 'required|unique:polyline,name',
                'description' => 'required',
                'geom_polyline' => 'required',
                'images' => 'nullable|mimes:jpeg,png,jpg|max:50'
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exists',
                'description.required' => 'Description is required',
                'geom_polyline.required' => 'Geometry Polyline is required'
            ]
        );

        // Check if directory exists, if not create it
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        // Check if file is uploaded
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_polyline." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
        } else {
            $name_image = null;
        }

        $data = [
            'geom' => $request->geom_polyline,
            'name' => $request->name,
            'description' => $request->description,
            'images' => $name_image,
            'photo' => $name_image
        ];

        // Create Data
        if (!$this->polylines->create($data)){
            return redirect()->route('map')->with('error', 'Polyline failed to add');
        }

        // Redirect to Map
        return redirect()->route('map')->with('success', 'Polyline has been added successfully');
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
        //
        //Hapus Point
        $polyline = $this->polylines->find($id);
        if (!$polyline || !$polyline->delete()) {
            return redirect()->route('map')->with('error', 'Polylines failed to delete');
        }
        return redirect()->route('map')->with('success', 'Polylines has been deleted successfully');
    }
}
