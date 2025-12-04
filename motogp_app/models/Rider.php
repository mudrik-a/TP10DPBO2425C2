<?php
class Rider {
    private $conn;
    private $table_name = "riders";

    public $id_rider;
    public $id_team; // Foreign Key
    public $nama_rider;
    public $nomor_start;
    public $negara_asal;

    // Properti buat nampung nama team hasil JOIN
    public $nama_team_relation;

    public function __construct($db) {
        $this->conn = $db;
    }

    // READ ALL (dengan JOIN)
    public function read() {
        $query = "SELECT r.*, t.nama_team 
                  FROM " . $this->table_name . " r
                  LEFT JOIN teams t ON r.id_team = t.id_team
                  ORDER BY r.id_rider ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // READ ONE
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_rider = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_rider);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $this->id_team = $row['id_team'];
            $this->nama_rider = $row['nama_rider'];
            $this->nomor_start = $row['nomor_start'];
            $this->negara_asal = $row['negara_asal'];
        }
    }

    // CREATE
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET id_team=:id_team, nama_rider=:nama, nomor_start=:nomor, negara_asal=:negara";
        $stmt = $this->conn->prepare($query);

        $this->nama_rider = htmlspecialchars(strip_tags($this->nama_rider));
        $this->negara_asal = htmlspecialchars(strip_tags($this->negara_asal));

        $stmt->bindParam(":id_team", $this->id_team);
        $stmt->bindParam(":nama", $this->nama_rider);
        $stmt->bindParam(":nomor", $this->nomor_start);
        $stmt->bindParam(":negara", $this->negara_asal);

        if($stmt->execute()) return true;
        return false;
    }

    // UPDATE
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET id_team=:id_team, nama_rider=:nama, nomor_start=:nomor, negara_asal=:negara 
                  WHERE id_rider=:id";
        $stmt = $this->conn->prepare($query);

        $this->nama_rider = htmlspecialchars(strip_tags($this->nama_rider));
        $this->negara_asal = htmlspecialchars(strip_tags($this->negara_asal));
        $this->id_rider = htmlspecialchars(strip_tags($this->id_rider));

        $stmt->bindParam(":id_team", $this->id_team);
        $stmt->bindParam(":nama", $this->nama_rider);
        $stmt->bindParam(":nomor", $this->nomor_start);
        $stmt->bindParam(":negara", $this->negara_asal);
        $stmt->bindParam(":id", $this->id_rider);

        if($stmt->execute()) return true;
        return false;
    }

    // DELETE
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_rider = ?";
        $stmt = $this->conn->prepare($query);
        $this->id_rider = htmlspecialchars(strip_tags($this->id_rider));
        $stmt->bindParam(1, $this->id_rider);

        if($stmt->execute()) return true;
        return false;
    }
}
?>