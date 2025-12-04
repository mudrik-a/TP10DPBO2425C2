<?php
include_once '../../views/includes/header.php';
include_once '../../view_models/RiderViewModel.php';
include_once '../../view_models/TeamViewModel.php'; // Butuh ini buat Dropdown Team

$riderVM = new RiderViewModel();
$teamVM = new TeamViewModel();

$data = null;
$teams = $teamVM->fetchAllTeams(); // Ambil semua tim buat dropdown

// Mode Edit
if (isset($_GET['id'])) {
    $current = $riderVM->fetchRiderById($_GET['id']);
    $data = [
        'id_rider' => $current->id_rider,
        'id_team' => $current->id_team,
        'nama_rider' => $current->nama_rider,
        'nomor_start' => $current->nomor_start,
        'negara_asal' => $current->negara_asal
    ];
}

// Simpan Data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = [
        'id_rider' => $_POST['id_rider'] ?? null,
        'id_team' => $_POST['id_team'],
        'nama_rider' => $_POST['nama_rider'],
        'nomor_start' => $_POST['nomor_start'],
        'negara_asal' => $_POST['negara_asal']
    ];

    if (!empty($input['id_rider'])) {
        if ($riderVM->updateRider($input)) echo "<script>window.location.href='index.php';</script>";
    } else {
        if ($riderVM->addRider($input)) echo "<script>window.location.href='index.php';</script>";
    }
}
?>

<h2><?php echo isset($_GET['id']) ? 'Edit Rider' : 'Tambah Rider'; ?></h2>

<form action="" method="POST">
    <input type="hidden" name="id_rider" value="<?php echo $data['id_rider'] ?? ''; ?>">

    <div class="form-group">
        <label>Pilih Tim (Relasi)</label>
        <select name="id_team" class="form-control" required>
            <option value="">-- Pilih Tim --</option>
            <?php foreach ($teams as $tm): ?>
                <option value="<?php echo $tm['id_team']; ?>" 
                    <?php echo (isset($data['id_team']) && $data['id_team'] == $tm['id_team']) ? 'selected' : ''; ?>>
                    <?php echo $tm['nama_team']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Nama Rider</label>
        <input type="text" name="nama_rider" class="form-control" value="<?php echo $data['nama_rider'] ?? ''; ?>" required>
    </div>

    <div class="form-group">
        <label>Nomor Start</label>
        <input type="number" name="nomor_start" class="form-control" value="<?php echo $data['nomor_start'] ?? ''; ?>" required>
    </div>

    <div class="form-group">
        <label>Negara Asal</label>
        <input type="text" name="negara_asal" class="form-control" value="<?php echo $data['negara_asal'] ?? ''; ?>" required>
    </div>

    <div style="margin-top:20px;">
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-danger">Batal</a>
    </div>
</form>

<?php include_once '../../views/includes/footer.php'; ?>