<?php
// Karena ini di root, path include-nya tidak pakai ../
include_once 'views/includes/header.php';
?>

<div style="text-align: center; padding: 30px 0;">
    <h1 style="font-size: 2.5em; margin-bottom: 10px; color: #cc0000; text-transform: uppercase; font-style: italic;">
        🏁 Paddock Dashboard
    </h1>
    <p style="font-size: 1.1em; color: #555;">Selamat datang di Sistem Manajemen Data MotoGP</p>
    
    <div style="margin-top: 40px; display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
        
        <div style="background: #fff; border: 1px solid #ddd; padding: 25px; border-radius: 10px; width: 220px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); transition: transform 0.2s;">
            <h3 style="color: #cc0000; margin-top: 0;">Teams</h3>
            <p style="color: #666; font-size: 0.95em; line-height: 1.5;">
                Kelola data tim pabrikan dan satelit.
            </p>
            <a href="views/teams/index.php" class="btn btn-primary" style="width: 100%; box-sizing: border-box; margin-top: 10px;">Lihat Teams</a>
        </div>

        <div style="background: #fff; border: 1px solid #ddd; padding: 25px; border-radius: 10px; width: 220px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); transition: transform 0.2s;">
            <h3 style="color: #e6b800; margin-top: 0;">Riders</h3>
            <p style="color: #666; font-size: 0.95em; line-height: 1.5;">
                Data pembalap dan nomor start.
            </p>
            <a href="views/riders/index.php" class="btn btn-warning" style="width: 100%; box-sizing: border-box; margin-top: 10px;">Lihat Riders</a>
        </div>

        <div style="background: #fff; border: 1px solid #ddd; padding: 25px; border-radius: 10px; width: 220px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); transition: transform 0.2s;">
            <h3 style="color: #28a745; margin-top: 0;">Sponsors</h3>
            <p style="color: #666; font-size: 0.95em; line-height: 1.5;">
                Kontrak dan mitra sponsor tim.
            </p>
            <a href="views/sponsors/index.php" class="btn btn-success" style="width: 100%; box-sizing: border-box; margin-top: 10px;">Lihat Sponsors</a>
        </div>

        <div style="background: #fff; border: 1px solid #ddd; padding: 25px; border-radius: 10px; width: 220px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); transition: transform 0.2s;">
            <h3 style="color: #17a2b8; margin-top: 0;">Motors</h3>
            <p style="color: #666; font-size: 0.95em; line-height: 1.5;">
                Spesifikasi teknis motor balap.
            </p>
            <a href="views/motors/index.php" class="btn btn-primary" style="width: 100%; background-color: #17a2b8; box-sizing: border-box; margin-top: 10px;">Lihat Motors</a>
        </div>

    </div>
</div>

<?php include_once 'views/includes/footer.php'; ?>