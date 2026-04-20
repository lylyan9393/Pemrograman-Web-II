<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Registrasi Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<?php
$nama = $email = $telepon = $alamat = $jk = $tgl_lahir = $pekerjaan = "";
$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST["nama"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $telepon = trim($_POST["telepon"] ?? "");
    $alamat = trim($_POST["alamat"] ?? "");
    $jk = $_POST["jk"] ?? "";
    $tgl_lahir = $_POST["tgl_lahir"] ?? "";
    $pekerjaan = $_POST["pekerjaan"] ?? "";

    if (empty($nama)) {
        $errors["nama"] = "Nama Lengkap harus diisi.";
    } elseif (strlen($nama) < 3) {
        $errors["nama"] = "Nama Lengkap minimal 3 karakter.";
    }

    if (empty($email)) {
        $errors["email"] = "Email harus diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Format email tidak valid.";
    }

    if (empty($telepon)) {
        $errors["telepon"] = "Telepon harus diisi.";
    } elseif (!preg_match("/^08\d{8,11}$/", $telepon)) {
        $errors["telepon"] = "Telepon harus format 08xxxxxxxxxx.";
    }

    if (empty($alamat)) {
        $errors["alamat"] = "Alamat harus diisi.";
    } elseif (strlen($alamat) < 10) {
        $errors["alamat"] = "Alamat minimal 10 karakter.";
    }

    if (empty($jk)) {
        $errors["jk"] = "Jenis kelamin harus dipilih.";
    }

    if (empty($tgl_lahir)) {
        $errors["tgl_lahir"] = "Tanggal lahir harus diisi.";
    } else {
        $lahir = new DateTime($tgl_lahir);
        $sekarang = new DateTime();
        $umur = $sekarang->diff($lahir)->y;
        if ($umur < 10) {
            $errors["tgl_lahir"] = "Umur minimal 10 tahun.";
        }
    }

    if (empty($pekerjaan)) {
        $errors["pekerjaan"] = "Pekerjaan harus dipilih.";
    }

    if (empty($errors)) {
        $success = true;
    }
}
?>

<div class="container py-5" style="max-width: 850px;">

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-primary text-white fw-semibold">
            <i class="bi bi-person-plus me-2"></i>Form Registrasi Anggota
        </div>
        <div class="card-body p-4">

            <?php if ($success): ?>
                <div class="alert alert-success">
                    <strong>Berhasil!</strong> Data anggota sudah disimpan.
                </div>

                <div class="card border-success">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Data Anggota</h5>
                        <div class="row">
                            <div class="col-md-6 mb-2"><strong>Nama Lengkap:</strong> <?= htmlspecialchars($nama) ?></div>
                            <div class="col-md-6 mb-2"><strong>Email:</strong> <?= htmlspecialchars($email) ?></div>
                            <div class="col-md-6 mb-2"><strong>Telepon:</strong> <?= htmlspecialchars($telepon) ?></div>
                            <div class="col-md-6 mb-2"><strong>Jenis Kelamin:</strong> <?= htmlspecialchars($jk) ?></div>
                            <div class="col-md-6 mb-2"><strong>Tanggal Lahir:</strong> <?= htmlspecialchars($tgl_lahir) ?></div>
                            <div class="col-md-6 mb-2"><strong>Pekerjaan:</strong> <?= htmlspecialchars($pekerjaan) ?></div>
                            <div class="col-12 mb-2"><strong>Alamat:</strong><br><?= nl2br(htmlspecialchars($alamat)) ?></div>
                        </div>
                    </div>
                </div>

            <?php endif; ?>

            <form method="POST" novalidate>
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control <?= isset($errors["nama"]) ? "is-invalid" : "" ?>" placeholder="Masukkan nama lengkap" value="<?= htmlspecialchars($nama) ?>" required>
                    <div class="invalid-feedback"><?= $errors["nama"] ?? "" ?></div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control <?= isset($errors["email"]) ? "is-invalid" : "" ?>" placeholder="Masukkan email" value="<?= htmlspecialchars($email) ?>" required>
                    <div class="invalid-feedback"><?= $errors["email"] ?? "" ?></div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Telepon <span class="text-danger">*</span></label>
                    <input type="text" name="telepon" class="form-control <?= isset($errors["telepon"]) ? "is-invalid" : "" ?>" placeholder="08xxxxxxxxxx" value="<?= htmlspecialchars($telepon) ?>" required>
                    <div class="invalid-feedback"><?= $errors["telepon"] ?? "" ?></div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat <span class="text-danger">*</span></label>
                    <textarea name="alamat" rows="3" class="form-control <?= isset($errors["alamat"]) ? "is-invalid" : "" ?>" placeholder="Masukkan alamat lengkap" required><?= htmlspecialchars($alamat) ?></textarea>
                    <div class="invalid-feedback"><?= $errors["alamat"] ?? "" ?></div>
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Jenis Kelamin <span class="text-danger">*</span></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input <?= isset($errors["jk"]) ? "is-invalid" : "" ?>" type="radio" name="jk" value="Laki-laki" <?= ($jk == "Laki-laki") ? "checked" : "" ?> required>
                        <label class="form-check-label">Laki-laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input <?= isset($errors["jk"]) ? "is-invalid" : "" ?>" type="radio" name="jk" value="Perempuan" <?= ($jk == "Perempuan") ? "checked" : "" ?> required>
                        <label class="form-check-label">Perempuan</label>
                    </div>
                    <?php if (isset($errors["jk"])): ?>
                        <div class="text-danger small mt-1"><?= $errors["jk"] ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" name="tgl_lahir" class="form-control <?= isset($errors["tgl_lahir"]) ? "is-invalid" : "" ?>" value="<?= htmlspecialchars($tgl_lahir) ?>" required>
                    <div class="invalid-feedback"><?= $errors["tgl_lahir"] ?? "" ?></div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                    <select name="pekerjaan" class="form-select <?= isset($errors["pekerjaan"]) ? "is-invalid" : "" ?>" required>
                        <option value="">-- Pilih Pekerjaan --</option>
                        <option value="Pelajar" <?= ($pekerjaan == "Pelajar") ? "selected" : "" ?>>Pelajar</option>
                        <option value="Mahasiswa" <?= ($pekerjaan == "Mahasiswa") ? "selected" : "" ?>>Mahasiswa</option>
                        <option value="Pegawai" <?= ($pekerjaan == "Pegawai") ? "selected" : "" ?>>Pegawai</option>
                        <option value="Lainnya" <?= ($pekerjaan == "Lainnya") ? "selected" : "" ?>>Lainnya</option>
                    </select>
                    <div class="invalid-feedback"><?= $errors["pekerjaan"] ?? "" ?></div>
                </div>

                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-1"></i>
                    <strong>Catatan:</strong> Field dengan tanda (*) wajib diisi.
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-2">
                    <i class="bi bi-check-circle me-1"></i>Simpan Data Anggota
                </button>
                <button type="reset" class="btn btn-secondary w-100">
                    <i class="bi bi-x-circle me-1"></i>Reset Form
                </button>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-info text-white fw-semibold">
            <i class="bi bi-shield-check me-2"></i>Aturan Validasi
        </div>
        <div class="card-body">
            <ul class="mb-0-0">
                <li>Nama minimal 3 karakter.</li>
                <li>Email harus format valid.</li>
                <li>Telepon harus diawali 08 dan panjang 10–13 digit.</li>
                <li>Alamat minimal 10 karakter.</li>
                <li>Umur minimal 10 tahun.</li>
            </ul>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>