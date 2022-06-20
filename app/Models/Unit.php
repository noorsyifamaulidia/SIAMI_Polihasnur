<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];
    public $timestamps = false;

    // scope filter
    public function scopeFilter($query, $params)
    {
        $query->where(function($query) use ($params) {
            if (isset($params['q'])) {
                $query->where('name', 'like', '%' . $params['q'] . '%');
            }

            // if (isset($params['q'])) {
            //     $query->orWhere('description', 'like', '%' . $params['q'] . '%');
            // }
        });
    }

    // auditee
    public function auditees()
    {
        return $this->hasOne(Auditee::class);
    }

    // indicators
    public function indicators()
    {
        return $this->hasMany(AuditIndicatorUnit::class);
    }

    // scope evaluasi for auditor
    public function scopeIndicatorForAuditor($query, $id)
    {
        $query->with('indicators.auditIndicator.indicator')
        ->whereHas('indicators.auditIndicator', function($query) use ($id) {
            $query->where('audit_id', $id);
        });
    }

    // scope get auditee
    public function scopeGetAuditee($query, $id)
    {
        $query->with('auditees.user')
        ->whereHas('auditees', function($query) use ($id) {
            $query->where('id', $id);
        });
    }

    public function scopeGetEvaluasiValue($query, $id)
    {
        // with evaluasi rasional
        $query->with('indicators.auditIndicator.evaluasiRasional')
        ->whereHas('indicators.auditIndicator.evaluasiRasional.auditee', function($query) use ($id) {
            $query->where('audit_id', $id)->whereColumn('unit_id', 'units.id');
        });

        // with evaluasi parameter
        $query->with('indicators.auditIndicator.evaluasiParameter')
        ->whereHas('indicators.auditIndicator.evaluasiParameter.auditee', function($query) use ($id) {
            $query->where('audit_id', $id)->whereColumn('unit_id', 'units.id');
        });

        // with evaluasi swot
        $query->with('indicators.auditIndicator.evaluasiSwot')
        ->whereHas('indicators.auditIndicator.evaluasiSwot.auditee', function($query) use ($id) {
            $query->where('audit_id', $id)->whereColumn('unit_id', 'units.id');
        });
    }
}
