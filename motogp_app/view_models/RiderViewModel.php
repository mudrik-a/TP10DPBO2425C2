<?php
include_once __DIR__ . '/../config/database.php';
include_once __DIR__ . '/../models/Rider.php';

class RiderViewModel {
    private $riderModel;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->riderModel = new Rider($db);
    }

    public function fetchAllRiders() {
        $stmt = $this->riderModel->read();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchRiderById($id) {
        $this->riderModel->id_rider = $id;
        $this->riderModel->readOne();
        return $this->riderModel;
    }

    public function addRider($data) {
        $this->riderModel->id_team = $data['id_team']; // Foreign Key
        $this->riderModel->nama_rider = $data['nama_rider'];
        $this->riderModel->nomor_start = $data['nomor_start'];
        $this->riderModel->negara_asal = $data['negara_asal'];
        return $this->riderModel->create();
    }

    public function updateRider($data) {
        $this->riderModel->id_rider = $data['id_rider'];
        $this->riderModel->id_team = $data['id_team'];
        $this->riderModel->nama_rider = $data['nama_rider'];
        $this->riderModel->nomor_start = $data['nomor_start'];
        $this->riderModel->negara_asal = $data['negara_asal'];
        return $this->riderModel->update();
    }

    public function deleteRider($id) {
        $this->riderModel->id_rider = $id;
        return $this->riderModel->delete();
    }
}
?>