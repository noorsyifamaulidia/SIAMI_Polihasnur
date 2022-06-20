<?php

namespace App\Helpers;
use App\Models\Audit;

   class AuditUserHelper
   {
     public static function user($audit)
     {

        // if upm
        if (auth()->user()->hasRole('kepala upm')) {
            return 'upm';
        }

       $auditee = $audit->auditee->where('user_id', auth()->id())->first();
       $auditor = $audit->auditor->where('user_id', auth()->id())->first();
       $responsible = $audit->responsible->where('user_id', auth()->id())->first();

       if ($auditee) {
         return 'auditee';
       }

      if($auditor) {
        return $auditor->pelaksana->name;
      }

      if ($responsible) {
        return 'Pimpinan Auditi';
      }
     }
     
     public static function ruangLingkupUnitIds($service)
     {
        $audit = $service['audit'];

        if($service['role_audit'] == 'Pimpinan Auditi') {
          $responsible = $audit->responsible->where('user_id', auth()->id())->first();
          return $responsible->units->pluck('id')->toArray();
        }

        if($service['role_audit'] == 'upm' || $service['role_audit'] == 'Ka Auditor') {
          return $audit->units->pluck('id')->toArray();
        } 
        
        if ($service['role_audit'] == 'Tim Auditor') {
          $auditor = $audit->auditor->where('user_id', auth()->id())->first();
          return $auditor->units->pluck('id')->toArray();
        }

        if($service['role_audit'] == 'auditee') {
          $auditee = $audit->auditee->where('user_id', auth()->id())->first();
          return [$auditee->unit_id];
        }
     }
   }

?>