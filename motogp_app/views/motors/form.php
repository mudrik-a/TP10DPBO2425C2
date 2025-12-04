<?php
include_once '../../views/includes/header.php';
include_once '../../view_models/MotorViewModel.php';
include_once '../../view_models/RiderViewModel.php'; // Butuh Rider buat dropdown

$motorVM = new MotorViewModel();
$riderVM = new RiderViewModel();

$data = null;
$riders = $riderVM->fetchAllRiders();

if (isset($_GET['id'])) {
    $current = $motorVM->fetchMotorById($_GET['id']);
    $data = [
        'id_motor' => $current->id_motor,
        'id_rider' => $current->id_rider,
        'merk_mesin' => $current->merk_mesin,
        'kapasitas_cc' => $current->kapasitas_cc,
        'top_speed_kmh' => $current->top_speed_kmh
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = [
        'id_motor' => $_POST['id_motor'] ?? null,
        'id_rider' => $_POST['id_rider'],
        'merk_mesin' => $_POST['merk_mesin'],
        'kapasitas_cc' => $_POST['kapasitas_cc'],
        'top_speed_kmh' => $_POST['top_speed_kmh']
    ];

    if (!empty($input['id_motor'])) {
        if ($motorVM->updateMotor($input)) echo "<script>window.location.href='index.php';</script>";
    } else {
        if ($motorVM->addMotor($input)) echo "<script>window.location.href='index.php';</script>";
    }
}
?>

<h2><?php echo isset($_GET['id']) ? 'Edit Motor' : 'Tambah Motor'; ?></h2>

<form action="" method="POST">
    <input type="hidden" name="id_motor" value="<?php echo $data['id_motor'] ?? ''; ?>">

    <div class="form-group">
        <label>Milik Rider</label>
        <select name="id_rider" class="form-control" required>
            <option value="">-- Pilih Rider --</option>
            <?php foreach ($riders as $rd): ?>
                <option value="<?php echo $rd['id_rider']; ?>" 
                    <?php echo (isset($data['id_rider']) && $data['id_rider'] == $rd['id_rider']) ? 'selected' : ''; ?>>
                    <?php echo $rd['nama_rider']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Merk Mesin</label>
        <input type="text" name="merk_mesin" class="form-control" value="<?php echo $data['merk_mesin'] ?? ''; ?>" required placeholder="Contoh: Yamaha YZR-M1">
    </div>
    <div class="form-group">
        <label>Kapasitas (cc)</label>
        <input type="number" name="kapasitas_cc" class="form-control" value="<?php echo $data['kapasitas_cc'] ?? ''; ?>" required>
    </div>
    <div class="form-group">
        <label>Top Speed (km/h)</label>
        <input type="number" name="top_speed_kmh" class="form-control" value="<?php echo $data['top_speed_kmh'] ?? ''; ?>" required>
    </div>

    <div style="margin-top:20px;">
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-danger">Batal</a>
    </div>
</form>

<?php include_once '../../views/includes/footer.php'; ?>