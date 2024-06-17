<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Cities extends Model
{
    use HasFactory,HasApiTokens;
    protected $table = 'cities';

    protected $fillable = [
        'tehsil_id',
        'name',
        'id'
    ];
    public $timestamps = false;
    protected $primarykey = 'id';
}
