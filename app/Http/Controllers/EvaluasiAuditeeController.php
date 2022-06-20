<?php

namespace App\Http\Controllers;

use App\Models\Auditee;
use App\Models\AuditIndicator;
use App\Models\EvaluasiParameter;
use App\Models\EvaluasiParameterTahun;
use App\Models\EvaluasiRasional;
use App\Models\EvaluasiSwot;
use App\Models\Indicator;
use AuditUser;
use Illuminate\Http\Request;
use App\Services\AuditService;
use Illuminate\Support\Facades\DB;

class EvaluasiAuditeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $page = 'evaluasi';
        $service = AuditService::data($id);
        $auditee = Auditee::whereAuditId($id)->whereUserId(auth()->id())->first();
        $unitId = $auditee->unit_id;
        $auditIndicator = AuditIndicator::auditeeIndicator($unitId, $id)->get();

        return view('audit.room.auditee.evaluasi.index', compact('page', 'service', 'auditIndicator', 'auditee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($auditId)
    {
        $indicatorId = $_GET['indicator'];
        $page = 'evaluasi';
        $service = AuditService::data($auditId);
        $auditee = Auditee::whereAuditId($auditId)->whereUserId(auth()->id())->first();
        $unitId = $auditee->unit_id;

        $auditIndicator = AuditIndicator::auditeeIndicator($unitId, $auditId)->get();
        $indicator = Indicator::find($indicatorId);

        $rasionale = EvaluasiRasional::indicatorAuditee($indicator->id, $auditee->id)->first();
        $swot = EvaluasiSwot::indicatorAuditee($indicator->id, $auditee->id)->first();
        $parameter = EvaluasiParameter::with('parameterTahun')->indicatorAuditee($indicator->id, $auditee->id)->get()->toArray();

        // dd($parameter);

        return view('audit.room.auditee.evaluasi.create', compact('page', 'service', 'auditee', 'auditIndicator', 'indicator', 'rasionale', 'swot', 'parameter'));
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
        $attr['indicator_id'] = $_GET['indicator'];
        $attr['auditee_id'] = $_GET['auditee_id'];
        // dd($attr);

        DB::transaction(function() use ($attr) {
            // check indicator auditee
            $check = [
                'indicator_id' => $attr['indicator_id'],
                'auditee_id' => $attr['auditee_id'],
            ];
            
            // save to evaluasi rasionals
            $rasionale = [
                'rasionale_standar' => $attr['rasionale_standar'],
                'laporan_kinerja' => $attr['laporan_kinerja'],
                'hambatan' => $attr['hambatan'],
                'upaya_perbaikan' => $attr['upaya_perbaikan'],
                'lainnya' => $attr['lainnya'],
            ];

            EvaluasiRasional::updateOrCreate($check, $rasionale);

            // save to evaluasi swot
            $swot = [
                'strenght' => $attr['strenght'],
                'weakness' => $attr['weakness'],
                'opportunity' => $attr['opportunity'],
                'strategi_so' => $attr['strategi_so'],
                'strategi_wo' => $attr['strategi_wo'],
                'strategi_st' => $attr['strategi_st'],
                'strategi_wt' => $attr['strategi_wt'],
                'threat' => $attr['threat'],
            ];

            EvaluasiSwot::updateOrCreate($check, $swot);

            // save to evaluasi parameters
            foreach ($attr['standar'] as $x => $n) {
                if(!empty($n)) {
                    // insert to evaluasi parameters
                    $parameter = EvaluasiParameter::updateOrCreate([
                        'indicator_id' => $attr['indicator_id'],
                        'auditee_id' => $attr['auditee_id'],
                        'standar' => $n,
                    ], [
                        'standar' => $n,
                        'sasaran' => $attr['sasaran'][$x]
                    ]);
    
                    // save to evaluasi parameter tahun
                    foreach ($attr['persen'] as $y => $persen) {
                        if(!empty($persen)) {
                            EvaluasiParameterTahun::updateOrCreate([
                                'tahun' => $attr['tahun'][$y],
                                'evaluasi_parameter_id' => $parameter->id
                            ], [
                                'persen' => $persen,
                                'persen' => $attr['persen'][$y]
                            ]);
                        }
                    }
                }
            }
        });

        return back()->with(['success' => 'Successfully Updated']);
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
