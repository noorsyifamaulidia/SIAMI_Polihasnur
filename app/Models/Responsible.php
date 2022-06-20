<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsible extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pelaksana()
    {
        return $this->belongsTo(Pelaksana::class);
    }

    public function audit()
    {
        return $this->belongsTo(Audit::class);
    }

    public function units()
    {
        return $this->belongsToMany(Unit::class, 'responsible_unit', 'responsible_id', 'unit_id');
    }
}
