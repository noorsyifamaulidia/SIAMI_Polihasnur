<?php

namespace App\Http\Livewire\Audit;

use App\Models\User;
use App\Models\Audit;
use App\Models\Auditor;
use Livewire\Component;
use App\Models\Pelaksana;

class AuditorIndex extends Component
{
    public $audit;
    public $kode;

    public $userId;
    public $pelaksanaId;
    public $auditId;
    public $unitIds;
    public $auditorId;

    public $statusModal = 'Tambah';
    
    public function render()
    {
        $auditors = Auditor::where('audit_id', $this->audit->id)->latest('pelaksana_id')->get();
        $users = User::isUser()->get();
        $pelaksana = Pelaksana::find([3, 4]);
        $units = $this->audit->units;

        return view('livewire.audit.auditor-index', compact('auditors', 'pelaksana', 'units', 'users'))->extends('layouts.app');
    }

    public function mount($id)
    {
        $this->audit = Audit::findOrFail($id);
    }

    // add
    public function add()
    {
        $this->statusModal = 'Tambah';
    }

    // edit
    public function edit($id)
    {
        $auditor = Auditor::findOrFail($id);
        $this->auditorId = $id;
        $this->kode = $auditor->kode;
        $this->userId = $auditor->user_id;
        $this->pelaksanaId = $auditor->pelaksana_id;
        $this->unitIds = $auditor->units->pluck('id')->toArray();
        $this->statusModal = 'Edit';

        // emit
        $this->emit('editAuditor', $this->unitIds);
    }

    // store
    public function store()
    {
        $this->validate();

        $auditor = new Auditor;
        $auditor->kode = $this->kode;
        $auditor->user_id = $this->userId;
        $auditor->pelaksana_id = $this->pelaksanaId;
        $auditor->audit_id = $this->audit->id;
        $auditor->save();

        $auditor->units()->sync($this->unitIds);

        $this->emit('auditorAdded');
        session()->flash('message', 'Auditor berhasil ditambahkan');
    }

    // update
    public function update()
    {
        $this->validate();

        $auditor = Auditor::findOrFail($this->auditorId);
        $auditor->kode = $this->kode;
        $auditor->user_id = $this->userId;
        $auditor->pelaksana_id = $this->pelaksanaId;
        $auditor->audit_id = $this->audit->id;
        $auditor->save();

        $auditor->units()->sync($this->unitIds);

        $this->emit('auditorUpdated');

        // session
        session()->flash('success', 'Auditor berhasil diubah');
    }

    // destroy
    public function destroy($id)
    {
        $auditor = Auditor::findOrFail($id);
        $auditor->delete();

        $this->emit('auditorDeleted');

        // session
        session()->flash('success', 'Auditor berhasil dihapus');
    }

    // rules 
    public function rules()
    {
        return [
            'userId' => 'required',
            'pelaksanaId' => 'required',
        ];
    }

    // messages
    public function messages()
    {
        return [
            'userId.required' => 'Auditor harus dipilih',
            'pelaksanaId.required' => 'Pelaksana harus dipilih',
        ];
    }
}
