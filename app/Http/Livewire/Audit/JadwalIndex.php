<?php

namespace App\Http\Livewire\Audit;

use App\Models\Audit;
use App\Models\Jadwal;
use Livewire\Component;
use App\Models\Pelaksana;

class JadwalIndex extends Component
{
    public $audit;
    public $tanggal;
    public $kegiatan;
    public $rincian;
    public $pelaksanaIds;
    public $jadwalId;

    public $statusModal;
    
    public function render()
    {
        $jadwal = Jadwal::where('audit_id', $this->audit->id)->get();
        $pelaksana = Pelaksana::all();
        
        return view('livewire.audit.jadwal-index', compact('jadwal', 'pelaksana'))->extends('layouts.app');
    }

    public function mount($id)
    {
        $this->audit = Audit::findOrFail($id);
    }

    public function add()
    {
        $this->statusModal = 'Tambah';
    }

    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $this->jadwalId = $id;
        $this->tanggal = $jadwal->tanggal;
        $this->kegiatan = $jadwal->kegiatan;
        $this->rincian = $jadwal->rincian;
        $this->pelaksanaIds = $jadwal->pelaksana->pluck('id')->toArray();
        $this->statusModal = 'Edit';

        // emit
        $this->emit('editJadwal', $this->pelaksanaIds);
    }

    // store
    public function store()
    {
        $this->validate();

        $jadwal = new Jadwal;
        $jadwal->tanggal = $this->tanggal;
        $jadwal->kegiatan = $this->kegiatan;
        $jadwal->rincian = $this->rincian;
        $jadwal->audit_id = $this->audit->id;
        $jadwal->save();

        $jadwal->pelaksana()->sync($this->pelaksanaIds);

        $this->reset(['tanggal', 'kegiatan', 'rincian', 'pelaksanaIds']);

        // session
        session()->flash('message', 'Jadwal berhasil ditambahkan');
    }

    // update
    public function update()
    {
        $this->validate();

        $jadwal = Jadwal::findOrFail($this->jadwalId);
        $jadwal->tanggal = $this->tanggal;
        $jadwal->kegiatan = $this->kegiatan;
        $jadwal->rincian = $this->rincian;
        $jadwal->audit_id = $this->audit->id;
        $jadwal->save();

        $jadwal->pelaksana()->sync($this->pelaksanaIds);

        $this->reset(['tanggal', 'kegiatan', 'rincian', 'pelaksanaIds', 'jadwalId']);

        // session
        session()->flash('success', 'Jadwal berhasil diubah');

        // emit
        $this->emit('jadwalUpdated');
    }

    // destroy
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $jadwal->delete();

        // session
        session()->flash('success', 'Jadwal berhasil dihapus');
    }

    // rules
    protected function rules()
    {
        return [
            'tanggal' => 'required',
            'kegiatan' => 'required',
            'rincian' => 'required',
            'pelaksanaIds' => 'required',
        ];
    }

    // message
    protected function messages()
    {
        return [
            'tanggal.required' => 'Tanggal harus diisi',
            'kegiatan.required' => 'Kegiatan harus diisi',
            'rincian.required' => 'Rincian harus diisi',
            'pelaksanaIds.required' => 'Pelaksana harus dipilih',
        ];
    }
}
