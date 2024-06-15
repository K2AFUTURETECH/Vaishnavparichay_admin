<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Districts;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DistrictController extends Controller
{

    public function listing()
    {
        // Fetch districts with their associated state using a join query
        $districts = DB::table('districts')
            ->join('states', 'districts.state_id', '=', 'states.id')
            ->orderBy('districts.id', 'desc') // Specify districts.id or states.id to resolve ambiguity
            ->select('districts.id', 'districts.name as district_name', 'states.name as state_name')
            ->get();

        // Pass the data to the view
        return view('dist.list', compact('districts'));
    }
    public function add()
    {
        // Fetch all states for dropdown selection
        $states = State::all();
        return view('dist.add', compact('states'));
    }

    public function store(Request $request, Districts $districts)
    {

        $validator = Validator::make(request()->all(), [
            'name' => 'required|max:50|unique:districts',
            'state_id' => 'required',
        ], [
            'state_id.required' => 'Please select state.',
        ]);
        if ($validator->fails()) {
            return redirect()->route('dist.add')
                ->withErrors($validator)
                ->withInput();
        } else {
            $districts->name = strtoupper($request->name);
            $districts->state_id = $request->state_id;
            $districts->save();
            return redirect()->route('dist.list')->with('success', 'District has been created successfully.');
        }
    }

    public function edit(Districts $districts, $id)
    {

        $data = Districts::find($id);

        $states = State::all();
        return view('dist.edit', compact('data', 'states'));
    }

    public function update(Request $request, $id)
    {
        // Fetch the district that needs to be updated
        $district = Districts::findOrFail($id);

        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50|unique:districts,name,' . $district->id,
            'state_id' => 'required|exists:states,id',
        ], [
            'state_id.required' => 'Please select state.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('dist.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        // Update the district with the validated data
        $district->name = strtoupper($request->input('name'));
        $district->state_id = $request->input('state_id');
        $district->save();

        // Redirect to the district listing with success message
        return redirect()->route('dist.list')->with('success', 'District has been updated successfully.');
    }
    public function destroy($id)
    {
        // Fetch the district that needs to be deleted
        $district = Districts::findOrFail($id);

        // Delete the district
        $district->delete();

        // Redirect to the district listing with success message
        return redirect()->route('dist.list')->with('success', 'District has been deleted successfully.');
    }
}
