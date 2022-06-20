@include('report.header', [
    'title' => 'LAPORAN HASIL RINGKASAN TEMUAN PELAKSANAAN SPMI POLITEKNIK HASNUR',
])
@include('audit.room.temuan._head', [
    'data' => $ringkasan,
    'title' => 'FORM RINGKASAN TEMUAN AUDIT',
])
@include('audit.room.ringkasan._view')
