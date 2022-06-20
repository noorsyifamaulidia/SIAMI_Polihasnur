<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditor extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'pelaksana_id', 'audit_id'];

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

    // belongs to many auditor unit
    public function units()
    {
        return $this->belongsToMany(Unit::class, 'auditor_unit', 'auditor_id', 'unit_id');
    }

    public function scopeIsKetuaAuditor($query, $audit_id)
    {
        return $query->where('audit_id', $audit_id)->whereRelation('pelaksana', 'name', 'Ka Auditor');
    }
}
