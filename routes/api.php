<?php
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//get state,dist,tehsils,city

Route::get('/states', [ApiController::class, 'State']);
Route::get('/districts/{state_id}', [ApiController::class, 'getDistrictsByState']);
Route::get('/tehsils/{district_id}', [ApiController::class, 'getTehsilByDistrict']);
Route::get('/cities/{tehsil_id}', [ApiController::class, 'getCityByTehsil']);

// Family search
Route::get('/family/search', [ApiController::class, 'searchFamilies']);
Route::get('/family/{id}', [ApiController::class, 'viewFamily']);

