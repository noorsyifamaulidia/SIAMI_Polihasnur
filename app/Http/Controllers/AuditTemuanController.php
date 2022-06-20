<?php

namespace App\Http\Controllers;

use App\Models\Temuan;
use App\Models\Auditee;
use App\Models\Auditor;
use App\Models\Indicator;
use Illuminate\Http\Request;
use App\Services\AuditService;
use App\Helpers\AuditUserHelper;
use App\Models\AuditIndicatorUnit;

class AuditTemuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $page = 'temuan';
        $service = AuditService::data($id);
        $ruangLingkupUnitIds = AuditUserHelper::ruangLingkupUnitIds($service);
        $indicators = AuditIndicatorUnit::forAuditorInput($id, 'Temuan', $ruangLingkupUnitIds)->paginate();

        return view('audit.room.temuan.index', compact('service', 'indicators', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
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

        $compact = compact('service', 'temuan', 'page', 'auditee', 'indicator', 'auditor', 'auditors', 'unit_id');

        return view('audit.room.temuan.create', $compact);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attr = $request->all();

        if(@$request->jenis) {
            $request->validate([
                'tanggapan_auditi' => 'required',
                'approval_pimpinan_auditi' => 'required',
            ], [
                'tanggapan_auditi.required' => 'Tanggapan auditi harus diisi!',
                'approval_pimpinan_auditi.required' => 'Approval pimpinan auditi harus diceklist!',
            ]);
            $message = 'Tanggapan berhasil dikirim';
        } else {
            $message = 'Data berhasil disimpan';
        }

        $check = ['audit_id' => $request->audit_id, 'auditee_id' => $request->auditee_id, 'indicator_id' => $request->indicator_id];

        Temuan::updateOrCreate($check, $attr);

        return back()->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
