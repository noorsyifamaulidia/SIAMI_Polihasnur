@include('report.header', [
    'title' => 'LAPORAN HASIL TEMUAN AUDIT PELAKSANAAN SPMI POLITEKNIK HASNUR',
])
@include('audit.room.temuan._head', [
    'data' => $temuan,
    'title' => 'FORM DESKRIPSI TEMUAN AUDIT',
])
@include('audit.room.temuan._view')
