<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class State extends Model
{
    use HasFactory,HasApiTokens;
    protected $table = 'states';

    protected $fillable = ['name','short', 'status'];
    public $timestamps = false;
}
