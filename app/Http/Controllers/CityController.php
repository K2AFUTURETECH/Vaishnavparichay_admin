<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Districts;
use App\Models\Tehsils;
use App\Models\Cities;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\validator;
use Illuminate\Support\Facades\Auth;

class CityController extends Controller
{
    public function listing()
    {
        // Fetch cities and their corresponding tehsils, ordered by city ID descending
        $cities = DB::table('cities')
            ->join('tehsils', 'cities.tehsil_id', '=', 'tehsils.id')
            ->select(
                'cities.id',
                'cities.name as city_name',
                'tehsils.name as tehsil_name',
                'tehsils.id as tehsil_id'
            )
            ->orderBy('cities.id', 'desc')
            ->get();



        // Pass the data to the view
        return view('city.list', compact('cities'));
    }


    public function add()
    {

        // Fetch all Dustricts for dropdown selection
        $tehsils = Tehsils::all();
        return view('city.add', compact('tehsils'));
    }

    public function store(Request $request, Cities $cities)
    {

        $validator = Validator::make(request()->all(), [
            'name' => 'required|max:50|unique:districts',
            'tehsil_id' => 'required',
        ], [
            'tehsil_id.required' => 'Please select District.',
        ]);
        if ($validator->fails()) {
            return redirect()->route('dist.add')
                ->withErrors($validator)
                ->withInput();
        } else {
            $cities->name = strtoupper($request->name);
            $cities->tehsil_id = $request->tehsil_id;
            $cities->save();
            return redirect()->route('city.list')->with('success', 'City has been created successfully.');
        }
    }
    public function edit($id)
    {
        // Find the city by its ID
        $city = Cities::findOrFail($id);

        // Fetch all tehsils
        $tehsils = Tehsils::all();

        // Pass the city and tehsils data to the view
        return view('city.edit', compact('city', 'tehsils'));
    }

    public function update(Request $request, $id)
    {

        // Validate input if necessary
        $request->validate([
            'name' => 'required|string|max:255',
            'tehsil_id' => 'required|exists:tehsils,id',
            // Add more validation rules as needed
        ]);

        // Find the city by its ID
        $city = Cities::findOrFail($id);

        // Update city attributes
        $city->name = $request->name;
        $city->tehsil_id = $request->tehsil_id;
        // Add more fields as necessary

        // Save the updated city
        $city->save();

        // Redirect back with success message
        return redirect()->route('city.list')->with('success', 'City/Village updated successfully.');
    }


    public function destroy($id)
    {

        // Find the city by its ID
        $city = Cities::findOrFail($id);


        // Delete the city
        $city->delete();

        // Redirect to the city listing with a success message
        return redirect()->route('city.list')->with('success', 'City has been deleted successfully.');
    }
}
