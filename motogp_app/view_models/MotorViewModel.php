<?php
include_once __DIR__ . '/../config/database.php';
include_once __DIR__ . '/../models/Motor.php';

class MotorViewModel {
    private $motorModel;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->motorModel = new Motor($db);
    }

    public function fetchAllMotors() {
        $stmt = $this->motorModel->read();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchMotorById($id) {
        $this->motorModel->id_motor = $id;
        $this->motorModel->readOne();
        return $this->motorModel;
    }

    public function addMotor($data) {
        $this->motorModel->id_rider = $data['id_rider']; // Foreign Key ke Rider
        $this->motorModel->merk_mesin = $data['merk_mesin'];
        $this->motorModel->kapasitas_cc = $data['kapasitas_cc'];
        $this->motorModel->top_speed_kmh = $data['top_speed_kmh'];
        return $this->motorModel->create();
    }

    public function updateMotor($data) {
        $this->motorModel->id_motor = $data['id_motor'];
        $this->motorModel->id_rider = $data['id_rider'];
        $this->motorModel->merk_mesin = $data['merk_mesin'];
        $this->motorModel->kapasitas_cc = $data['kapasitas_cc'];
        $this->motorModel->top_speed_kmh = $data['top_speed_kmh'];
        return $this->motorModel->update();
    }

    public function deleteMotor($id) {
        $this->motorModel->id_motor = $id;
        return $this->motorModel->delete();
    }
}
?>