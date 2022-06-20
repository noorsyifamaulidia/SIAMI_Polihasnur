<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\Temuan;
use App\Models\Auditee;
use App\Models\Auditor;
use App\Models\Category;
use App\Models\AuditNote;
use App\Models\AuditPlan;
use App\Models\Indicator;
use App\Models\Ringkasan;
use App\Models\AuditWorkStep;
use App\Services\AuditService;
use App\Helpers\AuditUserHelper;

class ReportController extends Controller
{

    private function getLogo() {
        $logo = 'images/logo.png';
        $typeLogo = pathinfo($logo, PATHINFO_EXTENSION);
        $dataLogo = file_get_contents($logo);
        $logo = 'data:image/' . $typeLogo . ';base64,' . base64_encode($dataLogo);

        $tagline = 'images/tagline.png';
        $typeTagline = pathinfo($tagline, PATHINFO_EXTENSION);
        $dataTagline = file_get_contents($tagline);
        $tagline = 'data:image/' . $typeTagline . ';base64,' . base64_encode($dataTagline);

        return $data = [
            'logo' => $logo,
            'tagline' => $tagline
        ];
    }

    public function evaluasi($id, $unit_id)
    {
        $service = AuditService::data($id);
        $ruangLingkupUnitIds = AuditUserHelper::ruangLingkupUnitIds($service);

        $unit = $service['audit']->units()
            ->indicatorForAuditor($id)
            ->getAuditee($id)
            ->getEvaluasiValue($id, $unit_id)
            ->where('units.id', $unit_id)
            ->firstOrFail();

        $logo = $this->getLogo();
        $compact = compact('service', 'unit', 'logo');
        
        $pdf = PDF::loadView('report.evaluasi', $compact, [], [
            'title' => 'Laporan Evaluasi'
        ]);

        return $pdf->stream('document.pdf');
    }

    public function rencana_audit($id)
    {
        $page = 'rencana';
        $unit_id = request()->get('unit_id');
        $indicator_id = request()->get('indicator_id');
        
        $service = AuditService::data($id);
        $auditor = Auditor::isKetuaAuditor($id)->firstOrFail();

        $auditee = Auditee::getAuditee($id, $unit_id)->firstOrFail();
        $indicator = Indicator::find($indicator_id);

        $plan = AuditPlan::with('details')->whereHas('auditee', function ($query) use ($unit_id) {
            $query->where('unit_id', $unit_id);
        })->where('indicator_id', $indicator_id)
        ->where('audit_id', $id)
        ->first();

        $logo = $this->getLogo();
        $compact = compact('service', 'plan', 'page', 'auditee', 'indicator', 'auditor', 'unit_id', 'logo');

        $pdf = PDF::loadView('report.rencana-audit', $compact, [], [
            'title' => 'Laporan Rencana Audit'
        ]);

        return $pdf->stream('document.pdf');
    }

    public function program_kerja($id)
    {
        $page = 'program-kerja';
        $unit_id = request()->get('unit_id');
        $indicator_id = request()->get('indicator_id');
        $service = AuditService::data($id);

        $auditor = Auditor::isKetuaAuditor($id)->firstOrFail();

        $auditee = Auditee::getAuditee($id, $unit_id)->firstOrFail();
        $indicator = Indicator::find($indicator_id);

        $step = AuditWorkStep::with('details')->whereHas('auditee', function ($query) use ($unit_id) {
            $query->where('unit_id', $unit_id);
        })->where('indicator_id', $indicator_id)
        ->where('audit_id', $id)
        ->first();

        // get first user role kepala upm
        $upm = User::isKepalaUpm()->first();

        $logo = $this->getLogo();
        $compact = compact('service', 'step', 'page', 'auditee', 'indicator', 'auditor', 'upm', 'unit_id', 'logo');

        $pdf = PDF::loadView('report.program-kerja', $compact, [], [
            'title' => 'Program Kerja Audit'
        ]);

        return $pdf->stream('document.pdf');
    }

    public function catatan_audit($id)
    {
        $page = 'note';
        $unit_id = request()->get('unit_id');
        $indicator_id = request()->get('indicator_id');
        $service = AuditService::data($id);

        $auditor = Auditor::isKetuaAuditor($id)->firstOrFail();
        $auditors = Auditor::where('audit_id', $id)->whereRelation('units', 'unit_id', $unit_id)->get();

        $auditee = Auditee::getAuditee($id, $unit_id)->firstOrFail();
        $indicator = Indicator::find($indicator_id);

        $note = AuditNote::whereHas('auditee', function ($query) use ($unit_id) {
            $query->where('unit_id', $unit_id);
        })->where('indicator_id', $indicator_id)
        ->where('audit_id', $id)
        ->first();

        $logo = $this->getLogo();
        $compact = compact('service', 'note', 'page', 'auditee', 'indicator', 'auditor', 'auditors', 'unit_id', 'logo');

        $pdf = PDF::loadView('report.catatan', $compact, [], [
            'title' => 'Catatan Audit'
        ]);

        return $pdf->stream('document.pdf');
    }

    public function ringkasan_temuan($id)
    {
        $page = 'ringkasan';
        $unit_id = request()->get('unit_id');
        $indicator_id = request()->get('indicator_id');
        $service = AuditService::data($id);

        $auditor = Auditor::isKetuaAuditor($id)->firstOrFail();
        $auditors = Auditor::where('audit_id', $id)->whereRelation('units', 'unit_id', $unit_id)->get();

        $auditee = Auditee::getAuditee($id, $unit_id)->firstOrFail();
        $indicator = Indicator::find($indicator_id);

        $ringkasan = Ringkasan::with('details.category')->whereHas('auditee', function ($query) use ($unit_id) {
            $query->where('unit_id', $unit_id);
        })->where('indicator_id', $indicator_id)
        ->where('audit_id', $id)
        ->first();

        $categories = Category::whereIn('code', ['OB', 'KTS'])->get();
        $logo = $this->getLogo();
        $compact = compact('service', 'ringkasan', 'page', 'auditee', 'indicator', 'auditor', 'auditors', 'categories', 'unit_id', 'logo');

        $pdf = PDF::loadView('report.ringkasan', $compact, [], [
            'title' => 'Ringkasan Temuan'
        ]);

        return $pdf->stream('document.pdf');
    }

    public function temuan_audit($id)
    {
        $page = 'temuan';
        $unit_id = request()->get('unit_id');
        $indicator_id = request()->get('indicator_id');
        $service = AuditService::data($id);

        $auditor = Auditor::isKetuaAuditor($id)->firstOrFail();
        $auditors = Auditor::where('audit_id', $id)->whereRelation('units', 'unit_id', $unit_id)->get();

        $auditee = Auditee::getAuditee($id, $unit_id)->firstOrFail();
        $indicator = Indicator::find($indicator_id);

        $temuan = Temuan::whereHas('auditee', function ($query) use ($unit_id) {
            $query->where('unit_id', $unit_id);
        })->where('indicator_id', $indicator_id)
        ->where('audit_id', $id)
        ->first();

        $logo = $this->getLogo();
        $compact = compact('service', 'temuan', 'page', 'auditee', 'indicator', 'auditor', 'auditors', 'logo');

        $pdf = PDF::loadView('report.temuan', $compact, [], [
            'title' => 'Temuan Audit'
        ]);

        return $pdf->stream('document.pdf');
    }
}
