<?php

namespace App\Models;

use App\Traits\RelationWithSameModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ringkasan extends Model
{
    use HasFactory, RelationWithSameModel;
    protected $table = 'ringkasan';
    protected $guarded = ['id'];

    public function details()
    {
        return $this->hasMany(RingkasanDetail::class, 'ringkasan_id');
    }

    // approval_pimpinan_auditi
    public function approvalPimpinanAuditi()
    {
        return $this->belongsTo(User::class, 'approval_pimpinan_auditi');
    }

    // approval_ketua_auditor
    public function approvalKetuaAuditor()
    {
        return $this->belongsTo(User::class, 'approval_ketua_auditor');
    }

    // reviewed by upm
    public function reviewedByUpm()
    {
        return $this->belongsTo(User::class, 'reviewed_by_upm');
    }

    // reviewed by pj
    public function reviewedByPj()
    {
        return $this->belongsTo(User::class, 'reviewed_by_pj');
    }
}
