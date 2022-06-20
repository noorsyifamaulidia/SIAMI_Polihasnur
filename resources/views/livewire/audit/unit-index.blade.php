<div>
    <x-audit-head :audit=$audit :urlBack="route('audit.index')" />

    <x-audit-pengelolaan :audit=$audit menu="unit">
    <form wire:submit.prevent="store">
    <div class="row mb-3">
        <div class="col-md-4 mb-2 mb-md-0">
            <select class="form-control" wire:model="unitId">
                <option value="">-Pilih Unit-</option>
                @foreach ($units as $unit)
                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                @endforeach
            </select>
            @error('unitId')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-4 mb-2 mb-md-0">
            <select class="form-control" wire:model="userId">
                <option value="">-Pilih Kepala Unit-</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('userId')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-3">
            <button class="btn btn-info"><i class="fas fa-plus-circle"></i> Tambah</button>
        </div>
    </div>
    </form>

    <x-alert />

    <div class="table-responsive">
        <table class="table striped table-bordered">
            <thead>
                <tr>
                    <th width="10">#</th>
                    <th>Nama Unit</th>
                    <th>Kepala Unit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($auditees as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $d->unit->name }}</td>
                        <td>{{ $d->user->name }}</td>
                        <td>
                            <button class="btn btn-danger btn-sm" onclick="confirm('Anda yakin ingin menghapus pengguna?') || event.stopImmediatePropagation()" wire:click="destroy({{ $d->id }})"><i class="fas fa-trash"></i></button>
                            <button class="btn btn-success btn-sm" 
                                data-toggle="modal" 
                                data-target="#unit-edit"
                                wire:click="edit({{ $d->id }})"
                            ><i class="fas fa-edit"></i></button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" align="center">-tidak ada data-</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-audit-pengelolaan>

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="unit-edit" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Edit</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="update">
                    <div class="form-group">
                        <label><span class="text-danger">*</span> Unit</label>
                        <select class="form-control" wire:model="unitId">
                            <option value="">-Pilih Unit-</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                            @endforeach
                        </select>
                        @error('unitId')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label><span class="text-danger">*</span> Kepala Unit</label>
                        <select class="form-control" wire:model="userId">
                            <option value="">-Pilih Kepala Unit-</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('userId')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button class="btn btn-info btn-block">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('after-scripts')
    <script>
        // if emmit unitUpdated modal is hide
        window.livewire.on('unitUpdated', () => {
            $('#unit-edit').modal('hide');
        });
    </script>
@endpush

</div>
