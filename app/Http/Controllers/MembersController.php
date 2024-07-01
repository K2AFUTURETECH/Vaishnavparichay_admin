<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Families;
use App\Models\Members;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MembersController extends Controller
{
    public function listing($id)
    {
        // // return view('member.list');
        // $family = Families::findOrFail($id); // Assuming you fetch the family information
        // $members = Members::where('family_id', $id)->get(); // Fetch members associated with this family

        // return view('member.add', compact('family', 'members'));
    }
    public function add(Request $request)
    {
        // dd($request->all());
        $family = Members::where('family_id', $request->id)->get();
        return view('member.add', compact('family'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Validate incoming data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'birth_year' => 'required|integer',
                'education' => 'required|string|max:255',
                'relation' => 'required|string',
                'native' => 'required|string|max:255',
                'current' => 'required|string|max:255',
                'mobile' => 'required|string|max:15',
                'occupation' => 'required|string',
                'marital_status' => 'required|string',
                'is_dead' => 'required|string',
                // 'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation for photo upload
            ]);

            // Create a new member instance
            $member = new Members();
            $member->name = $validatedData['name'];
            $member->birth_year = $validatedData['birth_year'];
            $member->education = $validatedData['education'];
            $member->relation = $validatedData['relation'];
            $member->native = $validatedData['native'];
            $member->current = $validatedData['current'];
            $member->mobile = $validatedData['mobile'];
            $member->occupation = $validatedData['occupation'];
            $member->marital_status = $validatedData['marital_status'];
            $member->is_dead = $validatedData['is_dead'];
            $member->modified = Carbon::now();
            $member->created = Carbon::now();

            // Handle photo upload if provided
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload/members'), $imageName);
                $member->photo = 'upload/members/' . $imageName;
            }

            // Set the family_id from the URL parameter 'id'
            $member->family_id = $request->family_id;

            // Save the member
            $member->save();

            // Commit the transaction
            DB::commit();

            // Redirect back with success message
            return redirect()->back()->with('success', 'Member added successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();
            // Log the error for debugging

            // Redirect back with an error message
            return redirect()->back()->withErrors(['error' => 'There was a problem adding the member. Please try again later.']);
        }
    }

    public function edit($memberId)
    {
        $member = Members::findOrFail($memberId); // Fetch the member details
        $family = Families::findOrFail($member->family_id); // Fetch the associated family details

        return view('member.edit', compact('member', 'family'));
    }

    public function update(Request $request, $memberId)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Validate incoming data with custom messages
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'birth_year' => 'required|integer',
                'education' => 'required|string|max:255',
                'relation' => 'required|string',
                'native' => 'required|string|max:255',
                'current' => 'required|string|max:255',
                'mobile' => 'required|string|max:15',
                'occupation' => 'required|string',
                'marital_status' => 'required|string',
                'is_dead' => 'required|string',
                'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'name.required' => 'The name field is required.',
                'name.string' => 'The name must be a string.',
                'birth_year.required' => 'The birth year field is required.',
                'education.required' => 'The education field is required.',
                'relation.required' => 'The relation field is required.',
                'native.required' => 'The native address field is required.',
                'current.required' => 'The current address field is required.',
                'mobile.required' => 'The mobile number field is required.',
                'mobile.max' => 'The mobile number may not be greater than 10 number.',
                'occupation.required' => 'The occupation field is required.',
                'marital_status.required' => 'The marital status field is required.',
                'is_dead.required' => 'The is dead field is required.',
                'photo.image' => 'The file must be an image (jpeg, png, jpg, gif).',

            ]);

            // Find the member to update
            $member = Members::findOrFail($memberId);

            // Update member details
            $member->name = $validatedData['name'];
            $member->birth_year = $validatedData['birth_year'];
            $member->education = $validatedData['education'];
            $member->relation = $validatedData['relation'];
            $member->native = $validatedData['native'];
            $member->current = $validatedData['current'];
            $member->mobile = $validatedData['mobile'];
            $member->occupation = $validatedData['occupation'];
            $member->marital_status = $validatedData['marital_status'];
            $member->is_dead = $validatedData['is_dead'];
            $member->modified = Carbon::now();

            // Handle photo update if provided
            if ($request->hasFile('photo')) {
                // Delete old photo if it exists
                if ($member->photo && file_exists(public_path($member->photo))) {
                    unlink(public_path($member->photo));
                }

                // Store new photo
                $image = $request->file('photo');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload/members'), $imageName);
                $member->photo = 'upload/members/' . $imageName;
            }

            // Save the updated member details
            $member->save();

            // Commit the transaction
            DB::commit();

            // Redirect back with success message
            return redirect()->route('member.add', ['id' => $member->family_id])->with('success', 'Member updated successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();
            // Log the error for debugging

            // Redirect back with an error message
            return redirect()->back()->withErrors(['error' => 'There was a problem updating the member. Please try again later.']);
        }
    }


    public function destroy($id)
    {
        // Find the member by ID
        $member = Members::findOrFail($id);

        // Delete the member
        $member->delete();

        // Optionally, redirect back with a success message
        return redirect()->back()->with('success', 'Member deleted successfully.');
    }
}
