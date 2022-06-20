@extends('layouts.app')
@section('content')
<div>
  @push('after-styles')
      <link rel="stylesheet" href="{{ asset('css/toggle.css') }}">
  @endpush
  <div class="card">
      <div class="card-header">
        <h6 class="mb-0">Data Pengguna</h6>
      </div>
      <div class="card-body">
        <x-alert />
        <form class="mb-3">
          <div class="row">
            <div class="col-md-4">
              <div class="custom-search">
                <i class="fas fa-search"></i>
                <input type="text" class="form-control" name="q" placeholder="Pencarian..." value="{{ @$_GET['q'] }}">
              </div>
            </div>
          </div>
        </form>
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th width="10">#</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($users as $user)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $user->username }}</td>
                  <td>{{ $user->name }}</td>
                  <td>
                      <div class="d-flex">
                          <button type="button" class="btn btn-toggle {{ ($user->is_active) ? 'active' : '' }} mr-2" data-toggle="button" aria-pressed="{{ ($user->is_active) ? true : false }}" autocomplete="off">
                              <div class="handle"></div>
                          </button>
                          @if ($user->is_active)
                              <span class="font-weight-semibold">Active</span>
                          @else
                              <span class="font-weight-semibold">Non Active</span>
                          @endif
                      </div>
                  </td>
                  <td>
                  <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data?')"><i class="fas fa-trash"></i></button>
                    <button class="btn btn-success btn-sm" 
                      data-title="Edit Unit" 
                      data-toggle="modal" 
                      data-target="#show-modal"
                    ><i class="fas fa-edit"></i></button>
                  </td>
                </tr>
              @empty
                  <tr>
                    <td colspan="5" align="center">-tidak ada data-</td>
                  </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        {{ $users->links() }}
      </div>
  </div>
</div>
@endsection