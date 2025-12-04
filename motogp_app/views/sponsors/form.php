<?php
include_once '../../views/includes/header.php';
include_once '../../view_models/SponsorViewModel.php';
include_once '../../view_models/TeamViewModel.php'; // Butuh tim buat dropdown

$sponsorVM = new SponsorViewModel();
$teamVM = new TeamViewModel();

$data = null;
$teams = $teamVM->fetchAllTeams();

if (isset($_GET['id'])) {
    $current = $sponsorVM->fetchSponsorById($_GET['id']);
    $data = [
        'id_sponsor' => $current->id_sponsor,
        'id_team' => $current->id_team,
        'nama_sponsor' => $current->nama_sponsor,
        'jenis_bidang' => $current->jenis_bidang,
        'nilai_kontrak' => $current->nilai_kontrak
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = [
        'id_sponsor' => $_POST['id_sponsor'] ?? null,
        'id_team' => $_POST['id_team'],
        'nama_sponsor' => $_POST['nama_sponsor'],
        'jenis_bidang' => $_POST['jenis_bidang'],
        'nilai_kontrak' => $_POST['nilai_kontrak']
    ];

    if (!empty($input['id_sponsor'])) {
        if ($sponsorVM->updateSponsor($input)) echo "<script>window.location.href='index.php';</script>";
    } else {
        if ($sponsorVM->addSponsor($input)) echo "<script>window.location.href='index.php';</script>";
    }
}
?>

<h2><?php echo isset($_GET['id']) ? 'Edit Sponsor' : 'Tambah Sponsor'; ?></h2>

<form action="" method="POST">
    <input type="hidden" name="id_sponsor" value="<?php echo $data['id_sponsor'] ?? ''; ?>">

    <div class="form-group">
        <label>Pilih Tim yang Disponsori</label>
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
        <label>Nama Sponsor</label>
        <input type="text" name="nama_sponsor" class="form-control" value="<?php echo $data['nama_sponsor'] ?? ''; ?>" required>
    </div>
    <div class="form-group">
        <label>Jenis Bidang (Oli, Bank, Minuman, dll)</label>
        <input type="text" name="jenis_bidang" class="form-control" value="<?php echo $data['jenis_bidang'] ?? ''; ?>" required>
    </div>
    <div class="form-group">
        <label>Nilai Kontrak (USD)</label>
        <input type="number" name="nilai_kontrak" class="form-control" value="<?php echo $data['nilai_kontrak'] ?? ''; ?>" required>
    </div>

    <div style="margin-top:20px;">
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-danger">Batal</a>
    </div>
</form>

<?php include_once '../../views/includes/footer.php'; ?>