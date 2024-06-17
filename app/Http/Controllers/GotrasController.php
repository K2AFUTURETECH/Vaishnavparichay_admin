<?php

namespace App\Http\Controllers;

use App\Models\Gotras;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\validator;

class GotrasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function listing()
    {
        // Fetch all gotras ordered by created_at in descending order
        $gotras = Gotras::orderBy('created', 'desc')->get();

        // Pass the sorted gotras to the view
        return view('gotra.list', compact('gotras'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function add()
    {
        return view('gotra.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gotra' => 'required|max:255',
            'dawara' => 'required|max:255',
        ], [
            'gotra.required' => 'Please enter Gotra Name.',
            'dawara.required' => 'Please enter Dawara Name.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $gotra = new Gotras();
            $gotra->gotra = strtoupper($request->gotra);
            $gotra->dawara = $request->dawara;
            $gotra->save();

            return redirect()->route('gotra.list')->with('success', 'Gotra has been created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Gotras $gotras)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Find the Gotras entry by ID or fail
        $gotra = Gotras::findOrFail($id);

        // Pass the gotra instance to the view
        return view('gotra.edit', compact('gotra'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'gotra' => 'required|string|max:255',
            'dawara' => 'required|string|max:255',
        ]);

        // Find the Gotras entry by ID or fail
        $gotra = Gotras::findOrFail($id);

        // Update the gotra instance
        $gotra->gotra = $request->input('gotra');
        $gotra->dawara = $request->input('dawara');
        $gotra->save();

        // Redirect with success message
        return redirect()->route('gotra.list')->with('success', 'Gotra updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the Gotras entry by ID or fail
        $gotra = Gotras::findOrFail($id);

        // Delete the gotra instance
        $gotra->delete();

        // Redirect with success message
        return redirect()->route('gotra.list')->with('success', 'Gotra deleted successfully.');
    }
}
