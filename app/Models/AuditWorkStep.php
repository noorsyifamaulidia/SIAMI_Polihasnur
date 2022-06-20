<?php

namespace App\Models;

use App\Traits\RelationWithSameModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditWorkStep extends Model
{
    use HasFactory, RelationWithSameModel;
    protected $guarded = ['id'];

    // details
    public function details()
    {
        return $this->hasMany(AuditWorkStepDetail::class, 'audit_work_step_id');
    }
}
