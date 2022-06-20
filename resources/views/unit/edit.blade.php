<form action="{{ route('unit.update', $unit->id) }}" method="POST">
  @csrf
  @method('PUT')
  <div class="form-group">
    <label><span class="text-danger">*</span> Nama</label>
    <input type="text" class="form-control" name="name" value="{{ $unit->name }}" required>
  </div>
  <div class="form-group">
    <label><span class="text-danger">*</span> Keterangan</label>
    <input type="text" class="form-control" name="description" value="{{ $unit->description }}" required>
  </div>
  <button class="btn btn-info btn-block">Simpan</button>
</form>