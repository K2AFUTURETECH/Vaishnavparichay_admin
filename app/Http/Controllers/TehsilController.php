<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Districts;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TehsilController extends Controller
{

    public function listing()
    {
        // Fetch districts with their associated state and tehsil using join queries
        $districts = DB::table('districts')
            ->join('states', 'districts.state_id', '=', 'states.id')
            ->leftJoin('tehsils', 'tehsils.district_id', '=', 'districts.id')
            ->orderBy('districts.id', 'desc') // Specify districts.id to resolve ambiguity
            ->select('districts.id', 'districts.name as district_name', 'states.name as state_name', 'tehsils.name as tehsil_name')
            ->get();

        // Pass the data to the view
        return view('tehsils.list', compact('districts'));
    }

    public function add()
    {

        // Fetch all Dustricts for dropdown selection
        $districts = Districts::all();
        return view('tehsils.add', compact('districts'));
    }

}
