<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditee extends Model
{
    use HasFactory;
    protected $fillable = ['unit_id', 'user_id', 'audit_id'];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // function scope for get auditee by unit_id and audit_id
    public function scopeGetAuditee($query, $audit_id, $unit_id)
    {
        return $query->where('audit_id', $audit_id)
            ->where('unit_id', $unit_id);
    }
}
