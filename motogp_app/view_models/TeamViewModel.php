<?php
include_once __DIR__ . '/../config/database.php';
include_once __DIR__ . '/../models/Team.php';

class TeamViewModel {
    private $teamModel;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->teamModel = new Team($db);
    }

    public function fetchAllTeams() {
        $stmt = $this->teamModel->read();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Mengembalikan data siap tampil
    }

    public function fetchTeamById($id) {
        $this->teamModel->id_team = $id;
        $this->teamModel->readOne();
        // Mengembalikan object model yang sudah terisi datanya
        return $this->teamModel;
    }

    public function addTeam($data) {
        $this->teamModel->nama_team = $data['nama_team'];
        $this->teamModel->manager = $data['manager'];
        $this->teamModel->markas = $data['markas'];
        return $this->teamModel->create();
    }

    public function updateTeam($data) {
        $this->teamModel->id_team = $data['id_team'];
        $this->teamModel->nama_team = $data['nama_team'];
        $this->teamModel->manager = $data['manager'];
        $this->teamModel->markas = $data['markas'];
        return $this->teamModel->update();
    }

    public function deleteTeam($id) {
        $this->teamModel->id_team = $id;
        return $this->teamModel->delete();
    }
}
?>