<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditIndicatorUnit extends Model
{
    use HasFactory;
    protected $fillable = ['audit_indicator_id', 'unit_id'];

    public function auditIndicator()
    {
        return $this->belongsTo(AuditIndicator::class);
    }

    public function scopeForAuditorInput($query, $audit_id, $model, $ruangLingkupUnitIds)
    {
        $query->select('*')
            ->with(['auditIndicator.indicator', 'unit'])
            ->joinWithAuditIndicator()
            ->statusInputCount($model)
            ->whereRelation('auditIndicator', 'audit_id', $audit_id)
            ->whereIn('unit_id', $ruangLingkupUnitIds)
            ->orderBy('unit_id')
            ->latest('status_input');
    }

    public function scopeJoinWithAuditIndicator($query)
    {
        $query->join('audit_indicators', 'audit_indicators.id', '=', 'audit_indicator_id');
    }

    public function scopeStatusInputCount($query, $model)
    {   
        if ($model == 'Temuan') {
            $model = Temuan::selectRaw('count(*)');
        } else if($model == 'AuditPlan') {
            $model = AuditPlan::selectRaw('count(*)');
        } else if($model == 'AuditWorkStep') {
            $model = AuditWorkStep::selectRaw('count(*)');
        } else if($model == 'Ringkasan') {
            $model = Ringkasan::selectRaw('count(*)');
        } else {
            $model = AuditNote::selectRaw('count(*)');
        }

        $query->addSelect(['status_input' => $model
            ->whereColumn('audit_id', 'audit_indicators.audit_id')
            ->whereColumn('indicator_id', 'audit_indicators.indicator_id')
            ->whereHas('auditee', function ($query) {
                $query->whereColumn('audit_id', 'audit_indicators.audit_id')
                    ->whereColumn('unit_id', 'audit_indicator_units.unit_id');
            })
            ->limit(1)
        ]);
    }

    // relation with unit
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
