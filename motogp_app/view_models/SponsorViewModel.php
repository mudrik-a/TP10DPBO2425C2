<?php
include_once __DIR__ . '/../config/database.php';
include_once __DIR__ . '/../models/Sponsor.php';

class SponsorViewModel {
    private $sponsorModel;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->sponsorModel = new Sponsor($db);
    }

    public function fetchAllSponsors() {
        $stmt = $this->sponsorModel->read();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchSponsorById($id) {
        $this->sponsorModel->id_sponsor = $id;
        $this->sponsorModel->readOne();
        return $this->sponsorModel;
    }

    public function addSponsor($data) {
        $this->sponsorModel->id_team = $data['id_team'];
        $this->sponsorModel->nama_sponsor = $data['nama_sponsor'];
        $this->sponsorModel->jenis_bidang = $data['jenis_bidang'];
        $this->sponsorModel->nilai_kontrak = $data['nilai_kontrak'];
        return $this->sponsorModel->create();
    }

    public function updateSponsor($data) {
        $this->sponsorModel->id_sponsor = $data['id_sponsor'];
        $this->sponsorModel->id_team = $data['id_team'];
        $this->sponsorModel->nama_sponsor = $data['nama_sponsor'];
        $this->sponsorModel->jenis_bidang = $data['jenis_bidang'];
        $this->sponsorModel->nilai_kontrak = $data['nilai_kontrak'];
        return $this->sponsorModel->update();
    }

    public function deleteSponsor($id) {
        $this->sponsorModel->id_sponsor = $id;
        return $this->sponsorModel->delete();
    }
}
?>