<?php

namespace App\Http\Controllers;

use App\Models\PointsModel;
use Illuminate\Http\Request;

class PointsController extends Controller
{
    protected $points;
    public function __construct()
    {
        $this->points = new PointsModel;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Map'
        ];

        return view('map', $data);
    }

    public function create() {}

    public function store(Request $request)
    {

        // Validate Request
        $request->validate(
            [
                'name' => 'required|unique:points,name',
                'description' => 'required',
                'geom_point' => 'required',
                'images' => 'nullable|mimes:jpeg,png,jpg|max:50'
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exists',
                'description.required' => 'Description is required',
                'geom_point.required' => 'Geometry Point is required'
            ]
        );

        // Check if directory exists, if not create it
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        // Check if file is uploaded
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_point." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
        } else {
            $name_image = null;
        }

        $data = [
            'geom' => $request->geom_point,
            'name' => $request->name,
            'description' => $request->description,
            'images' => $name_image,
            'photo' => $name_image

        ];

        // Create Data
        if (!$this->points->create($data)) {
            return redirect()->route('map')->with('error', 'Point failed to add');
        }

        // Redirect to Map
        return redirect()->route('map')->with('success', 'Point has been added successfully');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, $id)
    {
       //
    }


    public function destroy(string $id)
    {
        //Hapus Point
        $point = $this->points->find($id);
        if (!$point || !$point->delete()) {
            return redirect()->route('map')->with('error', 'Point failed to delete');
        }
        return redirect()->route('map')->with('success', 'Point has been deleted successfully');
    }

    public function getPoints()
{
    $points = $this->points->all();

    return response()->json($points);
}

}
