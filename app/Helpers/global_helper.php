<?php

use App\Models\MSetting;

function tanggal_indo($source_date)
{
    $d = strtotime($source_date);

    $year = date('Y', $d);
    $month = date('n', $d);
    $day = date('d', $d);
    $day_name = date('D', $d);

    $day_names = array(
        'Sun' => 'Minggu',
        'Mon' => 'Senin',
        'Tue' => 'Selasa',
        'Wed' => 'Rabu',
        'Thu' => 'Kamis',
        'Fri' => 'Jum\'at',
        'Sat' => 'Sabtu'
    );
    $month_names = array(
        '1' => 'Januari',
        '2' => 'Februari',
        '3' => 'Maret',
        '4' => 'April',
        '5' => 'Mei',
        '6' => 'Juni',
        '7' => 'Juli',
        '8' => 'Agustus',
        '9' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember'
    );
    $day_name = $day_names[$day_name];
    $month_name = $month_names[$month];

    $date = "$day_name, $day $month_name $year";

    return $date;
}


function get_setting()
{
    $setting = new MSetting();
    $data = $setting->first();
    $result = [
        'nama' => 'SMP Negri',
        'slogan' => 'Sekolah terbaik',
        'img' => 'logo.png'
    ];

    if ($data != null) {
        $result = [
            'nama' => $data['nama'],
            'slogan' => $data['slogan'],
            'img' => $data['logo']
        ];
    }

    return $result;
}

function tambah_waktu($waktu, $menit)
{
    return date("H:i", strtotime($waktu . " +$menit minutes"));
}

function jam_ke()
{
    $waktu_mulai = "07:00"; // Jam mulai sekolah
    $durasi_pelajaran = 45; // Durasi tiap pelajaran dalam menit
    $durasi_istirahat = 15; // Durasi istirahat dalam menit
    $jumlah_pelajaran = 8; // Total jam pelajaran per hari

    // Waktu istirahat (misalnya setelah jam ke-2 dan jam ke-5)
    $istirahat_setelah = [2, 5];

    // Waktu salat jika ada (misalnya setelah jam ke-6)
    $salat_setelah = 6;

    // Fungsi untuk menambah waktu dalam format jam:menit


    // Mulai generate jadwal
    $jadwal_jam = [];
    $waktu_sekarang = $waktu_mulai;
    for ($i = 1; $i <= $jumlah_pelajaran; $i++) {
        $jadwal_jam[] = ["jam" => $i, "waktu" => "$waktu_sekarang - " . tambah_waktu($waktu_sekarang, $durasi_pelajaran)];
        $waktu_sekarang = tambah_waktu($waktu_sekarang, $durasi_pelajaran);

        // Tambah waktu istirahat jika sesuai jadwal
        if (in_array($i, $istirahat_setelah)) {
            $jadwal_jam[] = ["istirahat" => true, "waktu" => "$waktu_sekarang - " . tambah_waktu($waktu_sekarang, $durasi_istirahat)];
            $waktu_sekarang = tambah_waktu($waktu_sekarang, $durasi_istirahat);
        }

        // Tambah waktu salat jika sesuai jadwal
        if ($i == $salat_setelah) {
            $jadwal_jam[] = ["salat" => true, "waktu" => "$waktu_sekarang - " . tambah_waktu($waktu_sekarang, 45)];
            $waktu_sekarang = tambah_waktu($waktu_sekarang, 45);
        }
    }
    return $jadwal_jam;
}

function get_jamke($jamke)
{
    $waktu = '';
    foreach (jam_ke() as $value) {
        if (isset($value['jam']) && $value['jam'] == $jamke) {
            $waktu = $value['waktu'];
        }
    }
    return $waktu;
}

function enkripsi($id)
{
    $encrypter = \Config\Services::encrypter();
    return bin2hex($encrypter->encrypt($id));
}

function dekrip($id)
{
    $encrypter = \Config\Services::encrypter();
    return $encrypter->decrypt(hex2bin($id));
}

function range_nilai($nilai)
{
    if ($nilai >= 90) {
        $abjad = 'A';
    } else if ($nilai >= 80) {
        $abjad = 'B';
    } else if ($nilai >= 70) {
        $abjad = 'C';
    } else if ($nilai >= 60) {
        $abjad = 'D';
    } else {
        $abjad = 'E';
    }
    return $abjad;
}

function predikat_nilai($nilai)
{
    if ($nilai >= 90) {
        $predikat_badge = '<span class="badge badge-success">Sangat Baik</span>';
        $predikat = 'Sangat Baik';
    } else if ($nilai >= 80) {
        $predikat_badge = '<span class="badge badge-info">Baik</span>';
        $predikat = 'Baik';
    } else if ($nilai >= 70) {
        $predikat_badge = '<span class="badge badge-info">Cukup</span>';
        $predikat = 'Cukup';
    } else if ($nilai >= 60) {
        $predikat_badge = '<span class="badge badge-warning">Sedang</span>';
        $predikat = 'Sedang';
    } else {
        $predikat_badge = '<span class="badge badge-danger">Kurang</span>';
        $predikat = 'Kurang';
    }
    $data = [
        'predikat' => $predikat,
        'predikat_bagde' => $predikat_badge
    ];
    return $data;
}

function nilai_akhir($tugas, $uts, $uas)
{
    $nilai = ($tugas * 0.4) + ($uts * 0.3) + ($uas * 0.3);
    return $nilai;
}
