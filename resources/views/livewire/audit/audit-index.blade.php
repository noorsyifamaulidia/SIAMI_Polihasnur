<div>
    @push('after-styles')
        <link rel="stylesheet" href="{{ asset('css/toggle.css') }}">
    @endpush
    <div class="card">
        <div class="card-header border-0 d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Data Ruang Lingkup Audit</h6>
            <button class="btn btn-primary" data-toggle="modal" data-target=".modalOpen" wire:click="add">Tambah</button>
        </div>
        <div class="card-body pt-0">
            <x-alert />
            <div class="table-responsive">
                <table class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th width="10">#</th>
                            <th>Nama</th>
                            <th>Semester</th>
                            <th>Tahun Akademik</th>
                            <th>Pelaksanaan</th>
                            <th>Jadwal Evaluasi</th>
                            <th>Publish</th>
                            <th>Pengelolaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($audits as $audit)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $audit->name }}</td>
                                <td>{{ $audit->semester }}</td>
                                <td>{{ $audit->thn_akademik }}</td>
                                <td>{{ tanggal_indo($audit->start) }} - {{ tanggal_indo($audit->end) }}</td>
                                <td>{{ hariTanggal($audit->jadwal_evaluasi) }}
                                    {{ formatWaktu($audit->jadwal_evaluasi) }} WITA</td>
                                <td>
                                    <button type="button" wire:click="setActive({{ $audit->id }})"
                                        class="btn btn-toggle mr-3 {{ $audit->is_active ? 'active' : '' }}"
                                        data-toggle="button"
                                        @if ($audit->is_active == true) aria-pressed="true"
                                        @else
                                        aria-pressed="false" @endif
                                        autocomplete="off">
                                        <div class="handle"></div>
                                    </button>
                                    @if ($audit->is_active)
                                        <span class="font-weight-semibold">Active</span>
                                    @else
                                        <span class="font-weight-semibold">Non Active</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('audit.unit', $audit->id) }}" class="btn btn-info btn-sm"
                                        data-toggle="tooltip" title="Auditee/Unit"><i class="fas fa-sitemap"></i></a>
                                    <a href="{{ route('audit.standar', $audit->id) }}" class="btn btn-success btn-sm"
                                        data-toggle="tooltip" title="Standar/Indikator"><i
                                            class="fas fa-list-ol"></i></a>
                                    <a href="{{ route('audit.jadwal', $audit->id) }}" class="btn btn-primary btn-sm"
                                        data-toggle="tooltip" title="Jadwal Audit"><i
                                            class="far fa-calendar-alt"></i></a>
                                    <a href="{{ route('audit.auditor', $audit->id) }}" class="btn btn-warning btn-sm"
                                        data-toggle="tooltip" title="Auditor"><i class="fas fa-user-tie"></i></a>
                                    <a href="{{ route('audit.responsible', $audit->id) }}"
                                        class="btn btn-dark btn-sm" data-toggle="tooltip" title="Pimpinan Auditi"><i
                                            class="fas fa-user-shield"></i></a>
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm"
                                        onclick="confirm('Anda yakin ingin menghapus data audit?') || event.stopImmediatePropagation()"
                                        wire:click="destroy({{ $audit->id }})"><i
                                            class="fas fa-trash"></i></button>
                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target=".modalOpen"
                                        wire:click="edit({{ $audit->id }})"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" align="center">-tidak ada data-</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <x-pagination :paginator="$audits" />
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade modalOpen" tabindex="-1" role="dialog" aria-labelledby="add"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">{{ $modalTitle }}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($statusAdd)
                        <x-alert-modal />
                    @endif
                    <form wire:submit.prevent="{{ $statusEdit ? 'update' : 'store' }}">
                        <div class="form-group">
                            <label><span class="text-danger">*</span> Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                wire:model="name" placeholder="Nama">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label><span class="text-danger">*</span> Semester</label>
                            <div class="form-group d-flex align-items-center">
                                <div class="custom-control custom-radio mr-3">
                                    <input class="custom-control-input" type="radio" id="semester1" name="semester"
                                        wire:model="semester" value="Ganjil">
                                    <label for="semester1" class="custom-control-label">Ganjil</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="semester2" name="semester"
                                        wire:model="semester" value="Genap">
                                    <label for="semester2" class="custom-control-label">Genap</label>
                                </div>
                            </div>
                            @error('semester')
                                <span class="text-danger text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label><span class="text-danger">*</span> Tahun Akademik</label>
                            <input type="text" class="form-control @error('thn_akademik') is-invalid @enderror"
                                wire:model="thn_akademik" placeholder="cth. 2020/2021">
                            @error('thn_akademik')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label><span class="text-danger">*</span> Tanggal Mulai</label>
                                <input type="date" class="form-control @error('start') is-invalid @enderror"
                                    wire:model="start" placeholder="cth. 2020/2021">
                                @error('start')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label><span class="text-danger">*</span> Tanggal Berakhir</label>
                                <input type="date" class="form-control @error('end') is-invalid @enderror"
                                    wire:model="end" placeholder="cth. 2020/2021">
                                @error('end')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="border rounded p-3 mb-3">
                            <p>Jadwal Evaluasi:</p>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>Tanggal</label>
                                    <input type="date"
                                        class="form-control @error('tanggal_evaluasi') is-invalid @enderror"
                                        wire:model="tanggal_evaluasi">
                                    @error('tanggal_evaluasi')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Waktu (WITA)</label>
                                    <input type="time"
                                        class="form-control @error('waktu_evaluasi') is-invalid @enderror"
                                        wire:model="waktu_evaluasi">
                                    @error('waktu_evaluasi')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-info btn-block">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('after-scripts')
        <script>
            // if emmit auditUpdated modal is hide
            window.livewire.on('auditUpdated', () => {
                $('.modalOpen').modal('hide');
            });
        </script>
    @endpush

</div>
