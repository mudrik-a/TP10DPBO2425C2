<?php
class Team {
    private $conn;
    private $table_name = "teams";

    // Properti object (Sesuai kolom database)
    public $id_team;
    public $nama_team;
    public $manager;
    public $markas;

    // Constructor: Terima koneksi database
    public function __construct($db) {
        $this->conn = $db;
    }

    // 1. READ ALL (Ambil semua data team)
    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id_team ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // 2. READ ONE (Ambil 1 data untuk Edit)
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_team = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_team);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Masukkan data db ke properti object
        if($row) {
            $this->nama_team = $row['nama_team'];
            $this->manager = $row['manager'];
            $this->markas = $row['markas'];
        }
    }

    // 3. CREATE (Tambah data baru)
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nama_team=:nama, manager=:mgr, markas=:markas";
        $stmt = $this->conn->prepare($query);

        // Bersihkan data (security basic)
        $this->nama_team = htmlspecialchars(strip_tags($this->nama_team));
        $this->manager = htmlspecialchars(strip_tags($this->manager));
        $this->markas = htmlspecialchars(strip_tags($this->markas));

        // Binding data
        $stmt->bindParam(":nama", $this->nama_team);
        $stmt->bindParam(":mgr", $this->manager);
        $stmt->bindParam(":markas", $this->markas);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // 4. UPDATE (Edit data)
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nama_team=:nama, manager=:mgr, markas=:markas WHERE id_team=:id";
        $stmt = $this->conn->prepare($query);

        $this->nama_team = htmlspecialchars(strip_tags($this->nama_team));
        $this->manager = htmlspecialchars(strip_tags($this->manager));
        $this->markas = htmlspecialchars(strip_tags($this->markas));
        $this->id_team = htmlspecialchars(strip_tags($this->id_team));

        $stmt->bindParam(":nama", $this->nama_team);
        $stmt->bindParam(":mgr", $this->manager);
        $stmt->bindParam(":markas", $this->markas);
        $stmt->bindParam(":id", $this->id_team);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // 5. DELETE (Hapus data)
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_team = ?";
        $stmt = $this->conn->prepare($query);

        $this->id_team = htmlspecialchars(strip_tags($this->id_team));
        $stmt->bindParam(1, $this->id_team);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>