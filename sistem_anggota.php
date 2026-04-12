<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Anggota Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <?php
    // Include functions
    require_once 'functions_anggota.php';
    
    // Data anggota
    $anggota_list = [
        [
            "id" => "AGT-001",
            "nama" => "Budi Santoso",
            "email" => "budi@email.com",
            "telepon" => "081234567890",
            "alamat" => "Jakarta",
            "tanggal_daftar" => "2024-01-15",
            "status" => "Aktif",
            "total_pinjaman" => 5
        ],
        [
            "id" => "AGT-002",
            "nama" => "Lintang Tsaniatu Azzahro",
            "email" => "lintang@email.com",
            "telepon" => "087719898775",
            "alamat" => "Batang",
            "tanggal_daftar" => "2022-01-19",
            "status" => "Aktif",
            "total_pinjaman" => 10
        ],
        [
            "id" => "AGT-003",
            "nama" => "Nilna Salsabila",
            "email" => "nilna@email.com",
            "telepon" => "085563786657",
            "alamat" => "Moga",
            "tanggal_daftar" => "2023-06-20",
            "status" => "Non-Aktif",
            "total_pinjaman" => 4
        ],
        [
            "id" => "AGT-004",
            "nama" => "Nur Hidayah",
            "email" => "hidayah@email.com",
            "telepon" => "082357903347",
            "alamat" => "Pekalongan",
            "tanggal_daftar" => "2024-12-29",
            "status" => "Non-Aktif",
            "total_pinjaman" => 6
        ],
        [
            "id" => "AGT-005",
            "nama" => "Agil Azzahra Syari'ah",
            "email" => "agil@email.com",
            "telepon" => "082396751674",
            "alamat" => "Pekalongan",
            "tanggal_daftar" => "2021-09-23",
            "status" => "Aktif",
            "total_pinjaman" => 9
        ],
    ];

    // ambil data dari function
    $total = hitung_total_anggota($anggota_list);
    $aktif = hitung_anggota_aktif($anggota_list);
    $nonaktif = $total - $aktif;
    $rata = hitung_rata_rata_pinjaman($anggota_list);
    $teraktif = cari_anggota_teraktif($anggota_list);

    $list_aktif = filter_by_status($anggota_list, "Aktif");
    $list_nonaktif = filter_by_status($anggota_list, "Non-Aktif");
    $data_sort = sort_by_nama($anggota_list);
    $hasil_search = search_by_nama($anggota_list, "lintang");
    ?>
    
    <div class="container mt-5">
        <h1 class="mb-4"><i class="bi bi-people"></i> Sistem Anggota Perpustakaan</h1>
        
        <!-- Dashboard Statistik -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-center border-primary">
                    <div class="card-body">
                        <h6>Total Anggota</h6>
                        <h3><?= $total ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center border-success">
                    <div class="card-body">
                        <h6>Anggota Aktif</h6>
                        <h3><?= $aktif ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center border-secondary">
                    <div class="card-body">
                        <h6>Non-Aktif</h6>
                        <h3><?= $nonaktif ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center border-warning">
                    <div class="card-body">
                        <h6>Rata-rata Pinjaman</h6>
                        <h3><?= number_format($rata,1) ?></h3>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tabel Anggota -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Daftar Anggota</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Total Pinjaman</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach($anggota_list as $a): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $a['id'] ?></td>
                            <td><?= $a['nama'] ?></td>
                            <td><?= $a['email'] ?></td>
                            <td>
                                <span class="badge bg-<?= ($a['status']=="Aktif")?"success":"secondary" ?>">
                                    <?= $a['status'] ?>
                                </span>
                            </td>
                            <td><?= $a['total_pinjaman'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Anggota Teraktif -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Anggota Teraktif</h5>
            </div>
            <div class="card-body text-center">
                <h4><?= $teraktif['nama'] ?></h4>
                <p>ID: <?= $teraktif['id'] ?></p>
                <p>Total Pinjaman: <?= $teraktif['total_pinjaman'] ?></p>
            </div>
        </div>

        <!-- Daftar Aktif & Non Aktif -->
        <div class="card">
            <div class="card-header bg-warning">
                <h5 class="mb-0">Daftar Berdasarkan Status</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Anggota Aktif (<?= count($list_aktif) ?>)</h6>
                        <ul>
                            <?php foreach($list_aktif as $a): ?>
                                <li><?= $a['nama'] ?> (<?= $a['total_pinjaman'] ?>)</li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>Anggota Non-Aktif (<?= count($list_nonaktif) ?>)</h6>
                        <ul>
                            <?php foreach($list_nonaktif as $a): ?>
                                <li><?= $a['nama'] ?> (<?= $a['total_pinjaman'] ?>)</li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">

    <div class="card mb-4">
        <div class="card-header bg-info text-white">
            Data Anggota (Urut Nama A-Z)
        </div>
        <div class="card-body">
            <ul>
            <?php foreach($data_sort as $a): ?>
                <li><?= $a['nama'] ?></li>
            <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-dark text-white">
            Hasil Pencarian: "lintang"
        </div>
        <div class="card-body">
            <ul>
            <?php foreach($hasil_search as $a): ?>
                <li><?= $a['nama'] ?></li>
            <?php endforeach; ?>
            </ul>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>