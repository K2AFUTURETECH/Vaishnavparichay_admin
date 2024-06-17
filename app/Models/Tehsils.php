<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Tehsils extends Model
{
    use HasFactory,HasApiTokens;
    protected $table = 'tehsils';

    protected $fillable = [
        'district_id',
        'name',
     ];
     public $timestamps = false;
}
