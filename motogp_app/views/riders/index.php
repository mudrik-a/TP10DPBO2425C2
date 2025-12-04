<?php
include_once '../../views/includes/header.php';
include_once '../../view_models/RiderViewModel.php';

$viewModel = new RiderViewModel();

// Hapus Data
if (isset($_GET['delete_id'])) {
    if ($viewModel->deleteRider($_GET['delete_id'])) {
        echo "<script>alert('Rider berhasil dihapus!'); window.location.href='index.php';</script>";
    }
}

$riders = $viewModel->fetchAllRiders();
?>

<div style="display: flex; justify-content: space-between; align-items: center;">
    <h2>Daftar Pembalap (Riders)</h2>
    <a href="form.php" class="btn btn-primary">+ Tambah Rider</a>
</div>

<table>
    <thead>
        <tr>
            <th>No. Start</th>
            <th>Nama Rider</th>
            <th>Negara</th>
            <th>Tim (Relasi)</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($riders as $row): ?>
        <tr>
            <td style="font-size: 1.2em; font-weight: bold; color: #ffd700;">#<?php echo $row['nomor_start']; ?></td>
            <td><?php echo $row['nama_rider']; ?></td>
            <td><?php echo $row['negara_asal']; ?></td>
            <td><?php echo $row['nama_team']; // Dari hasil JOIN ?></td>
            <td>
                <a href="form.php?id=<?php echo $row['id_rider']; ?>" class="btn btn-warning">Edit</a>
                <a href="index.php?delete_id=<?php echo $row['id_rider']; ?>" class="btn btn-danger" onclick="return confirm('Hapus rider ini?');">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include_once '../../views/includes/footer.php'; ?>