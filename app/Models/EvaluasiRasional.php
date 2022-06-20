<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluasiRasional extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function scopeIndicatorAuditee($query, $indicator_id, $auditee_id)
    {
        $query->where('indicator_id', $indicator_id)->where('auditee_id', $auditee_id);
    }

    // relation with auditee
    public function auditee()
    {
        return $this->belongsTo(Auditee::class);
    }
}
