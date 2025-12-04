<?php
include_once '../../views/includes/header.php';
include_once '../../view_models/TeamViewModel.php';

$viewModel = new TeamViewModel();
$data = null; // Variabel penampung data edit

// --- CEK APAKAH INI MODE EDIT? ---
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Ambil data lama berdasarkan ID
    $currentTeam = $viewModel->fetchTeamById($id);
    
    // Kita pindahkan ke array biar gampang diakses di form value
    $data = [
        'id_team' => $currentTeam->id_team,
        'nama_team' => $currentTeam->nama_team,
        'manager' => $currentTeam->manager,
        'markas' => $currentTeam->markas
    ];
}

// --- LOGIKA SIMPAN DATA (POST) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Siapkan data dari form
    $inputData = [
        'id_team' => $_POST['id_team'] ?? null, // Hidden input
        'nama_team' => $_POST['nama_team'],
        'manager' => $_POST['manager'],
        'markas' => $_POST['markas']
    ];

    if (!empty($inputData['id_team'])) {
        // Update Data
        if ($viewModel->updateTeam($inputData)) {
            echo "<script>alert('Berhasil update tim!'); window.location.href='index.php';</script>";
        }
    } else {
        // Create Data Baru
        if ($viewModel->addTeam($inputData)) {
            echo "<script>alert('Berhasil tambah tim baru!'); window.location.href='index.php';</script>";
        }
    }
}
?>

<h2><?php echo isset($_GET['id']) ? 'Edit Tim' : 'Tambah Tim Baru'; ?></h2>

<form action="" method="POST">
    <input type="hidden" name="id_team" value="<?php echo $data['id_team'] ?? ''; ?>">

    <div class="form-group">
        <label>Nama Tim</label>
        <input type="text" name="nama_team" class="form-control" 
               value="<?php echo $data['nama_team'] ?? ''; ?>" required placeholder="Contoh: Ducati Lenovo Team">
    </div>

    <div class="form-group">
        <label>Manager Tim</label>
        <input type="text" name="manager" class="form-control" 
               value="<?php echo $data['manager'] ?? ''; ?>" required placeholder="Contoh: Davide Tardozzi">
    </div>

    <div class="form-group">
        <label>Markas / Negara Asal</label>
        <input type="text" name="markas" class="form-control" 
               value="<?php echo $data['markas'] ?? ''; ?>" required placeholder="Contoh: Italia">
    </div>

    <div style="margin-top: 20px;">
        <button type="submit" class="btn btn-success">Simpan Data</button>
        <a href="index.php" class="btn btn-danger">Batal</a>
    </div>
</form>

<?php
include_once '../../views/includes/footer.php';
?>