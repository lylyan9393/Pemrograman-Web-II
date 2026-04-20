<?php
session_start();
// data buku
$buku_list = [
    [
        "kode" => "B001",
        "judul" => "Algoritma Dasar",
        "kategori" => "Teknologi",
        "pengarang" => "Andi",
        "penerbit" => "Informatika",
        "tahun" => 2020,
        "harga" => 75000,
        "stok" => 10
    ],
    [
        "kode" => "B002",
        "judul" => "Struktur Data",
        "kategori" => "Teknologi",
        "pengarang" => "Budi",
        "penerbit" => "Erlangga",
        "tahun" => 2019,
        "harga" => 80000,
        "stok" => 0
    ],
    [
        "kode" => "B003",
        "judul" => "Pemprograman PHP",
        "kategori" => "Teknologi",
        "pengarang" => "Citra",
        "penerbit" => "Informatika",
        "tahun" => 2021,
        "harga" => 90000,
        "stok" => 5
    ],
    [
        "kode"=>"B004",
        "judul"=>"Basis Data",
        "kategori"=>"Teknologi",
        "pengarang"=>"Dewi",
        "penerbit"=>"Andi",
        "tahun"=>2018,
        "harga"=>85000,
        "stok"=>2
    ],
    [
        "kode"=>"B005",
        "judul"=>"Matematika Diskrit",
        "kategori"=>"Pendidikan",
        "pengarang"=>"Eko",
        "penerbit"=>"Gramedia",
        "tahun"=>2017,
        "harga"=>70000,
        "stok"=>0
    ],
    [
        "kode"=>"B006",
        "judul"=>"Kalkulus",
        "kategori"=>"Pendidikan"
        ,"pengarang"=>"Fajar",
        "penerbit"=>"Erlangga",
        "tahun"=>2022,
        "harga"=>95000,
        "stok"=>8
    ],
    [
        "kode"=>"B007",
        "judul"=>"Jaringan Komputer",
        "kategori"=>"Teknologi",
        "pengarang"=>"Gina",
        "penerbit"=>"Informatika",
        "tahun"=>2023,
        "harga"=>100000,
        "stok"=>4
    ],
    [
        "kode"=>"B008",
        "judul"=>"Sistem Operasi",
        "kategori"=>"Teknologi",
        "pengarang"=>"Hadi",
        "penerbit"=>"Andi",
        "tahun"=>2020,
        "harga"=>88000,
        "stok"=>0
    ],
    [
        "kode"=>"B009",
        "judul"=>"Manajemen",
        "kategori"=>"Bisnis",
        "pengarang"=>"Indra",
        "penerbit"=>"Gramedia",
        "tahun"=>2016,
        "harga"=>65000,
        "stok"=>6
    ],
    [
        "kode"=>"B010",
        "judul"=>"Akuntansi",
        "kategori"=>"Bisnis",
        "pengarang"=>"Joko",
        "penerbit"=>"Erlangga",
        "tahun"=>2021,
        "harga"=>92000,
        "stok"=>3
    ],
];

// ambil get
$keyword = $_GET['keyword'] ?? '';
$kategori = $_GET['kategori'] ?? '';
$min_harga = $_GET['min_harga'] ?? '';
$max_harga = $_GET['max_harga'] ?? '';
$tahun = $_GET['tahun'] ?? '';
$status = $_GET['status'] ?? 'semua';
$sort = $_GET['sort'] ?? 'judul';
$page = $_GET['page'] ?? 1;

// validasi
$errors = [];

if (!empty($min_harga) && !empty($max_harga) && $min_harga > $max_harga) {
    $errors[] = "Harga minimum tidak boleh lebih besar dari harga maksimum";
}

$current_year = date("Y");
if (!empty($tahun) && ($tahun < 1900 || $tahun > $current_year)) {
    $errors[] = "Tahun harus antara 1900 - $current_year";
}

// filter
$hasil = array_filter($buku_list, function($buku) use ($keyword, $kategori, $min_harga, $max_harga, $tahun, $status,) {
    if ($keyword && stripos($buku['judul'], $keyword) === false && stripos($buku['pengarang'], $keyword) === false) {
        return false;
    }

    if ($kategori && $buku['kategori'] != $kategori) {
        return false;
    }

    if ($min_harga && $buku['harga'] < $min_harga) {
        return false;
    }

    if ($max_harga && $buku['harga'] > $max_harga) {
        return false;
    }

    if ($tahun && $buku['tahun'] != $tahun) {
        return false;
    }

    if ($status == "tersedia" && $buku['stok'] <= 0) return false;
    if ($status == "habis" && $buku['stok'] > 0) return false;

    return true;

});

