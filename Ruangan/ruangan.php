<?php
class Ruangan {
    private $db;
    public $table = 'ruangan';

    // Konstruktor untuk menginisialisasi koneksi database
    public function __construct($db) {
        $this->db = $db;
    }

    // Metode untuk menyimpan admin baru
    public function tambahRuangan($nama_ruangan, $kapasitas_ruangan, $status_ruangan) {
        // Siapkan pernyataan SQL
        $query = "INSERT INTO {$this->table} (nama_ruangan, kapasitas_ruangan, status_ruangan) VALUES (?, ?, ?)";
        $stmt = $this->db->connection->prepare($query);
        $stmt->bind_param('sis', $nama_ruangan, $kapasitas_ruangan, $status_ruangan);

        // Eksekusi pernyataan
        if ($stmt->execute()) {
            return true; // Sukses
        } else {
            return false; // Gagal
        }
    }

    // Metode untuk mendapatkan daftar admin
    public function tampilRuangan() {
        $query = "SELECT * FROM {$this->table}";
        $result = $this->db->connection->query($query);
        return $result;
    }

    // Metode untuk mengedit daftar admin
    public function editRuangan($id_ruangan, $nama_ruangan, $kapasitas_ruangan, $status_ruangan) {
        $query = "UPDATE ruangan SET nama_ruangan=?, kapasitas_ruangan=?, status_ruangan=? WHERE id_ruangan=?";
        $stmt = $this->db->connection->prepare($query);
        $stmt->bind_param('sisi', $nama_ruangan, $kapasitas_ruangan, $status_ruangan, $id_ruangan);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function hapusRuangan($id_ruangan) {
        $query = "DELETE FROM {$this->table} WHERE id_ruangan=?";
        $stmt = $this->db->connection->prepare($query);
        $stmt->bind_param('i', $id_ruangan);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>

