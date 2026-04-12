<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widht=device-width, initial-scale=1.0">
    <title>Status Peminjaman Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container mt-5 mb-5">
        <h1 class="mb-4 text-primary"><i class="bi bi-journal-bookmark-fiil"></i>Status Peminjaman Anggota</h1>

        <?php
        // data anggota
        $nama_anggota = "Budi Santoso";
        $total_pinjaman = 2;
        $buku_terlambat = 1;
        $hari_keterlambatan = 5;

        // bussiness logic
        $denda_perhari = 1000;
        $total_denda = $buku_terlambat * $hari_keterlambatan * $denda_perhari;

        if ($total_denda > 50000) {
            $total_denda = 50000;
        }

        if ($buku_terlambat > 0) {
            $boleh_pinjam = false;
            $pesan_status = "Peminjaman ditangguhkan karena ada buku yang terlambat.";
        } elseif ($total_pinjaman >= 3) {
            $boleh_pinjam = false;
            $pesan_status = "Batas maksimal peminjaman 3 buku.";
        } else {
            $boleh_pinjam = true;
            $pesan_status = "Anggota diperbolehkan menambah pinjaman buku.";
        }

        if ($total_pinjaman <= 5) {
            $kategori = "Bronze";
        } elseif ($total_pinjaman <= 15) {
            $kategori = "Silver";
        } else {
            $kategori = "Gold";
        }

        switch ($kategori) {
            case "Bronze":
                $warna_kategori = "secondary";
                break;
            case "Silver":
                $warna_kategori = "info";
                break;
            default:
                $warna_kategori = "warning";
                break;
        }
        ?>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-person-badge"></i> Data Informasi Anggota</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover mb-0">
                    <tr>
                        <th width="250">Nama Anggota</th>
                        <td>: <?php echo $nama_anggota; ?></td>
                    </tr>
                    <tr>
                        <th>Level Keanggotaan</th>
                        <td>: <?php echo $kategori; ?> (Total: <?php echo $total_pinjaman; ?>X pinjam)</td>
                    </tr>
                    <tr>
                        <th>Buku Sedang Dipinjam</th>
                        <td>: <?php echo $total_pinjaman; ?> Buku</td>
                    </tr>
                </table>
            </div>
        </div>

        <?php if ($boleh_pinjam): ?>
            <div class="alert alert-success d-flex align-items-center">
                <i class="bi bi-check-circle-fill me-3 fs-3"></i>
                <div>
                    <h5 class="alert-heading mb-1">Status: AKTIF</h5>
                    <p class="mb-0"><?php echo $pesan_status; ?></p>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-danger d-flex align-items-center">
                <i class="bi bi-exclamation-octagon-fill me-3 fs-3"></i>
                <div>
                    <h5 class="alert-heading mb-1">Status: TERBLOKIR</h5>
                    <p class="mb-0"><?php echo $pesan_status; ?></p>
                </div>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0"><i class="bi bi-list-check"></i> Detail Analisis Logika</h5>
            </div>
            <div class="card-body bg-light">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6><i class="bi bi-clock-history text-danger"></i> Keterlambatan</h6>
                                <hr>
                                <?php if ($buku_terlambat > 0): ?>
                                    <p class="text-danger mb-1 fw-bold">Ada <?php echo $buku_terlambat; ?> Buku telat</p>
                                    <small class="text-muted">Denda: Rp <?php echo number_format($total_denda, 0, ',', '.'); ?></small>
                                <?php else: ?>
                                    <p class="text-success mb-1 fw-bold small"><i class="bi bi-path-check"></i> Tidak ada Keterlambatan</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <h6><i class="bi bi-bookshelf text-info"></i> Kuota Pinjaman</h6>
                                <hr>
                                <h3 class="mb-0 <?php echo ($total_pinjaman >= 3) ? 'text-danger' : 'text-success'; ?>">
                                    <?php echo $total_pinjaman; ?> / 3
                                </h3>
                                <small class="text-muted">Maksimal 3 buku</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6><i class="bi bi-cash-stack text-warning"></i> Status Denda</h6>
                                <hr>
                                <?php if ($total_denda >= 50000): ?>
                                    <div class="badge bg-danger">Denda Maksimal</div>
                                    <p class="mb-1 mt-1">Rp 50.000</p>
                                <?php elseif ($total_denda > 0): ?>
                                    <p class="mb-0 fw-bold">RP <?php echo number_format($total_denda, 0, ',', '.'); ?></p>
                                    <small class="text-muted">Belum mencapai limit</small>
                                <?php else: ?>
                                    <p class="text-success fw-bold">Rp 0</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
