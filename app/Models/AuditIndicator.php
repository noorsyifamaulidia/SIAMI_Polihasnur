<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditIndicator extends Model
{
    use HasFactory;
    protected $fillable = ['link_referensi', 'audit_id', 'indicator_id'];

    public function audit()
    {
        return $this->belongsTo(Audit::class);
    }

    public function indicator()
    {
        return $this->belongsTo(Indicator::class);
    }

    public function units()
    {
        return $this->belongsToMany(Unit::class, 'audit_indicator_units');
    }

    public function scopeAuditeeIndicator($query, $unitId, $auditId)
    {
        $query->with('indicator')
                ->whereHas('units', function($query) use ($unitId) {
                    $query->where('units.id', $unitId);
                })
                ->where('audit_id', $auditId);
    }

    // relation with evaluasi rasionale
    public function evaluasiRasional()
    {
        return $this->hasOne(EvaluasiRasional::class, 'indicator_id', 'indicator_id');
    }

    // relation with evaluasi parameter
    public function evaluasiParameter()
    {
        return $this->hasMany(EvaluasiParameter::class, 'indicator_id', 'indicator_id');
    }

    // relation with evaluasi swot
    public function evaluasiSwot()
    {
        return $this->hasOne(EvaluasiSwot::class, 'indicator_id', 'indicator_id');
    }
}
