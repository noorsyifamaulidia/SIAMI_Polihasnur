<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Auditee;
use App\Models\Auditor;
use App\Models\AuditPlan;
use App\Models\Indicator;
use Illuminate\Http\Request;
use App\Services\AuditService;
use App\Helpers\AuditUserHelper;
use App\Models\AuditIndicatorUnit;
use Illuminate\Support\Facades\DB;

class AuditPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $page = 'rencana';
        $service = AuditService::data($id);
        $ruangLingkupUnitIds = AuditUserHelper::ruangLingkupUnitIds($service);
        $indicators = AuditIndicatorUnit::forAuditorInput($id, 'AuditPlan', $ruangLingkupUnitIds)->paginate();

        return view('audit.room.plan.index', compact('service', 'indicators', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
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

        $compact = compact('service', 'plan', 'page', 'auditee', 'indicator', 'auditor', 'unit_id');

        return view('audit.room.plan.create', $compact);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $auditee_id = $request->get('auditee_id');
        $indicator_id = $request->get('indicator_id');

        $attr = $request->all();
        $attr['audit_id'] = $id;

        $check = ['audit_id' => $id, 'auditee_id' => $auditee_id, 'indicator_id' => $indicator_id];

        DB::transaction(function () use ($attr, $check) {
            // update or create audit plan
            $plan = AuditPlan::updateOrCreate($check, $attr);
            
            $details = [];
            foreach(array_filter($attr['standar']) as $x => $detail) {
                array_push($details, [
                    'tanggal' => $attr['tanggal'][$x],
                    'organisasi' => $attr['organisasi'][$x],
                    'auditor_kode' => $attr['auditor_kode'][$x],
                    'standar' => $detail,
                    'audit_plan_id' => $plan->id,
                ]);
            }
    
            // delete and create audit plan details
            $plan->details()->delete();
            $plan->details()->insert($details);
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
