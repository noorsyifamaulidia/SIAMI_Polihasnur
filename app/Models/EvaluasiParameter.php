<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluasiParameter extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['parameterTahun'];

    public function scopeIndicatorAuditee($query, $indicator_id, $auditee_id)
    {
        $query->where('indicator_id', $indicator_id)->where('auditee_id', $auditee_id);
    }

    public function parameterTahun()
    {
        return $this->hasMany(EvaluasiParameterTahun::class, 'evaluasi_parameter_id');
    }

    // relation with auditee
    public function auditee()
    {
        return $this->belongsTo(Auditee::class);
    }
}
