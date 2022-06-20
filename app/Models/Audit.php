<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    // scope is active
    public function scopeIsActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function auditee()
    {
        return $this->hasMany(Auditee::class);
    }

    public function auditor()
    {
        return $this->hasMany(Auditor::class);
    }

    public function responsible()
    {
        return $this->hasMany(Responsible::class);
    }

    // indicators
    public function indicators()
    {
        return $this->hasMany(AuditIndicator::class);
    }

    // get units through auditee
    public function units()
    {
        return $this->hasManyThrough(Unit::class, Auditee::class, 'audit_id', 'id', 'id', 'unit_id');
    }

    // audtor where pelaksana tim auditor
    public function auditorAnggota()
    {
        return $this->hasMany(Auditor::class, 'audit_id')->whereHas('pelaksana', function ($query) {
            $query->where('name', 'Tim Auditor');
        });
    }
}
