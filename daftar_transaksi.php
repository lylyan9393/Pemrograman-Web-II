<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widht=device-width, initial-scale=1.0">
    <title>Daftar Transaksi Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="cotainer mt-5">
        <h1 class="mb-4">Daftar Transaksi Peminjaman</h1>

        <?php
        // todo: hitung statistik dengan loop
        $total_transaksi = 0;
        $total_pinjam = 0;
        $total_dikembalikan = 0;

        //todo: loop pertama untuk hitung statistik
        for ($i=1; $i <= 10 ; $i++) { 
            if ($i == 8) {
                        break;
                    }

            if ($i % 2 == 0) {
                        continue;
                    }

            $total_transaksi++;

            if ($i % 3 == 0) {
                $total_dikembalikan++;
            } else {
                $total_pinjam++;
            }
        }
        ?>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card bg-light border-primary shadow-sm">
                    <div class="card-body text-center">
                        <h6>Total Transaksi</h6>
                        <h2 class="text-primary"><?php echo $total_transaksi; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-light border-warning shadow-sm">
                    <div class="card-body text-center">
                        <h6>Masih Dipinjam</h6>
                        <h2 class="text-warning"><?php echo $total_pinjam; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-light border-success shadow-sm">
                    <div class="card-body text-center">
                        <h6>Sudah Kembali</h6>
                        <h2 class="text-success"><?php echo $total_dikembalikan; ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- todo: tampilkan statistik dalam cards -->
        
        <!-- todo: tampilkan tabel transaksi -->
        <table class="table table-bordered shadow-sm">
            <thead class="table-secondary text-center">
                <tr>
                    <th>No</th>
                    <th>ID Transaksi</th>
                    <th>Peminjam</th>
                    <th>Buku</th>
                    <th>tgl Pinjam</th>
                    <th>tgl Kembali</th>
                    <th>Hari</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //todo: loop untuk tampilan data
                // gunakan continue untuk skip genap
                // gunakan break untuk stop di transaksi 8

                $nomor_tabel = 1;

                for ($i=1; $i <= 10 ; $i++) { 
                    if ($i == 8) {
                        break;
                    }

                    if ($i % 2 == 0) {
                        continue;
                    }

                    $id_transaksi = "TRX-" . str_pad($i, 4, "0", STR_PAD_LEFT);
                    $nama_peminjam = "Anggota " .$i;
                    $judul_buku = "Buku Teknologi VOl. " . $i;

                    $tgl_pinjam = date('Y-m-d', strtotime("-$i days"));
                    $tgl_kembali = date('Y-m-d', strtotime("+7 days", strtotime($tgl_pinjam)));

                    $detik_pinjam = strtotime($tgl_pinjam);
                    $detik_sekarang = time();
                    $selisih_detik = $detik_sekarang - $detik_pinjam;
                    $hari = floor($selisih_detik / (60 * 60 * 24));

                    if ($i % 3 == 0) {
                        $status_text = "Dikembalikan";
                        $warna_badge = "bg-success";
                    } else {
                        $status_text = "Dipinjam";
                        $warna_badge = "bg-warning text-dark";
                    }
                ?>

                    <tr>
                        <td class="text-center"><?php echo $nomor_tabel; ?></td>
                        <td><strong><?php echo $id_transaksi; ?></strong></td>
                        <td><?php echo $nama_peminjam; ?></td>
                        <td><?php echo $judul_buku; ?></td>
                        <td><?php echo $tgl_pinjam; ?></td>
                        <td><?php echo $tgl_kembali; ?></td>
                        <td class="text-center"><?php echo $hari; ?> Hari</td>
                        <td class="text-center">
                            <span class="badge <?php echo $warna_badge; ?>">
                                <?php echo $status_text; ?>
                            </span>
                        </td>
                    </tr>
                <?php
                    $nomor_tabel++;
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
