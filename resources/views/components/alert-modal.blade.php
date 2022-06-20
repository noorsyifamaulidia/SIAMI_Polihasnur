@if (session('message'))
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <i class="fas fa-check-circle mr-2"></i>{{ session('message') }}
    </div>
@endif