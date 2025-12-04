<?php
class Sponsor {
    private $conn;
    private $table_name = "sponsors";

    public $id_sponsor;
    public $id_team; // Foreign Key
    public $nama_sponsor;
    public $jenis_bidang;
    public $nilai_kontrak;
    
    // Properti tambahan untuk JOIN (biar bisa baca nama team)
    public $nama_team_relation;

    public function __construct($db) {
        $this->conn = $db;
    }

    // 1. READ ALL (Join ke tabel Teams)
    public function read() {
        // Kita join biar tahu sponsor ini milik tim mana
        $query = "SELECT s.*, t.nama_team 
                  FROM " . $this->table_name . " s
                  LEFT JOIN teams t ON s.id_team = t.id_team
                  ORDER BY s.id_sponsor DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // 2. READ ONE
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_sponsor = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_sponsor);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $this->id_team = $row['id_team'];
            $this->nama_sponsor = $row['nama_sponsor'];
            $this->jenis_bidang = $row['jenis_bidang'];
            $this->nilai_kontrak = $row['nilai_kontrak'];
        }
    }

    // 3. CREATE
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET id_team=:id_team, nama_sponsor=:nama, jenis_bidang=:jenis, nilai_kontrak=:nilai";
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->nama_sponsor = htmlspecialchars(strip_tags($this->nama_sponsor));
        $this->jenis_bidang = htmlspecialchars(strip_tags($this->jenis_bidang));
        
        // Bind
        $stmt->bindParam(":id_team", $this->id_team);
        $stmt->bindParam(":nama", $this->nama_sponsor);
        $stmt->bindParam(":jenis", $this->jenis_bidang);
        $stmt->bindParam(":nilai", $this->nilai_kontrak);

        if($stmt->execute()) return true;
        return false;
    }

    // 4. UPDATE
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET id_team=:id_team, nama_sponsor=:nama, jenis_bidang=:jenis, nilai_kontrak=:nilai 
                  WHERE id_sponsor=:id";
        $stmt = $this->conn->prepare($query);

        $this->nama_sponsor = htmlspecialchars(strip_tags($this->nama_sponsor));
        $this->jenis_bidang = htmlspecialchars(strip_tags($this->jenis_bidang));
        $this->id_sponsor = htmlspecialchars(strip_tags($this->id_sponsor));

        $stmt->bindParam(":id_team", $this->id_team);
        $stmt->bindParam(":nama", $this->nama_sponsor);
        $stmt->bindParam(":jenis", $this->jenis_bidang);
        $stmt->bindParam(":nilai", $this->nilai_kontrak);
        $stmt->bindParam(":id", $this->id_sponsor);

        if($stmt->execute()) return true;
        return false;
    }

    // 5. DELETE
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_sponsor = ?";
        $stmt = $this->conn->prepare($query);
        $this->id_sponsor = htmlspecialchars(strip_tags($this->id_sponsor));
        $stmt->bindParam(1, $this->id_sponsor);

        if($stmt->execute()) return true;
        return false;
    }
}
?>