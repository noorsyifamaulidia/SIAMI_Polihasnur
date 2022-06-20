@extends('layouts.audit')
@section('content')
    @include('includes.function.ckeditor')
    @include('includes.back-to-dashboard')

    <div class="card">
        <div class="card-body">
            <x-alert />
            <form action="{{ route('audit.room.jadwal_visitasi', $service['audit']->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Tanggal Visitasi</label>
                    <input name="tanggal_visitasi" class="form-control datepicker" autocomplete="off"
                        value="{{ $service['audit']->tanggal_visitasi }}" placeholder="{{ date('Y-m-d') }}">
                    @error('tanggal_visitasi')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan_visitasi" class="form-control" id="" cols="30" rows="5">{{ $service['audit']->keterangan_visitasi }}</textarea>
                    @error('keterangan_visitasi')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="text-right">
                    <button class="btn btn-primary"><i class="fas fa-save mr-1"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
