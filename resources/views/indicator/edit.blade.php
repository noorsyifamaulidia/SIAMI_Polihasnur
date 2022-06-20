<form action="{{ route('indicator.update', $indicator->id) }}" method="POST">
  @csrf
  @method('PUT')
  <div class="form-group">
    <label><span class="text-danger">*</span> Nama</label>
    <input type="text" class="form-control" name="name" value="{{ $indicator->name }}" required>
  </div>
  <button class="btn btn-info btn-block">Simpan</button>
</form>