<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
class Districts extends Model
{
    use HasFactory,HasApiTokens;
    protected $table = 'districts';

    protected $fillable = [
        'state_id',
        'name',

     ];
     public $timestamps = false;
     protected $primarykey = 'id';
}
