<?php
// Load Header
include_once '../../views/includes/header.php';

// Load ViewModel
include_once '../../view_models/TeamViewModel.php';

// Inisialisasi ViewModel
$viewModel = new TeamViewModel();

// --- LOGIKA HAPUS DATA ---
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    if ($viewModel->deleteTeam($id)) {
        echo "<script>alert('Data berhasil dihapus!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data.');</script>";
    }
}

// Ambil semua data teams
$teams = $viewModel->fetchAllTeams();
?>

<div style="display: flex; justify-content: space-between; align-items: center;">
    <h2>Daftar Tim MotoGP</h2>
    <a href="form.php" class="btn btn-primary">+ Tambah Tim Baru</a>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Tim</th>
            <th>Manager</th>
            <th>Markas</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($teams) > 0): ?>
            <?php foreach ($teams as $row): ?>
            <tr>
                <td><?php echo $row['id_team']; ?></td>
                <td><strong><?php echo $row['nama_team']; ?></strong></td>
                <td><?php echo $row['manager']; ?></td>
                <td><?php echo $row['markas']; ?></td>
                <td>
                    <a href="form.php?id=<?php echo $row['id_team']; ?>" class="btn btn-warning">Edit</a>
                    
                    <a href="index.php?delete_id=<?php echo $row['id_team']; ?>" 
                       class="btn btn-danger" 
                       onclick="return confirm('Yakin ingin menghapus tim ini? Semua rider & sponsor terkait juga akan terhapus lho!');">
                       Hapus
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" style="text-align:center;">Belum ada data tim.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
// Load Footer
include_once '../../views/includes/footer.php';
?>