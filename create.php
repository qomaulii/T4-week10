<?php
    require 'config/database.php';
    $pesan = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nama_barang = trim($_POST['nama_barang'] ?? '');
        $kategori    = trim($_POST['kategori'] ?? '');
        $jumlah      = trim($_POST['jumlah'] ?? '');
        $harga       = trim($_POST['harga'] ?? '');
        $lokasi      = trim($_POST['lokasi'] ?? '');

        if (!empty($nama_barang) && !empty($kategori) && !empty($harga)) {
            $stmt = $pdo->prepare("
                insert into barang (nama_barang, kategori, jumlah, harga, lokasi)
                values (:nama_barang, :kategori, :jumlah, :harga, :lokasi)
            ");
            $stmt->execute([
                ':nama_barang' => $nama_barang,
                ':kategori'    => $kategori,
                ':jumlah'      => $jumlah,
                ':harga'       => $harga,
                ':lokasi'      => $lokasi
            ]);
            header("Location: index.php?pesan=tambah_sukses");
            exit;
        } else {
            $pesan = "field wajib diisi!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tambah item</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5" style="max-width:600px;">
        <h2>Tambah item</h2>

        <?php if ($pesan) : ?>
            <div class="alert alert-danger"><?= $pesan ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Kategori</label>
                <input type="text" name="kategori" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Jumlah</label>
                <input type="number" name="jumlah" class="form-control">
            </div>
            <div class="mb-3">
                <label>Harga</label>
                <input type="number" step="0.01" name="harga" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Lokasi</label>
                <input type="text" name="lokasi" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>