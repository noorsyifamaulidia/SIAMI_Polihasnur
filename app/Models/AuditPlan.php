<?php

namespace App\Models;

use App\Traits\RelationWithSameModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditPlan extends Model
{
    use HasFactory, RelationWithSameModel;
    protected $guarded = ['id'];

    public function details()
    {
        return $this->hasMany(AuditPlanDetail::class, 'audit_plan_id');
    }
}
