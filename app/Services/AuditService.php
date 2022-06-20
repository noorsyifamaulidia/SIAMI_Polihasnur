<?php

namespace App\Services;

use App\Helpers\AuditUserHelper;
use App\Models\Audit;

   class AuditService
   {
     public static function data($id) {
        $audit = Audit::findOrFail($id);
        $role_audit = AuditUserHelper::user($audit);

        return [
            'audit' => $audit,
            'role_audit' => $role_audit
        ];
     }
   }
?>