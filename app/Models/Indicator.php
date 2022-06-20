<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    public $timestamps = false;

    // scope filter
    public function scopeFilter($query, $params)
    {
        $query->where(function($query) use ($params) {
            if (isset($params['q'])) {
                $query->where('name', 'like', '%' . $params['q'] . '%');
            }
        });
    }

    // audit_indicator
    public function auditIndicators()
    {
        return $this->hasMany(AuditIndicator::class);
    }
}
