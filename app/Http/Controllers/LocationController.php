<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Districts;
use App\Models\Tehsils;
use App\Models\Cities;
use App\Models\Families;
use App\Models\Members;
use App\Models\Gotras;

class LocationController extends Controller
{
    public function index()
    {

        $states = State::all();

        return view('home', compact('states'));
    }

    public function district(Request $request, $stateid)
    {

        $dist = Districts::where('state_id', $stateid)->get();
        return response()->json(['dist' => $dist]);
    }

    public function tehsil(Request $request, $distid)
    {
        $tehsil = Tehsils::where('district_id', $distid)->get();
        return response()->json(['tehsil' => $tehsil]);
    }



    public function city(Request $request, $tehsilid)
    {
        $city = Cities::where('tehsil_id', $tehsilid)->get();
        return response()->json(['city' => $city]);
    }

    public function directory(Request $request)
    {
        $cityid = $request->cities;
        $cityName = Cities::where('id', $cityid)->pluck('name')->first();
        $directory = Families::join('gotras', 'families.gotra', '=', 'gotras.id')
            ->select('families.*', 'gotras.gotra as gotraname')
            ->where('families.state_id', $request->states)
            ->where('families.district_id', $request->district)
            ->where('families.tehsil_id', $request->tehsils)
            ->where('families.city_id', $request->cities)
            ->get();

        $count = Families::join('gotras', 'families.gotra', '=', 'gotras.id')
            ->select('families.*', 'gotras.gotra as gotraname')
            ->where('families.state_id', $request->states)
            ->where('families.district_id', $request->district)
            ->where('families.tehsil_id', $request->tehsils)
            ->where('families.city_id', $request->cities)
            ->count();

        return view('backend.directory.list', compact('directory', 'cityName', 'count'));
    }

    public function view(Request $request, $id)
    {

        $family = Families::select('families.*', 'tehsils.name as tehsil_name', 'states.name as state_name', 'districts.name as district_name', 'gotras.gotra as gotra_name')
            ->join('tehsils', 'families.tehsil_id', '=', 'tehsils.id')
            ->join('states', 'families.state_id', '=', 'states.id')
            ->join('districts', 'families.district_id', '=', 'districts.id')
            ->join('gotras', 'families.gotra', '=', 'gotras.id')
            ->where('families.id', $id)
            ->first();

        $members = Members::join('families', 'members.family_id', '=', 'families.id')
            ->join('gotras', 'families.gotra', '=', 'gotras.id')
            ->where('members.family_id', $id)
            ->select('members.*', 'gotras.gotra as gotra_name')
            ->get();
        return view('backend.directory.view', compact('members', 'family'));
    }

    public function aboutus()
    {

        return view('backend.directory.aboutus');
    }
}
