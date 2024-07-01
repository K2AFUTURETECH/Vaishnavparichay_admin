<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Members extends Model
{
    use HasFactory,HasApiTokens;

    protected $table = 'members';

    protected $fillable = [
        'family_id',
        'name',
        'birth_year',
        'education',
        'relation',
        'native',
        'current',
        'mobile',
        'occupation',
        'photo',
        'is_dead',
        'photo',
        'photo',
     ];
     public $timestamps = false;
}
