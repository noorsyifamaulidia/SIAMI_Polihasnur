@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Data Unit</h6>
                </div>
                <div class="card-body">
                    <x-alert />
                    <form class="mb-3">
                        <div class="row">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <div class="custom-search">
                                    <input type="text" class="form-control" name="q" placeholder="Pencarian..."
                                        value="{{ @$_GET['q'] }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-warning"><i class="fas fa-search mr-1"></i>Cari</button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="10">#</th>
                                    <th>Nama</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($units as $unit)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $unit->name }}</td>
                                        <td>{{ $unit->description }}</td>
                                        <td>
                                            <form action="{{ route('unit.destroy', $unit->id) }}" class="d-inline"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin menghapus data?')"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                            <button class="btn btn-success btn-sm" data-title="Edit Unit"
                                                data-url="{{ route('unit.edit', $unit->id) }}" data-toggle="modal"
                                                data-target="#show-modal"><i class="fas fa-edit"></i></button>
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
                    {{ $units->links() }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Tambah Unit</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('unit.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label><span class="text-danger">*</span> Nama</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label><span class="text-danger">*</span> Keterangan</label>
                            <input type="text" class="form-control" name="description" required>
                        </div>
                        <button class="btn btn-info btn-block">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('partials.modal')
@endsection
