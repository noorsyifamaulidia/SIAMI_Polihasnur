<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluasiParameterTahun extends Model
{
    use HasFactory;
    protected $table = 'evaluasi_parameter_tahun';
    protected $guarded = ['id'];

    public function scopeIndicatorAuditee($query, $indicator_id, $auditee_id)
    {
        $query->where('indicator_id', $indicator_id)->where('auditee_id', $auditee_id);
    }
}
