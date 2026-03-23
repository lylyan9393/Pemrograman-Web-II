<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widht=device-width, initial-scale=1.0">
    <title>Sistem Perhitungan Diskon - Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Sistem Perhitungan Diskon Bertingkat</h1>

        <?php
        // TODO: isi data pembeli dan buku di sini
        $nama_pembeli = "Budi Santoso";
        $judul_buku = "Laravel Advanced";
        $harga_satuan = 150000;
        $jumlah_beli = 4;
        $is_member = true; // true atu false
        if ($is_member == true) {
            $is_member = "Member";
        } else {
            $is_member = "Non-Member";
        }

        // TODO: hitung subtotal
        $subtotal = $harga_satuan * $jumlah_beli; // lengkapi perhitungan

        // TODO: tentukan persentase diskon berdasarkan jumlah
        if ($jumlah_beli <= 2) {
            $persentase_diskon = 0;
        } elseif ($jumlah_beli <= 5) {
            $persentase_diskon = 10;
        } elseif ($jumlah_beli <= 10) {
            $persentase_diskon = 15;
        } else {
            $persentase_diskon = 20;
        }

        // TODO: hitung diskon
        $diskon = $subtotal * ($persentase_diskon / 100); // lengkapi perhitungan

        // TODO: total setelah diskon pertama
        $total_setelah_diskon1 = $subtotal - $diskon; // lengkapi

        // TODO: hitung diskon member jika member
        $diskon_member = 0;
        $nilai_diskon_member = 0;
        if ($is_member) {
            $diskon_member = 5;
            $nilai_diskon_member = $total_setelah_diskon1 * ($diskon_member / 100);
        }

        // TODO: total setelah semua diskon
        $total_setelah_diskon = $total_setelah_diskon1 - $nilai_diskon_member; // Lengkapi

        // TODO: Hitung PPN
        $ppn = $total_setelah_diskon * 0.11; // lengkapi

        // TODO: Total akhir
        $total_akhir = $total_setelah_diskon + $ppn; // lengkapi

        // TODO: total penghematan
        $total_hemat = $diskon + $nilai_diskon_member; // lengkapi
        ?>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Detail Pembelian</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th width="250">Nama Pembeli</th>
                                <td>: <?php echo $nama_pembeli; ?></td>
                            </tr>
                            <tr>
                                <th>Judul Buku</th>
                                <td>: <?php echo $judul_buku; ?></td>
                            </tr>
                            <tr>
                                <th>Harga Satuan</th>
                                <td>: Rp <?php echo number_format($harga_satuan, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <th>Jumlah Beli</th>
                                <td>: <?php echo $jumlah_beli; ?> buku</td>
                            </tr>
                            <tr>
                                <th>Member</th>
                                <td>: <?php echo $is_member; ?></td>
                            </tr>
                            <tr class="table-secondary">
                                <th>Subtotal</th>
                                <td>: Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                            </tr>
                            <tr class="text-success">
                                <th>Diskon (<?php echo $persentase_diskon; ?>%)</th>
                                <td>: -Rp <?php echo number_format($diskon, 0, ',', '.'); ?></td>
                            </tr>
                            <tr class="table-secondary">
                                <th>Total Setelah Diskon Pertama</th>
                                <td>: Rp <?php echo number_format($total_setelah_diskon1, 0, ',', '.'); ?></td>
                            </tr>
                            <tr class="text-success">
                                <th>Diskon Member(<?php echo $diskon_member; ?>%)</th>
                                <td>: -Rp <?php echo number_format($nilai_diskon_member, 0, ',', '.'); ?></td>
                            </tr>
                            <tr class="table-secondary">
                                <th>Total Setelah Diskon Kedua</th>
                                <td>: Rp <?php echo number_format($total_setelah_diskon, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <th>PPN 11%</th>
                                <td>: + Rp <?php echo number_format($ppn, 0, ',', '.'); ?></td>
                            </tr>
                            <tr class="table-primary fw-bold">
                                <th>Total Akhir</th>
                                <td>: Rp <?php echo number_format($total_akhir, 0, ',', '.'); ?></td>
                            </tr>
                        </table>

                        <?php if ($persentase_diskon > 0): ?>
                        <div class="alert alert-success">
                            <strong>Selamat!</strong> Anda mendapat diskon <?php echo $persentase_diskon; ?>% karena membeli <?php echo $jumlah_beli; ?> buku.
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-info">
                    <div class="card-header bg-info text-whitw">
                        <h6 class="mb-0">Informasi Diskon</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success"></i>
                                Beli 1-2 buku: Tidak Ada Diskon
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success"></i>
                                Beli 3-5 buku: Diskon 10%
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success"></i>
                                Beli 6-10 buku: Diskon 15%
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success"></i>
                                Beli lebih dari 10 buku: Diskon 20%
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-info"></i>
                                Semua harga sudah termasuk PPN
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card border-warning mt-3">
                    <div class="card-header bg-warning">
                        <h6 class="mb-0">Hemat Anda</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="text-success">
                            Rp <?php echo number_format($total_hemat, 0, ',', '.'); ?>
                        </h4>
                        <small class="badge bg-success">
                            dari harga normal Rp <?php echo number_format($subtotal, 0, ',', '.'); ?>
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <!-- TODO: Tampilkan hasil perhitungan dengan Bootstrap -->
        <!-- Gunakan card, table, dan badge --> 
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
