<?php

// function tanggal format indonesia bersama hari
function tanggal_indo($tanggal, $cetak_hari = false)
{
    if($tanggal == null) {
        return '';
    }
    
    $hari = array ( 1 =>    'Senin',
                'Selasa',
                'Rabu',
                'Kamis',
                'Jumat',
                'Sabtu',
                'Minggu'
            );
            
    $bulan = array (1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
    $split    = explode('-', $tanggal);

    if(isset($split[2])) {
        $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
    } else {
        $tgl_indo = $bulan[ (int)$split[0] ] . ' ' . $split[1];
    }
    
    if ($cetak_hari) {
        $num = date('N', strtotime($tanggal));
        return $hari[$num] . ', ' . $tgl_indo;
    }
    return $tgl_indo;
}

function hariTanggal($datetime)
{
    return ($datetime) ? \Carbon\Carbon::parse($datetime)->isoFormat('dddd, D MMMM Y') : '';
}

function formatWaktu($datetime)
{
    return ($datetime) ? \Carbon\Carbon::parse($datetime)->format('H:i')  : '';
    
}

