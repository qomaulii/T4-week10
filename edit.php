<?php
    require_once 'config/database.php';

    $id = $_GET['id'] ?? 0;
    $stmt = $pdo->prepare("SELECT * FROM barang WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $data = $stmt->fetch();

    if (!$data) {
        header("Location: index.php");
        exit;
    }

    $pesan = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nama_barang = trim($_POST['nama_barang'] ?? '');
        $kategori    = trim($_POST['kategori'] ?? '');
        $jumlah      = trim($_POST['jumlah'] ?? '');
        $harga       = trim($_POST['harga'] ?? '');
        $lokasi      = trim($_POST['lokasi'] ?? '');

        if (!empty($nama_barang) && !empty($kategori) && !empty($jumlah) && !empty($harga)) {
            $stmt = $pdo->prepare("UPDATE barang SET nama_barang = :nama_barang, kategori = :kategori, jumlah = :jumlah, harga = :harga, lokasi = :lokasi WHERE id = :id");
            $stmt->execute([
                ':nama_barang' => $nama_barang,
                ':kategori'    => $kategori,
                ':jumlah'      => $jumlah,
                ':harga'       => $harga,
                ':lokasi'      => $lokasi,
                ':id'          => $id
            ]);
            header("Location: index.php?pesan=edit_sukses");
            exit;
        } else {
            $pesan = "Semua field wajib diisi!";
        }
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit item</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-5" style="max-width: 600px;">
        <h2>Edit item</h2>

        <?php if ($pesan): ?>
            <div class="alert alert-danger"><?= $pesan ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control"
                    value="<?= htmlspecialchars($data['nama_barang']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <input type="text" name="kategori" class="form-control"
                    value="<?= htmlspecialchars($data['kategori']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" name="jumlah" class="form-control"
                    value="<?= htmlspecialchars($data['jumlah']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" step="0.01" name="harga" class="form-control"
                    value="<?= htmlspecialchars($data['harga']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Lokasi</label>
                <input type="text" name="lokasi" class="form-control"
                    value="<?= htmlspecialchars($data['lokasi']) ?>">
            </div>
            <a href="index.php" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-warning">Update</button>
        </form>
    </div>
</body>
</html>