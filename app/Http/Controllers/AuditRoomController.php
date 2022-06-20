<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\Auditee;
use App\Models\Ringkasan;
use Illuminate\Http\Request;
use App\Models\AuditIndicator;
use App\Services\AuditService;
use App\Helpers\AuditUserHelper;
use Illuminate\Support\Facades\DB;

class AuditRoomController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $page = 'room';
        $service = AuditService::data($id);


        if(!$service['role_audit']) {
          return back();
        }

        $auditees = $service['audit']->auditee;
        $indicators = $service['audit']->indicators;
        
        return view('audit.room.index', compact('service', 'auditees', 'indicators', 'page'));
    }

    // evaluasi diri
    public function evaluasi($id)
    {
        $page = 'evaluasi';
        $service = AuditService::data($id);

        if(!$service['role_audit']) {
          return back();
        }
        
        $ruangLingkupUnitIds = AuditUserHelper::ruangLingkupUnitIds($service);

        $units = $service['audit']->units()
            ->indicatorForAuditor($id)
            ->whereIn('units.id', $ruangLingkupUnitIds)
            ->get();

        return view('audit.room.evaluasi', compact('service', 'units', 'page'));
    }

    // evaluasi diri detail
    public function evaluasi_detail($id, $unit_id)
    {
        $page = 'evaluasi';
        $service = AuditService::data($id);
        $ruangLingkupUnitIds = AuditUserHelper::ruangLingkupUnitIds($service);

        $unit = $service['audit']->units()
            ->indicatorForAuditor($id)
            ->getAuditee($id)
            ->getEvaluasiValue($id, $unit_id)
            ->where('units.id', $unit_id)
            ->firstOrFail();

        $compact = compact('service', 'unit', 'page');

        return view('audit.room.evaluasi_detail', $compact);
    }

    public function jadwal_visitasi($id)
    {
      $page = 'jadwal-visitasi';
      $service = AuditService::data($id);
      
      return view('audit.room.jadwal-visitasi', compact('page', 'service'));
    }

    // save jadwal visitasi
    public function save_jadwal_visitasi($id)
    {
      request()->validate([
        'tanggal_visitasi'=> 'required',
        'keterangan_visitasi' => 'required'
      ], [
        'tanggal_visitasi.required' => 'Tanggal visitasi harus diisi',
        'keterangan_visitasi.required' => 'Keterangan visitasi harus diisi'
      ]);

      $service = AuditService::data($id);
      $service['audit']->update([
        'tanggal_visitasi' => request()->tanggal_visitasi,
        'keterangan_visitasi' => request()->keterangan_visitasi,
      ]);

      return back()->with('success', 'Jadwal visitasi berhasil disimpan');
    }

    public function approval(Request $request)
    {
      $audit_id = $request->audit_id;
      $table = $request->table;
      $service = AuditService::data($audit_id);
      $role = $service['role_audit'];
      $table = DB::table($table)->where('id', $request->id);

      $user_id = (!$request->status_validasi) ? null : auth()->id();

      if($role == 'auditee') {
        $table->update([
            'approval_pimpinan_auditi' => $user_id
        ]);
      } else if($role == 'upm') {
        $table->update([
            'reviewed_by_upm' => $user_id
        ]);
      } else if($role == 'Pimpinan Auditi') {
        $table->update([
            'reviewed_by_pj' => $user_id
        ]);
      } else {
        $table->update([
            'approval_ketua_auditor' => $user_id
        ]);
      }

      if(!$request->status_validasi) {
        return back()->with('success', 'Validasi Berhasil Dibatalkan');
      } else {
        return back()->with('success', 'Terimakasih telah melakukan validasi pada form ini');
      }
    }
}