// sorting
usort($hasil, function($a,$b) use ($sort){
    return $a[$sort] <=> $b[$sort];
});

// export CSV
if (isset($_GET['export']) && $_GET['export'] == 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=hasil_buku.csv');

    $output = fopen("php://output", "w");
    fputcsv($output, ['Kode','Judul','Kategori','Pengarang','Tahun','Harga','Stok']);

    foreach ($hasil_all as $b) {
        fputcsv($output, $b);
    }

    fclose($output);
    exit;
} 

// pagination
$per_page = 10;
$total = count($hasil);
$start = ($page - 1) * $per_page;
$hasil = array_slice($hasil, $start, $per_page);

// session recent
if (!empty($_GET)) {
    $_SESSION['recent'][] = $_GET;
}

// highlight function
function highlight($text, $keyword) {
    if (!$keyword) return $text;
    return preg_replace("/($keyword)/i", "<mark>$1</mark>", $text);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5>Form Pencarian Buku</h5>
            </div>
            <div class="card-body">
                <?php if($errors): ?>
                    <div class="alert alert-danger">
                        <?php foreach($errors as $e) echo "<div>$e</div" ; ?>
                    </div>
                <?php endif; ?>

                <form method="GET">
                    <div class="row g-3">
                        <input type="text" name="keyword" class="form-control" placeholder="Keyword" value="<?= $keyword ?>">

                        <div class="col-md-6">
                            <label>Kategori</label>
                            <select name="kategori" class="form-control">
                                <option value="">Semua</option>
                                <option <?= $kategori=='Teknologi'?'selected':'' ?>>Teknologi</option>
                                <option <?= $kategori=='Pendidikan'?'selected':'' ?>>Pendidikan</option>
                                <option <?= $kategori=='Bisnis'?'selected':'' ?>>Bisnis</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label>Min Harga</label>
                            <input type="number" name="min_harga" class="form-control" placeholder="Min Harga" value="<?= $min_harga ?>">
                        </div>

                        <div class="col-md-3">
                            <label>Max Harga</label>
                            <input type="number" name="max_harga" class="form-control" placeholder="Max Harga" value="<?= $max_harga ?>">
                        </div>

                        <div class="col-md-3">
                            <label>Tahun</label>
                            <input type="number" name="tahun" class="form-control" placeholder="Tahun" value="<?= $tahun ?>">
                        </div>

                        <div class="col-md-3">
                            <label>Sorting</label>
                            <select name="sort" class="form-control">
                                <option value="judul">Judul</option>
                                <option value="harga">Harga</option>
                                <option value="tahun">Tahun</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label>Status</label><br>
                            <input type="radio" name="status" value="semua" <?= $status=='semua'?'checked':'' ?>> Semua
                            <input type="radio" name="status" value="tersedia" <?= $status=='tersedia'?'checked':'' ?>> Tersedia
                            <input type="radio" name="status" value="habis" <?= $status=='habis'?'checked':'' ?>> Habis
                        </div>

                            <button class="btn btn-primary">Cari</button>
                            <a href="?export=csv" class="btn btn-success">Export CSV</a>
                    </div>
                </form>
            </div>
        </div>

        <!--hasil-->
        <div class="card mt-4 shadow">
            <div class="card-header bg-success text-white">
                Hasil (<?= $total ?> ditemukan)
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Pengarang</th>
                            <th>Tahun</th>
                            <th>Harga</th>
                            <th>Stok</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($hasil as $b): ?>
                            <tr>
                                <td><?= $b['kode'] ?></td>
                                <td><?= highlight($b['judul'], $keyword) ?></td>
                                <td><?= $b['kategori'] ?></td>
                                <td><?= highlight($b['pengarang'], $keyword) ?></td>
                                <td><?= $b['tahun'] ?></td>
                                <td><?= number_format($b['harga']) ?></td>
                                <td><?= $b['stok'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!--recent search-->
        <div class="card mt-4">
            <div class="card-header">Recent Search</div>
            <div class="card-body">
                <ul>
                    <?php
                    if (!empty($_SESSION['recent'])) {
                        foreach ($_SESSION['recent'] as $r) {
                            echo "<li>" . ($r['keyword'] ?? '-') . "</li>";
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
