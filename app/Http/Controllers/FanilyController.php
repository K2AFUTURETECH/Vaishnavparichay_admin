<?php

namespace App\Http\Controllers;

use App\Models\Gotras;
use App\Models\Families;
use App\Models\State;
use App\Models\Districts;
use App\Models\Tehsils;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Cities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class FanilyController extends Controller
{

    public function listing()
    {
        $families = DB::table('families')
            ->join('gotras', 'families.gotra', '=', 'gotras.id')
            ->select(
                'families.id',
                'families.name as family_name',
                'families.mobile as mobile',
                'families.created as created',

                'gotras.gotra as gotra_name' // Change 'name' to 'gotra'
            )
            ->orderBy('families.id', 'desc')
            ->get();

        return view('family.list', compact('families'));
    }

    public function add()
    {

        $states = State::all();
        $gotras = Gotras::all(); // Fetch all Gotras
        return view('family.add', compact('states', 'gotras'));
    }

    public function store(Request $request)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Validate the request data
            $request->validate([
                'name' => 'required|string|max:255',
                'gotra' => 'required|exists:gotras,id',
                'state_id' => 'required|exists:states,id',
                'district_id' => 'required|exists:districts,id',
                'tehsil_id' => 'required|exists:tehsils,id',
                'city_id' => 'required|exists:cities,id',
                'mobile' => 'required|numeric',
            ], [
                'name.required' => 'The family name is required.',
                'gotra.required' => 'The gotra selection is required.',
                'state_id.required' => 'The state selection is required.',
                'district_id.required' => 'The district selection is required.',
                'tehsil_id.required' => 'The tehsil selection is required.',
                'city_id.required' => 'The city selection is required.',
                'mobile.required' => 'The contact number is required.',
            ]);

            // Create a new Families instance
            $family = new Families;
            $family->name = $request->name;
            $family->gotra = $request->gotra;
            $family->state_id = $request->state_id;
            $family->district_id = $request->district_id;
            $family->tehsil_id = $request->tehsil_id;
            $family->city_id = $request->city_id;
            $family->mobile = $request->mobile;
            $family->modified = Carbon::now();
            $family->created = Carbon::now();

            // Handle file uploads
            if ($request->hasFile('fphoto')) {
                $fphoto_name = time() . '.' . $request->fphoto->getClientOriginalExtension();
                $request->fphoto->move(public_path('upload/family_photos'), $fphoto_name);
                $family->fphoto = $fphoto_name;
            }
            if ($request->hasFile('fphoto2')) {
                $fphoto2_name = time() . '2.' . $request->fphoto2->getClientOriginalExtension();
                $request->fphoto2->move(public_path('upload/family_photos'), $fphoto2_name);
                $family->fphoto2 = $fphoto2_name;
            }


            // Save the family data
            $family->save();

            // Commit the transaction
            DB::commit();

            // Redirect with success message
            return redirect()->route('family.list')->with('success', 'Family added successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();
            // Redirect back with an error message
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'There was a problem adding the family. Please try again later.']);
        }
    }
    public function edit($id)
    {
        // Find the family record by ID or fail
        $family = Families::findOrFail($id);
        $states = State::all();
        $gotras = Gotras::all(); // Fetch all Gotras

        // Fetch districts based on the selected state
        $districts = Districts::where('state_id', $family->state_id)->get();

        // Fetch tehsils based on the selected district
        $tehsils = Tehsils::where('district_id', $family->district_id)->get();

        // Fetch cities based on the selected tehsil
        $cities = Cities::where('tehsil_id', $family->tehsil_id)->get();

        // Return the view with the family and related data
        return view('family.edit', compact('family', 'states', 'gotras', 'districts', 'tehsils', 'cities'));
    }

    public function update(Request $request, $id)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'gotra' => 'required',
            'state_id' => 'required',
            'district_id' => 'required',
            'tehsil_id' => 'required',
            'city_id' => 'required',
            'mobile' => 'required|numeric',
            'fphoto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'fphoto2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Find the family record by ID or fail
        $family = Families::findOrFail($id);

        // Update family record with new data
        $family->name = $request->input('name');
        $family->gotra = $request->input('gotra');
        $family->state_id = $request->input('state_id');
        $family->district_id = $request->input('district_id');
        $family->tehsil_id = $request->input('tehsil_id');
        $family->city_id = $request->input('city_id');
        $family->mobile = $request->input('mobile');

        // Handle family photo 1 upload
        if ($request->hasFile('fphoto')) {
            // Delete old photo if exists
            if ($family->fphoto) {
                $oldFilePath = public_path('upload/family_photos/' . $family->fphoto);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
            }

            // Upload new photo
            $image = $request->file('fphoto');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('upload/family_photos'), $fileName);
            $family->fphoto = $fileName;
        }

        // Handle family photo 2 upload
        if ($request->hasFile('fphoto2')) {
            // Delete old photo if exists
            if ($family->fphoto2) {
                $oldFilePath = public_path('upload/family_photos/' . $family->fphoto2);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
            }

            // Upload new photo
            $image2 = $request->file('fphoto2');
            $fileName2 = time() . '_' . $image2->getClientOriginalName();
            $image2->move(public_path('upload/family_photos'), $fileName2);
            $family->fphoto2 = $fileName2;
        }

        // Save updated family record
        $family->save();

        // Redirect to family list with success message
        return redirect()->route('family.list')
            ->with('success', 'Family updated successfully!');
    }

    public function destroy($id)
    {
        // Find the family record by ID or fail
        $family = Families::findOrFail($id);

        // Delete family photos from public folder if they exist
        if ($family->fphoto) {
            $filePath1 = public_path('upload/family_photos/' . $family->fphoto);
            if (File::exists($filePath1)) {
                File::delete($filePath1);
            }
        }

        if ($family->fphoto2) {
            $filePath2 = public_path('upload/family_photos/' . $family->fphoto2);
            if (File::exists($filePath2)) {
                File::delete($filePath2);
            }
        }

        // Delete the family record from database
        $family->delete();

        // Redirect to family list with success message
        return redirect()->route('family.list')
            ->with('success', 'Family deleted successfully!');
    }
}
