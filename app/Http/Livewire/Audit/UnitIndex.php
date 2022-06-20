<?php

namespace App\Http\Livewire\Audit;

use App\Models\Unit;
use App\Models\User;
use App\Models\Audit;
use App\Models\Auditee;
use Livewire\Component;

class UnitIndex extends Component
{
    public $audit;
    
    public $unitId;
    public $userId;
    public $auditeeId;

    public function render()
    {
        $units = Unit::all();
        $users = User::isUser()->get();
        $auditees = Auditee::where('audit_id', $this->audit->id)->get();

        return view('livewire.audit.unit-index', compact('units', 'users', 'auditees'))->extends('layouts.app');
    }

    public function mount($id)
    {
        $this->audit = Audit::findOrFail($id);
    }

    // store
    public function store()
    {
        $this->validate();

        Auditee::firstOrCreate([
            'unit_id' => $this->unitId,
            'user_id' => $this->userId,
            'audit_id' => $this->audit->id,
        ]);

        // reset
        $this->reset(['unitId', 'userId']);

        // session
        session()->flash('success', 'Data berhasil ditambahkan');
    }

    // edit
    public function edit($id)
    {
        $auditee = Auditee::findOrFail($id);

        $this->unitId = $auditee->unit_id;
        $this->userId = $auditee->user_id;
        $this->auditeeId = $auditee->id;
    }

    // update
    public function update()
    {
        $this->validate();

        $auditee = Auditee::findOrFail($this->auditeeId);
        $auditee->update([
            'unit_id' => $this->unitId,
            'user_id' => $this->userId,
        ]);

        // reset
        // $this->reset(['unitId', 'userId', 'auditeeId']);

        // session
        session()->flash('success', 'Data berhasil diubah');

        // emit
        $this->emit('unitUpdated');
    }

    // delete
    public function destroy($id)
    {
        try {
            $data = Auditee::find($id);
            $data->delete();

            // session
            session()->flash('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            session()->flash('success', 'Data tidak dapat dihapus');
        }
    }

    protected $rules = [
        'unitId' => 'required',
        'userId' => 'required',
    ];

    protected $messages = [
        'unitId.required' => 'Unit harus dipilih',
        'userId.required' => 'Kepala unit harus dipilih',
    ];
}
