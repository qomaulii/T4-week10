<?php
    require 'config/database.php';

    $stmt = $pdo->query("select * from barang order by id asc");
    $barang = $stmt->fetchAll();
    $pesan = $_GET['pesan'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inventaris toko exo</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="fw-bold text-uppercase border-bottom pb-2 mb-4">
            DATA INVENTARIS TOKO EXO
        </h2>

        <?php if ($pesan == 'tambah_sukses') : ?>
            <div class="alert alert-success alert-dismissible fade show">
                yey!! data berhasil ditambah!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php elseif ($pesan == 'edit_sukses') : ?>
            <div class="alert alert-info alert-dismissible fade show">
                yey!! data berhasil diupdate!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php elseif ($pesan == 'hapus_sukses') : ?>
            <div class="alert alert-warning alert-dismissible fade show">
                yey!! data berhasil dihapus!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <a href="create.php" class="btn btn-primary mb-3">+ Tambah Barang</a>

        <table class="table table-striped table-hover table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Lokasi</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php if (count($barang) > 0) : ?>
                    <?php $no = 1; ?>
                    <?php foreach ($barang as $row) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nama_barang']); ?></td>
                            <td><?= htmlspecialchars($row['kategori']); ?></td>
                            <td><?= htmlspecialchars($row['jumlah']); ?></td>
                            <td><?= htmlspecialchars($row['harga']); ?></td>
                            <td><?= htmlspecialchars($row['lokasi']); ?></td>
                            <td><?= htmlspecialchars($row['created_at']); ?></td>
                            <td>
                                <a href="edit.php?id=<?= $row['id']; ?>" 
                                   class="btn btn-warning btn-sm">Edit</a>

                                <a href="delete.php?id=<?= $row['id']; ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin hapus?')">
                                   Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8" class="text-center">Belum ada data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <p>Total: <?= count($barang); ?> data</p>
    </div>
</body>
</html>