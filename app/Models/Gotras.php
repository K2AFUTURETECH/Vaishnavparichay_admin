<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Gotras extends Model
{
    use HasFactory,HasApiTokens;
    // protected $table = 'families';
    protected $table = 'gotras';

    protected $fillable = [
        'id',
        'gotra',
        'dawara',

     ];
     public $timestamps = false;
}
