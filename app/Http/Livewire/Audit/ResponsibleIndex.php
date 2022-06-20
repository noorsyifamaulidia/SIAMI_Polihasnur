<?php

namespace App\Http\Livewire\Audit;

use App\Models\User;
use App\Models\Audit;
use App\Models\Responsible;
use Livewire\Component;
use App\Models\Pelaksana;

class ResponsibleIndex extends Component
{
    public $audit;

    public $userId;
    public $pelaksanaId;
    public $auditId;
    public $unitIds;
    public $responsibleId;

    public $statusModal = 'Tambah';
    
    public function render()
    {
        $responsibles = Responsible::where('audit_id', $this->audit->id)->latest('pelaksana_id')->get();
        $users = User::isUser()->get();
        $pelaksana = Pelaksana::find([7, 8]);
        $units = $this->audit->units;

        return view('livewire.audit.responsible-index', compact('responsibles', 'pelaksana', 'units', 'users'))->extends('layouts.app');
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
        $responsible = Responsible::findOrFail($id);
        $this->responsibleId = $id;
        $this->userId = $responsible->user_id;
        $this->pelaksanaId = $responsible->pelaksana_id;
        $this->unitIds = $responsible->units->pluck('id')->toArray();
        $this->statusModal = 'Edit';

        // emit
        $this->emit('editResponsible', $this->unitIds);
    }

    // store
    public function store()
    {
        $this->validate();

        $responsible = new Responsible;
        $responsible->user_id = $this->userId;
        $responsible->pelaksana_id = $this->pelaksanaId;
        $responsible->audit_id = $this->audit->id;
        $responsible->save();

        $responsible->units()->sync($this->unitIds);

        $this->emit('responsibleAdded');
        session()->flash('message', 'Responsible berhasil ditambahkan');
    }

    // update
    public function update()
    {
        $this->validate();

        $responsible = Responsible::findOrFail($this->responsibleId);
        $responsible->user_id = $this->userId;
        $responsible->pelaksana_id = $this->pelaksanaId;
        $responsible->audit_id = $this->audit->id;
        $responsible->save();

        $responsible->units()->sync($this->unitIds);

        $this->emit('responsibleUpdated');

        // session
        session()->flash('success', 'PJ berhasil diubah');
    }

    // destroy
    public function destroy($id)
    {
        $responsible = Responsible::findOrFail($id);
        $responsible->delete();

        $this->emit('responsibleDeleted');

        // session
        session()->flash('success', 'PJ berhasil dihapus');
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
            'userId.required' => 'PJ harus dipilih',
            'pelaksanaId.required' => 'Pelaksana harus dipilih',
        ];
    }
}
