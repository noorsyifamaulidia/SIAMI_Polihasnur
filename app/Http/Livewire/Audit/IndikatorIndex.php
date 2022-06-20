<?php

namespace App\Http\Livewire\Audit;

use App\Models\Unit;
use App\Models\Audit;
use App\Models\AuditIndicator;
use Livewire\Component;
use App\Models\Indicator;

class IndikatorIndex extends Component
{

    public $audit;
    
    public $unitIds;
    public $indicatorId;
    public $auditIndicatorId;
    
    public function render()
    {
        $units = Unit::all();
        $indicators = Indicator::all();
        $auditIndicators = AuditIndicator::where('audit_id', $this->audit->id)->get();

        return view('livewire.audit.indikator-index', compact('units', 'indicators', 'auditIndicators'))->extends('layouts.app');
    }

    public function mount($id)
    {
        $this->audit = Audit::findOrFail($id);
    }

    // store with db transaction
    public function store()
    {
        $this->validate();

        $auditIndicator = AuditIndicator::firstOrCreate([
            'audit_id' => $this->audit->id,
            'indicator_id' => $this->indicatorId,
        ]);

        $auditIndicator->units()->sync($this->unitIds);

        // reset
        $this->reset(['unitIds', 'indicatorId']);

        // session
        session()->flash('success', 'Standar berhasil ditambahkan');
    }

    // edit
    public function edit($id)
    {
        $auditIndicator = AuditIndicator::findOrFail($id);

        $this->unitIds = $auditIndicator->units->pluck('id')->toArray();
        $this->indicatorId = $auditIndicator->indicator_id;
        $this->auditIndicatorId = $auditIndicator->id;

        $this->emit('editIndicator', $this->unitIds);
    }

    // update
    public function update()
    {
        $this->validate();

        $auditIndicator = AuditIndicator::findOrFail($this->auditIndicatorId);
        $auditIndicator->update([
            'indicator_id' => $this->indicatorId,
        ]);

        $auditIndicator->units()->sync($this->unitIds);

        // reset
        $this->reset(['unitIds', 'indicatorId']);

        // session
        session()->flash('success', 'Standar berhasil diubah');

        // emit
        $this->emit('indicatorUpdated');
    }

    // destroy
    public function destroy($id)
    {
        $auditIndicator = AuditIndicator::findOrFail($id);

        $auditIndicator->delete();

        // session
        session()->flash('success', 'Standar berhasil dihapus');
    }

    // rules
    protected $rules = [
        'unitIds' => 'required|array',
        'indicatorId' => 'required',
    ];

    // message
    protected $messages = [
        'unitIds.required' => 'Unit harus dipilih',
        'indicatorId.required' => 'Standar harus dipilih',
    ];
}
