<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelaksana extends Model
{
    use HasFactory;
    protected $table = 'pelaksana';
    protected $fillable = ['name', 'description'];
    public $timestamps = false;
}
