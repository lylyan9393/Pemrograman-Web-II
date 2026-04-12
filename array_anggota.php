<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array Data Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4"><i class="bi bi-book"></i> Array Data Anggota Perpustakaan</h1>

        <?php
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

        function badge_status($status) {
            $warna = "info";

            switch ($status) {
                case "Aktif":
                    $warna = "success";
                    break;
                case "Non-Aktif":
                    $warna = "secondary";
                    break;
            }
            return "<span class='badge bg-$warna'>$status</span>";
        }

        function hitung_status($anggota_list, $status) {
            $jumlah = 0;

            foreach ($anggota_list as $anggota) {
                if ($anggota['status'] == $status) {
                    $jumlah++;
                }
            }
            return $jumlah;
        }

        function cari_anggota_pinjam_terbanyak($anggota_list) {
            $hasil = [];
            foreach ($anggota_list as $anggota) {
                if ($anggota["stok"] > 5) {
                    $hasil[] = $anggota;
                }
            }
            return $hasil;
        }

        function filter_anggota($anggota_list, $status) {
            $hasil = [];
            foreach ($anggota_list as $anggota) {
                if ($anggota["status"] == $status) {
                    $hasil[] = $anggota;
                }
            }
            return $hasil;
        }

        function hitung_persentase($anggota_list, $status) {
            $count = 0;
            foreach ($anggota_list as $anggota) { 
                if ($anggota['status'] == $status) {
                    $count++; 
                }
            }
            return ($count / count($anggota_list)) * 100;
        }

        function hitung_rata_rata($anggota_list) {
            $total = 0;
            foreach ($anggota_list as $anggota) {
                $total += $anggota['total_pinjaman']; 
            }
            return $total / count($anggota_list);
        }

        function anggota_teraktif($anggota_list) {
            $max = $anggota_list[0];

            foreach ($anggota_list as $anggota) {
                if ($anggota['total_pinjaman'] > $max['total_pinjaman']) {
                    $max = $anggota;
                }
            }
            return $max;
        }
        $teraktif = anggota_teraktif($anggota_list);
        ?>

        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Daftar Semua Anggota</h5>
            </div>
            <div class="card-body">
                <p><strong>Total Anggota:</strong> <?php echo count($anggota_list); ?> anggota</p>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Id Anggota</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th>Tanggal Daftar</th>
                                <th>Status Keanggotaan</th>
                                <th>Total Pinjaman</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($anggota_list as $anggota): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><code><?php echo $anggota["id"]; ?></code></td>
                                <td><?php echo $anggota["nama"]; ?></td>
                                <td><?php echo $anggota["email"]; ?></td>
                                <td><?php echo $anggota["telepon"]; ?></td>
                                <td><?php echo $anggota["alamat"]; ?></td>
                                <td><?php echo $anggota["tanggal_daftar"]; ?></td>
                                <td><?php echo badge_status($anggota["status"]); ?></td>
                                <td><?php echo $anggota["total_pinjaman"]; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-danger text-white">Statistik</div>
                <div class="card-body">
                    <div class="row text-center">

                        <div class="col-md-3">
                            <div class="card border-primary p-3">
                                <h6>Total Anggota</h6>
                                <h3><?= count($anggota_list) ?></h3>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card border-success p-3">
                                <h6>Aktif (%)</h6>
                                <h3><?= number_format(hitung_persentase($anggota_list,"Aktif"),1) ?>%</h3>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card border-secondary p-3">
                                <h6>Non-Aktif (%)</h6>
                                <h3><?= number_format(hitung_persentase($anggota_list,"Non-Aktif"),1) ?>%</h3>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card border-warning p-3">
                                <h6>Rata-rata Pinjam</h6>
                                <h3><?= number_format(hitung_rata_rata($anggota_list),1) ?></h3>
                            </div>
                        </div>

                    </div>

                    <div class="row mt-3 text-center">
                        <div class="col-md-6">
                            <div class="card border-success p-3">
                                <h6>Anggota Teraktif</h6>
                                <h4><?= $teraktif['nama'] ?></h4>
                                <small><?= $teraktif['total_pinjaman'] ?> pinjaman</small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card border-dark p-3">
                                <h6>Jumlah Aktif vs Non</h6>
                                <h5>
                                    <?= hitung_status($anggota_list,"Aktif") ?> Aktif /
                                    <?= hitung_status($anggota_list,"Non-Aktif") ?> Non
                                </h5>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- FILTER -->
            <div class="card mb-4">
                <div class="card-header bg-warning">Filter Status</div>
                <div class="card-body">

                    <h6>Anggota Aktif (<?= count(filter_anggota($anggota_list,"Aktif")) ?>)</h6>
                    <ul>
                        <?php foreach(filter_anggota($anggota_list,"Aktif") as $a): ?>
                            <li><?= $a['nama'] ?> (<?= $a['total_pinjaman'] ?> pinjaman)</li>
                        <?php endforeach; ?>
                    </ul>

                    <h6>Anggota Non-Aktif (<?= count(filter_anggota($anggota_list,"Non-Aktif")) ?>)</h6>
                    <ul>
                        <?php foreach(filter_anggota($anggota_list,"Non-Aktif") as $a): ?>
                            <li><?= $a['nama'] ?> (<?= $a['total_pinjaman'] ?> pinjaman)</li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
