<?php

namespace App\Http\Controllers;

use App\Models\Indicator;
use Illuminate\Http\Request;

class IndicatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $params = request()->except('_token');
        $indicators = Indicator::filter($params)->paginate(10);
        
        return view('indicator.index', compact('indicators'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Indicator::create($request->all());

        session()->flash('success', 'Indikator berhasil ditambahkan');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Indicator $indicator)
    {
        return view('indicator.edit', compact('indicator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Indicator $indicator)
    {
        $indicator->update($request->all());

        session()->flash('success', 'Indikator berhasil diubah');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Indicator $indicator)
    {
        try {
            $indicator->delete();
            session()->flash('success', 'Indikator berhasil dihapus');
        } catch (\Throwable $th) {
            session()->flash('error', 'Indikator tidak dapat dihapus');
        }

        return redirect()->back();
    }
}
