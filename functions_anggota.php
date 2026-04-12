<?php
// 1. Function untuk hitung total anggota
function hitung_total_anggota($anggota_list) {
    return count($anggota_list);
}
 
// 2. Function untuk hitung anggota aktif
function hitung_anggota_aktif($anggota_list) {
    $jumlah = 0;
    foreach ($anggota_list as $anggota) {
        if ($anggota['status'] == "Aktif") {
            $jumlah++;
        }
    }
    return $jumlah;
}
 
// 3. Function untuk hitung rata-rata pinjaman
function hitung_rata_rata_pinjaman($anggota_list) {
    $total = 0;
    foreach ($anggota_list as $anggota) {
        $total += $anggota['total_pinjaman'];
    }
    return $total / count($anggota_list);
}
 
// 4. Function untuk cari anggota by ID
function cari_anggota_by_ID($anggota_list, $id) {
    foreach ($anggota_list as $anggota) {
        if ($anggota["id"] == $id) {
            return $anggota;
        }
    }
    return null;
}
 
// 5. Function untuk cari anggota teraktif
function cari_anggota_teraktif($anggota_list) {
    $teraktif = $anggota_list[0];
    foreach ($anggota_list as $anggota) {
        if ($anggota['total_pinjaman'] > $teraktif['total_pinjaman']) {
            $teraktif = $anggota;
        }
    }
    return $teraktif;
}
 
// 6. Function untuk filter by status
function filter_by_status($anggota_list, $status) {
    $hasil = [];
    foreach ($anggota_list as $anggota) {
        if ($anggota['status'] == $status) {
            $hasil[] = $anggota;
        }
    }
    return $hasil;
}
 
// 7. Function untuk validasi email
function validasi_email($email) {
    if (empty($email)) {
        return false;
    }
    if (strpos($email, '@') === false) {
        return false;
    }
    if (strpos($email, '.') === false) {
        return false;
    }
    return true;
}
 
// 8. Function untuk format tanggal Indonesia
function format_tanggal_indo($tanggal) {
    $bulan = [
        "01" => "Januari",
        "02" => "Februari",
        "03" => "Maret",
        "04" => "April",
        "05" => "Mei",
        "06" => "Juni",
        "07" => "Juli",
        "08" => "Agustus",
        "09" => "September",
        "10" => "Oktober",
        "11" => "November",
        "12" => "Desember"
    ];

    $pecah = explode("-", $tanggal);
    $tahun = $pecah[0];
    $bulan_angka = $pecah[1];
    $hari = $pecah[2];

    return $hari . " " . $bulan[$bulan_angka] . " " . $tahun;
}

// Sort anggota by nama (A-Z)
function sort_by_nama($anggota_list) {
    usort($anggota_list, function($a, $b) {
        return strcmp($a['nama'], $b['nama']);
    });
    return $anggota_list;
}

// Search anggota by nama (partial match)
function search_by_nama($anggota_list, $keyword) {
    $hasil = [];
    foreach ($anggota_list as $anggota) {
        if (stripos($anggota['nama'], $keyword) !== false) {
            $hasil[] = $anggota;
        }
    }
    return $hasil;
}
?>