<?php
class Motor {
    private $conn;
    private $table_name = "motors";

    public $id_motor;
    public $id_rider; // Foreign Key ke Rider
    public $merk_mesin;
    public $kapasitas_cc;
    public $top_speed_kmh;

    // Properti buat nampung nama rider hasil JOIN
    public $nama_rider_relation;

    public function __construct($db) {
        $this->conn = $db;
    }

    // READ ALL (Join ke Riders)
    public function read() {
        $query = "SELECT m.*, r.nama_rider 
                  FROM " . $this->table_name . " m
                  LEFT JOIN riders r ON m.id_rider = r.id_rider
                  ORDER BY m.id_motor ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // READ ONE
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_motor = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_motor);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $this->id_rider = $row['id_rider'];
            $this->merk_mesin = $row['merk_mesin'];
            $this->kapasitas_cc = $row['kapasitas_cc'];
            $this->top_speed_kmh = $row['top_speed_kmh'];
        }
    }

    // CREATE
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET id_rider=:id_rider, merk_mesin=:merk, kapasitas_cc=:cc, top_speed_kmh=:top";
        $stmt = $this->conn->prepare($query);

        $this->merk_mesin = htmlspecialchars(strip_tags($this->merk_mesin));

        $stmt->bindParam(":id_rider", $this->id_rider);
        $stmt->bindParam(":merk", $this->merk_mesin);
        $stmt->bindParam(":cc", $this->kapasitas_cc);
        $stmt->bindParam(":top", $this->top_speed_kmh);

        if($stmt->execute()) return true;
        return false;
    }

    // UPDATE
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET id_rider=:id_rider, merk_mesin=:merk, kapasitas_cc=:cc, top_speed_kmh=:top 
                  WHERE id_motor=:id";
        $stmt = $this->conn->prepare($query);

        $this->merk_mesin = htmlspecialchars(strip_tags($this->merk_mesin));
        $this->id_motor = htmlspecialchars(strip_tags($this->id_motor));

        $stmt->bindParam(":id_rider", $this->id_rider);
        $stmt->bindParam(":merk", $this->merk_mesin);
        $stmt->bindParam(":cc", $this->kapasitas_cc);
        $stmt->bindParam(":top", $this->top_speed_kmh);
        $stmt->bindParam(":id", $this->id_motor);

        if($stmt->execute()) return true;
        return false;
    }

    // DELETE
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_motor = ?";
        $stmt = $this->conn->prepare($query);
        $this->id_motor = htmlspecialchars(strip_tags($this->id_motor));
        $stmt->bindParam(1, $this->id_motor);

        if($stmt->execute()) return true;
        return false;
    }
}
?>