<?php
include_once '../../views/includes/header.php';
include_once '../../view_models/SponsorViewModel.php';

$viewModel = new SponsorViewModel();

if (isset($_GET['delete_id'])) {
    if ($viewModel->deleteSponsor($_GET['delete_id'])) {
        echo "<script>window.location.href='index.php';</script>";
    }
}

$sponsors = $viewModel->fetchAllSponsors();
?>

<div style="display: flex; justify-content: space-between; align-items: center;">
    <h2>Daftar Sponsor & Kontrak</h2>
    <a href="form.php" class="btn btn-primary">+ Tambah Sponsor</a>
</div>

<table>
    <thead>
        <tr>
            <th>Nama Sponsor</th>
            <th>Mendukung Tim</th>
            <th>Bidang</th>
            <th>Nilai Kontrak</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sponsors as $row): ?>
        <tr>
            <td><strong><?php echo $row['nama_sponsor']; ?></strong></td>
            <td><?php echo $row['nama_team']; ?></td>
            <td><?php echo $row['jenis_bidang']; ?></td>
            <td style="color: #28a745;">$ <?php echo number_format($row['nilai_kontrak']); ?></td>
            <td>
                <a href="form.php?id=<?php echo $row['id_sponsor']; ?>" class="btn btn-warning">Edit</a>
                <a href="index.php?delete_id=<?php echo $row['id_sponsor']; ?>" class="btn btn-danger" onclick="return confirm('Hapus?');">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include_once '../../views/includes/footer.php'; ?>