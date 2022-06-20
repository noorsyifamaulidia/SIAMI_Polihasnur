<?php

namespace App\Traits;
  use App\Models\Auditee;
  use App\Models\Auditor;
  use App\Models\Indicator;

   trait RelationWithSameModel
   {
     // relation with auditee
    public function auditee()
    {
        return $this->belongsTo(Auditee::class, 'auditee_id');
    }

    // relation with indicator
    public function indicator()
    {
        return $this->belongsTo(Indicator::class, 'indicator_id');
    }

    // relation with auditor
    public function auditor()
    {
        return $this->belongsTo(Auditor::class, 'auditor_id');
    }
   }
?>