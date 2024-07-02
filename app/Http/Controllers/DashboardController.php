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
use Illuminate\Support\Facades\validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function admin()
    {
        $totalFamilies = Families::count(); // Example query to count families
        $totalGotra = Gotras::count(); // Example query to count Gotras
        $totalMembers = Members::count(); // Example query to count members

        return view('admin.admindashboard', [
            'totalFamilies' => $totalFamilies,
            'totalGotra' => $totalGotra,
            'totalMembers' => $totalMembers,
        ]);
        // return view('admin.admindashboard');
    }



    public function state()
    {

        $states = State::orderBy('id', 'asc')->get();

        return view('state.list', compact('states'));
    }

    public function add()
    {


        return view('state.add');
    }

    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'short' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ];

        // Define custom validation messages
        $messages = [
            'name.required' => 'Please enter the State name.',

        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules, $messages);


        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Use a database transaction to ensure data integrity
        DB::beginTransaction();

        try {
            // Create a new state
            $state = new State();

            // Set the state attributes
            $state->name = ucwords($request->name);

            $state->short = $request->short;
            $state->status = $request->status;

            // Save the new state record
            $state->save();

            // Commit the transaction
            DB::commit();

            // Redirect to state list with success message
            return redirect()->route('state.list')->with('success', 'State created successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();
            dd($e->getMessage());

            // Redirect back with error message
            return redirect()->back()->with('error', 'Failed to create state. Please try again.');
        }
    }

    public function edit(State $state, $id)
    {

        $state = State::findOrFail($id);
        return view('state.edit', compact('state'));
    }

    public function update(Request $request, $id)
    {
        // Define validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'short' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ];

        // Define custom validation messages
        $messages = [
            'name.required' => 'Please enter the State name.',

        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules, $messages);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Use a database transaction to ensure data integrity
        DB::beginTransaction();

        try {
            // Find the existing client by ID
            $state = State::findOrFail($id);

            // Update the client attributes
            $state->name = ucwords($request->name);
            $state->short = $request->short;
            $state->status = $request->status;

            // Save the updated client record
            $state->save();

            // Commit the transaction
            DB::commit();

            // Redirect to client list with success message
            return redirect()->route('state.list')->with('success', 'State updated successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();

            // Redirect back with error message
            return redirect()->back()->with('error', 'Failed to update State. Please try again.');
        }
    }

    public function destroy($id)
    {

        $state = State::findOrFail($id);

        if ($state->status == 0) {
            $state->delete();
            // Redirect back with success message
            return redirect()->back()->with('success', 'State deleted successfully.');
        } else {
            // Handle differently for active states, for example, you can redirect back with a message
            return redirect()->back()->with('error', 'Active State cannot be deleted.');
        }
    }
}
