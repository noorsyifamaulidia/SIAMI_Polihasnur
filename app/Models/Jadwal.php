<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $table = 'jadwal';
    protected $fillable = ['tanggal', 'kegiatan', 'rincian', 'audit_id'];

    // pelaksana
    public function pelaksana()
    {
        return $this->belongsToMany(Pelaksana::class, 'jadwal_pelaksana', 'jadwal_id', 'pelaksana_id');
    }
}
