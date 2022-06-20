<?php

namespace App\Http\Livewire\Audit;

use App\Models\Audit;
use Livewire\Component;
use App\Models\Pelaksana;
use Livewire\WithPagination;

class AuditIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $modalTitle;
    public $statusAdd = false;
    public $statusEdit = false;

    public $auditId;
    public $name;
    public $semester;
    public $thn_akademik;
    public $start;
    public $end;
    public $is_active;
    public $tanggal_evaluasi;
    public $waktu_evaluasi;

    public function render()
    {
        $audits = Audit::paginate(10);
        $active = 'audit';

        return view('livewire.audit.audit-index', compact('audits', 'active'))->extends('layouts.app');
    }

    public function add()
    {
        $this->modalTitle = 'Tambah Audit';
        $this->statusAdd = true;
        $this->statusEdit = false;

        $this->name = null;
        $this->semester = null;
        $this->thn_akademik = null;
        $this->is_active = null;
        $this->userId = null;
        $this->tanggal_evaluasi = null;
        $this->waktu_evaluasi = null;
    }

    // store
    public function store()
    {
        $attr = $this->validate([
            'name' => 'required',
            'semester' => 'required',
            'thn_akademik' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);

        $attr['jadwal_evaluasi'] = $this->tanggal_evaluasi . ' ' . $this->waktu_evaluasi;
        Audit::create($attr);

        // session
        session()->flash('message', 'Data berhasil ditambahkan');

        // emit
        $this->emit('auditUpdated');
    }

    // edit
    public function edit($id)
    {
        $audit = Audit::find($id);

        $this->modalTitle = 'Edit Audit';
        $this->statusAdd = false;
        $this->statusEdit = true;

        $this->auditId = $audit->id;
        $this->name = $audit->name;
        $this->semester = $audit->semester;
        $this->thn_akademik = $audit->thn_akademik;
        $this->start = $audit->start;
        $this->end = $audit->end;
        $this->is_active = $audit->is_active;

        $split = ($audit->jadwal_evaluasi) ? explode(' ', $audit->jadwal_evaluasi) : '';
        $this->tanggal_evaluasi = $split[0] ?? '';
        $this->waktu_evaluasi = $split[1] ?? '';
    }

    // update
    public function update()
    {
        $attr = $this->validate();

        $audit = Audit::find($this->auditId);
        $attr['jadwal_evaluasi'] = $this->tanggal_evaluasi . ' ' . $this->waktu_evaluasi;
        $audit->update($attr);

        // session
        session()->flash('message', 'Data berhasil diubah');

        // emit
        $this->emit('auditUpdated');
    }

    // delete
    public function destroy($id)
    {
        try {
            $audit = Audit::find($id);
            $audit->delete();

            // session
            session()->flash('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            session()->flash('success', 'Data tidak dapat dihapus');
        }
    }

    // set active
    public function setActive(Audit $audit)
    {
        $status = !$audit->is_active;
        $audit->update([
            'is_active' => $status,
        ]);

        if($status) {
            session()->flash('success', 'Audit berhasil diaktifkan');
        } else {
            session()->flash('success', 'Audit berhasil dinonaktifkan');
        }
    }

    // rules
    public function rules()
    {
        return [
            'name' => 'required',
            'semester' => 'required',
            'thn_akademik' => 'required',
            'start' => 'required',
            'end' => 'required',
        ];
    }

    // messages
    public function messages()
    {
        return [
            'name.required' => 'Nama Audit harus diisi',
            'semester.required' => 'Semester harus diisi',
            'thn_akademik.required' => 'Tahun Akademik harus diisi',
            'start.required' => 'Tanggal Mulai harus diisi',
            'end.required' => 'Tanggal Selesai harus diisi',
        ];
    }
}
