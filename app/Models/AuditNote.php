<?php

namespace App\Models;

use App\Traits\RelationWithSameModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditNote extends Model
{
    use HasFactory, RelationWithSameModel;
    protected $guarded = ['id'];
}
