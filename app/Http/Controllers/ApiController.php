<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Families;
use App\Models\Members;
use App\Models\State;
use App\Models\Districts;
use App\Models\Tehsils;
use App\Models\Cities;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function State(Request $request)
    {
        // Retrieve all states and order by 'id'
        $States = State::orderBy('id', 'desc')
            ->get()
            ->map(function ($State) {
                $status = $State->status == 1 ? 'Active' : 'Inactive';
                $State->status = $status;
                return $State;  // Ensure the state is returned
            });

        // Check if states are found
        if ($States->isEmpty()) {
            return response()->json(['status' => false, 'message' => 'No States Found'], 404);
        }

        // Return the states with a success response
        return response()->json(['status' => true, 'States' => $States], 200);
    }


    public function getDistrictsByState($state_id)
    {
        // Fetch districts where the state_id matches the provided state_id
        $districts = Districts::where('state_id', $state_id)->get();

        // Check if any districts were found
        if ($districts->isEmpty()) {
            return response()->json(['status' => false, 'message' => 'No Districts Found'], 404);
        }

        // Return the found districts
        return response()->json(['status' => true, 'districts' => $districts], 200);
    }

    public function getTehsilByDistrict($district_id)
    {
        // Fetch tehsils where the district_id matches the provided district_id
        $tehsils = Tehsils::where('district_id', $district_id)->get();

        // Check if any tehsils were found
        if ($tehsils->isEmpty()) {
            return response()->json(['status' => false, 'message' => 'No Tehsils Found'], 404);
        }

        // Return the found tehsils
        return response()->json(['status' => true, 'tehsils' => $tehsils], 200);
    }

    public function getCityByTehsil($tehsil_id)
    {
        // Fetch cities where the tehsil_id matches the provided tehsil_id
        $cities = Cities::where('tehsil_id', $tehsil_id)->get();

        // Check if any cities were found
        if ($cities->isEmpty()) {
            return response()->json(['status' => false, 'message' => 'No Cities Found'], 404);
        }

        // Return the found cities
        return response()->json(['status' => true, 'cities' => $cities], 200);
    }

    public function searchFamilies(Request $request)
    {


        // Validate the request parameters
        $request->validate([
            'state_id' => 'required|integer',
            'district_id' => 'required|integer',
            'tehsil_id' => 'required|integer',
            'city_id' => 'required|integer',
        ]);

        // Retrieve the city name for the given city ID
        $cityid = $request->city_id;
        $cityName = Cities::where('id', $cityid)->pluck('name')->first();

        // Debugging: Check if city name is fetched
        if (is_null($cityName)) {
            return response()->json([
                'error' => 'City not found for the given city_id'
            ], 404);
        }

        // Query the families based on the provided parameters
        $families = Families::join('gotras', 'families.gotra', '=', 'gotras.id')
            ->select('families.*', 'gotras.gotra as gotra_name')
            ->where('families.state_id', $request->state_id)
            ->where('families.district_id', $request->district_id)
            ->where('families.tehsil_id', $request->tehsil_id)
            ->where('families.city_id', $request->city_id)
            ->get();

        // Debugging: Check if families are fetched
        if ($families->isEmpty()) {
            return response()->json([
                'city_name' => $cityName,
                'families' => [],
                'message' => 'No families found for the given criteria'
            ], 404);
        }

        // Return the results as JSON
        return response()->json([
            'city_name' => $cityName,
            'families' => $families,
        ]);
    }

    //view family
    public function viewFamily(Request $request, $id)
    {

        // Fetch family details along with related information
        $family = Families::select('families.*', 'tehsils.name as tehsil_name', 'states.name as state_name', 'districts.name as district_name', 'gotras.gotra as gotra_name')
            ->join('tehsils', 'families.tehsil_id', '=', 'tehsils.id')
            ->join('states', 'families.state_id', '=', 'states.id')
            ->join('districts', 'families.district_id', '=', 'districts.id')
            ->join('gotras', 'families.gotra', '=', 'gotras.id')
            ->where('families.id', $id)
            ->first();

        // Check if the family exists
        if (!$family) {
            return response()->json(['status' => false, 'message' => 'Family not found'], 404);
        }

        // Fetch members of the family
        $members = Members::join('families', 'members.family_id', '=', 'families.id')
            ->join('gotras', 'families.gotra', '=', 'gotras.id')
            ->where('members.family_id', $id)
            ->select('members.*', 'gotras.gotra as gotra_name')
            ->get();

        // Return the data as JSON
        return response()->json([
            'status' => true,
            'family' => $family,
            'members' => $members
        ], 200);
    }
}
