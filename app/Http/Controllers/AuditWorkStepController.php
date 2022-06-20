<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Auditee;
use App\Models\Auditor;
use App\Models\Indicator;
use Illuminate\Http\Request;
use App\Models\AuditWorkStep;
use App\Services\AuditService;
use App\Helpers\AuditUserHelper;
use App\Models\AuditIndicatorUnit;
use Illuminate\Support\Facades\DB;

class AuditWorkStepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $page = 'program-kerja';
        $service = AuditService::data($id);
        $ruangLingkupUnitIds = AuditUserHelper::ruangLingkupUnitIds($service);
        $indicators = AuditIndicatorUnit::forAuditorInput($id, 'AuditWorkStep', $ruangLingkupUnitIds)->paginate();

        return view('audit.room.program-kerja.index', compact('service', 'indicators', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
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

        $compact = compact('service', 'step', 'page', 'auditee', 'indicator', 'auditor', 'upm', 'unit_id');

        return view('audit.room.program-kerja.create', $compact);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $attr = $request->all();
        $check = ['audit_id' => $id, 'auditee_id' => $request->auditee_id, 'indicator_id' => $request->indicator_id];

        DB::transaction(function () use ($attr, $check) {
            $audit_work_step = AuditWorkStep::updateOrCreate($check, $attr);

            $details = [];
            foreach(array_filter($attr['langkah_kerja']) as $x => $detail) {
                array_push($details, [
                    'keterangan' => $attr['keterangan'][$x],
                    'langkah_kerja' => $detail,
                    'audit_work_step_id' => $audit_work_step->id,
                ]);
            }
    
            $audit_work_step->details()->delete();
            $audit_work_step->details()->insert($details);
        });

        return redirect()->back()->with('success', 'Data berhasil disimpan');
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
