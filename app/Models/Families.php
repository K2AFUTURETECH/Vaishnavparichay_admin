<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Families extends Model
{
    use HasFactory,HasApiTokens;
    protected $table = 'families';

    protected $fillable = [
        'name',
        'gotra',
        'city_id',
        'district_id',
        'state_id',
        'tehsil_id',
        'mobile',
        'fphoto',
        'fphoto2',
        'modified',
     ];
}
