<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widht=device-width, initial-scale=1.0">
    <title>Sistem Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Informasi Buku</h1>

        <?php 
        //Data Buku 
        $judul1 = "Laravel: From Beginner to Advanced";
        $judul2 = "Python Crash Course";
        $judul3 = "Sistem Basis Data dan SQL";
        $judul4 = "HTML & CSS";

        $pengarang1 = "Budi Raharjo";
        $pengarang2 = "Eric Matthews";
        $pengarang3 = "Didik Setiyadi";
        $pengarang4 = "Jon Ducket";

        $penerbit1 = "Informatika";
        $penerbit2 = "Gramedia";
        $penerbit3 = "Garuda Media";
        $penerbit4 = "Erlangga";

        $tahun_terbit1 = 2023;
        $tahun_terbit2 = 2020;
        $tahun_terbit3 = 2019;
        $tahun_terbit4 = 20025;

        $harga1 = 125000;
        $harga2 = 150000;
        $harga3 = 200000;
        $harga4 = 164000;

        $stok1 = 8;
        $stok2 = 10;
        $stok3 = 12;
        $stok4 = 6;

        $isbn1 = "978-602-1234-56-7";
        $isbn2 = "123-567-9874-09-8";
        $isbn3 = "567-345-2957-08-5";
        $isbn4 = "789-357-5763-04-2";

        $kategori_buku1 = "Programming";
        $kategori_buku2 = "Programming";
        $kategori_buku3 = "Database";
        $kategori_buku4 = "Web Design";

        $bahasa1 = "Inggris";
        $bahasa2 = "Inggris";
        $bahasa3 = "Indonesia";
        $bahasa4 = "Inggris";

        $jumlah_halaman1 = 134;
        $jumlah_halaman2 = 200;
        $jumlah_halaman3 = 115;
        $jumlah_halaman4 = 123;

        $berat_buku1 = 100;
        $berat_buku2 = 110;
        $berat_buku3 = 90;
        $berat_buku4 = 100;
        ?>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Buku 1</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th>Judul Buku</th>
                        <td>: <?php echo $judul1; ?></td>
                    </tr>
                    <tr>
                        <th width="200">Pengarang</th>
                        <td>: <?php echo $pengarang1; ?></td>
                    </tr>
                    <tr>
                        <th>Penerbit</th>
                        <td>: <?php echo $penerbit1; ?></td>
                    </tr>
                    <tr>
                        <th>Tahun Terbit</th>
                        <td>: <?php echo $tahun_terbit1; ?></td>
                    </tr>
                    <tr>
                        <th>ISBN</th>
                        <td>: <?php echo $isbn1; ?></td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>: RP <?php echo number_format($harga1, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td>: <?php echo $stok1; ?> buku</td>
                    </tr>
                    <tr>
                        <th>Kategori Buku</th>
                        <td class="badge bg-secondary">: <?php echo $kategori_buku1; ?></td>
                    </tr>
                    <tr>
                        <th>Bahasa</th>
                        <td>: <?php echo $bahasa1; ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah Halaman</th>
                        <td>: <?php echo $jumlah_halaman1; ?> halaman</td>
                    </tr>
                    <tr>
                        <th>Berat Buku</th>
                        <td>: <?php echo $berat_buku1; ?> gram</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Buku 2</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th>Judul Buku</th>
                        <td>: <?php echo $judul2; ?></td>
                    </tr>
                    <tr>
                        <th width="200">Pengarang</th>
                        <td>: <?php echo $pengarang2; ?></td>
                    </tr>
                    <tr>
                        <th>Penerbit</th>
                        <td>: <?php echo $penerbit2; ?></td>
                    </tr>
                    <tr>
                        <th>Tahun Terbit</th>
                        <td>: <?php echo $tahun_terbit2; ?></td>
                    </tr>
                    <tr>
                        <th>ISBN</th>
                        <td>: <?php echo $isbn2; ?></td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>: RP <?php echo number_format($harga2, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td>: <?php echo $stok2; ?> buku</td>
                    </tr>
                    <tr>
                        <th>Kategori Buku</th>
                        <td class="badge bg-secondary">: <?php echo $kategori_buku2; ?></td>
                    </tr>
                    <tr>
                        <th>Bahasa</th>
                        <td>: <?php echo $bahasa2; ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah Halaman</th>
                        <td>: <?php echo $jumlah_halaman2; ?> halaman</td>
                    </tr>
                    <tr>
                        <th>Berat Buku</th>
                        <td>: <?php echo $berat_buku2; ?> gram</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Buku 3</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th>Judul Buku</th>
                        <td>: <?php echo $judul3; ?></td>
                    </tr>
                    <tr>
                        <th width="200">Pengarang</th>
                        <td>: <?php echo $pengarang3; ?></td>
                    </tr>
                    <tr>
                        <th>Penerbit</th>
                        <td>: <?php echo $penerbit3; ?></td>
                    </tr>
                    <tr>
                        <th>Tahun Terbit</th>
                        <td>: <?php echo $tahun_terbit3; ?></td>
                    </tr>
                    <tr>
                        <th>ISBN</th>
                        <td>: <?php echo $isbn3; ?></td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>: RP <?php echo number_format($harga3, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td>: <?php echo $stok3; ?> buku</td>
                    </tr>
                    <tr>
                        <th>Kategori Buku</th>
                        <td class="badge bg-success">: <?php echo $kategori_buku3; ?></td>
                    </tr>
                    <tr>
                        <th>Bahasa</th>
                        <td>: <?php echo $bahasa3; ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah Halaman</th>
                        <td>: <?php echo $jumlah_halaman3; ?> halaman</td>
                    </tr>
                    <tr>
                        <th>Berat Buku</th>
                        <td>: <?php echo $berat_buku3; ?> gram</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Buku 4</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th>Judul Buku</th>
                        <td>: <?php echo $judul4; ?></td>
                    </tr>
                    <tr>
                        <th width="200">Pengarang</th>
                        <td>: <?php echo $pengarang4; ?></td>
                    </tr>
                    <tr>
                        <th>Penerbit</th>
                        <td>: <?php echo $penerbit4; ?></td>
                    </tr>
                    <tr>
                        <th>Tahun Terbit</th>
                        <td>: <?php echo $tahun_terbit4; ?></td>
                    </tr>
                    <tr>
                        <th>ISBN</th>
                        <td>: <?php echo $isbn4; ?></td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>: RP <?php echo number_format($harga4, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td>: <?php echo $stok4; ?> buku</td>
                    </tr>
                    <tr>
                        <th>Kategori Buku</th>
                        <td class="badge bg-primary">: <?php echo $kategori_buku4; ?></td>
                    </tr>
                    <tr>
                        <th>Bahasa</th>
                        <td>: <?php echo $bahasa4; ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah Halaman</th>
                        <td>: <?php echo $jumlah_halaman4; ?> halaman</td>
                    </tr>
                    <tr>
                        <th>Berat Buku</th>
                        <td>: <?php echo $berat_buku4; ?> gram</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>