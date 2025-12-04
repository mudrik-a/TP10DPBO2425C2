<?php
include_once '../../views/includes/header.php';
include_once '../../view_models/MotorViewModel.php';

$viewModel = new MotorViewModel();

if (isset($_GET['delete_id'])) {
    if ($viewModel->deleteMotor($_GET['delete_id'])) {
        echo "<script>window.location.href='index.php';</script>";
    }
}

$motors = $viewModel->fetchAllMotors();
?>

<div style="display: flex; justify-content: space-between; align-items: center;">
    <h2>Data Spesifikasi Motor</h2>
    <a href="form.php" class="btn btn-primary">+ Tambah Data Motor</a>
</div>

<table>
    <thead>
        <tr>
            <th>Merk Mesin</th>
            <th>Digunakan Oleh (Rider)</th>
            <th>Kapasitas</th>
            <th>Top Speed</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($motors as $row): ?>
        <tr>
            <td><?php echo $row['merk_mesin']; ?></td>
            <td><strong><?php echo $row['nama_rider']; ?></strong></td>
            <td><?php echo $row['kapasitas_cc']; ?> cc</td>
            <td><?php echo $row['top_speed_kmh']; ?> km/h</td>
            <td>
                <a href="form.php?id=<?php echo $row['id_motor']; ?>" class="btn btn-warning">Edit</a>
                <a href="index.php?delete_id=<?php echo $row['id_motor']; ?>" class="btn btn-danger" onclick="return confirm('Hapus?');">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include_once '../../views/includes/footer.php'; ?>