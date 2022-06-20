<a href="{{ $urlBack }}"><i class="fas fa-angle-left"></i> Kembali</a>
<div class="card mt-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <p class="text-sm text-muted mb-0">Audit</p>
                <h6 class="fw-semibold mb-0">{{ $audit->name }}</h6>
            </div>
            <div class="col-md-3">
                <p class="text-sm text-muted mb-0">Semester</p>
                <h6 class="fw-semibold mb-0">{{ $audit->semester }}</h6>
            </div>
            <div class="col-md-4">
                <p class="text-sm text-muted mb-0">Tahun Akademik</p>
                <h6 class="fw-semibold mb-0">{{ $audit->thn_akademik }}</h6>
            </div>
        </div>
    </div>
</div>
