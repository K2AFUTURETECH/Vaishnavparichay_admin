<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Districts;
use App\Models\Tehsils;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TehsilController extends Controller
{

    public function listing()
    {
        // Fetch tehsils and order by latest first
        $tehsils = DB::table('tehsils')
            ->join('districts', 'tehsils.district_id', '=', 'districts.id')
            ->select('tehsils.id', 'tehsils.name as tehsil_name', 'districts.name as district_name', 'districts.id as district_id')
            ->orderBy('tehsils.id', 'desc') // Order by tehsils.id in descending order
            ->get();

        // Pass the data to the view
        return view('tehsils.list', compact('tehsils'));
    }

    public function add()
    {

        // Fetch all Dustricts for dropdown selection
        $districts = Districts::all();
        return view('tehsils.add', compact('districts'));
    }

    public function store(Request $request, Tehsils $tehsils)
    {

        $validator = Validator::make(request()->all(), [
            'name' => 'required|max:50|unique:districts',
            'district_id' => 'required',
        ], [
            'district_id.required' => 'Please select District.',
        ]);
        if ($validator->fails()) {
            return redirect()->route('dist.add')
                ->withErrors($validator)
                ->withInput();
        } else {
            $tehsils->name = strtoupper($request->name);
            $tehsils->district_id = $request->district_id;
            $tehsils->save();
            return redirect()->route('tehsil.list')->with('success', 'Tehsils has been created successfully.');
        }
    }
    public function edit(Tehsils $tehsils, $id)
    {

        $data = Tehsils::find($id);
        $districts = Districts::all();
        return view('tehsils.edit', compact('data', 'districts'));
    }

    public function update(Request $request, $id)
    {
        // Fetch the tehsil that needs to be updated
        $tehsil = Tehsils::findOrFail($id);

        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50|unique:tehsils,name,' . $tehsil->id, // Allow same name for the current tehsil
            'district_id' => 'required|exists:districts,id',
        ], [
            'district_id.required' => 'Please select District.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('tehsil.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        // Update the tehsil with the validated data
        $tehsil->name = strtoupper($request->input('name'));
        $tehsil->district_id = $request->input('district_id');
        $tehsil->save();

        // Redirect to the tehsil listing with success message
        return redirect()->route('tehsil.list')->with('success', 'Tehsil has been updated successfully.');
    }
    public function destroy($id)
    {
        // Find the tehsil by its ID
        $tehsil = Tehsils::findOrFail($id);

        // Delete the tehsil
        $tehsil->delete();

        // Redirect to the tehsil listing with a success message
        return redirect()->route('tehsil.list')->with('success', 'Tehsil has been deleted successfully.');
    }
}
