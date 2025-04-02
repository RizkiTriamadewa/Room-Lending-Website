<?php
class Admin {
    private $db;
    public $table = 'admin';

    // Konstruktor untuk menginisialisasi koneksi database
    public function __construct($db) {
        $this->db = $db;
    }

    // Metode untuk menyimpan admin baru
    public function tambahAdmin($nama_adm, $username_adm, $password_adm) {
        // Siapkan pernyataan SQL
        $query = "INSERT INTO {$this->table} (nama_adm, username_adm, password_adm) VALUES (?, ?, ?)";
        $stmt = $this->db->connection->prepare($query);
        $stmt->bind_param('sss', $nama_adm, $username_adm, $password_adm);

        // Eksekusi pernyataan
        if ($stmt->execute()) {
            return true; // Sukses
        } else {
            return false; // Gagal
        }
    }

    // Metode untuk mendapatkan daftar admin
    public function tampilAdmin() {
        $query = "SELECT * FROM {$this->table}";
        $result = $this->db->connection->query($query);
        return $result;
    }

    // Metode untuk mengedit daftar admin
    public function editAdmin($id_adm, $nama_adm, $username_adm, $password_adm) {
        if (empty('password_adm')){
            $query ="UPDATE {$this->table} SET nama_adm = ?, username_adm= ? WHERE id_adm=?";
        } else {
            $password_adm = password_hash('password_adm', PASSWORD_DEFAULT); // Hash password
            $query = "UPDATE {$this->table} SET nama_adm= ?, username_adm= ?, password_adm = ? WHERE id_adm= ?";                 
        }
        $stmt = $this->db->connection->prepare($query);
        $stmt->bind_param('sssi', $nama_adm, $username_adm, $password_adm, $id_adm);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function hapusAdmin($id_adm) {
        $query = "DELETE FROM {$this->table} WHERE id_adm= ?";
        $stmt = $this->db->connection->prepare($query);
        $stmt->bind_param('i', $id_adm);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
