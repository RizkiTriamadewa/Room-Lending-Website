<?php
class User {
    private $db;
    public $table = 'user';

    // Konstruktor untuk menginisialisasi koneksi database
    public function __construct($db) {
        $this->db = $db;
    }

    // Metode untuk menyimpan admin baru
    public function tambahUser($nama_usr, $username_usr, $password_usr) {
        // Siapkan pernyataan SQL
        $query = "INSERT INTO {$this->table} (nama_usr, username_usr, password_usr) VALUES (?, ?, ?)";
        $stmt = $this->db->connection->prepare($query);
        $stmt->bind_param('sss',  $nama_usr, $username_usr, $password_usr);

        // Eksekusi pernyataan
        if ($stmt->execute()) {
            return true; // Sukses
        } else {
            return false; // Gagal
        }
    }

    // Metode untuk mendapatkan daftar admin
    public function tampilUser() {
        $query = "SELECT * FROM {$this->table}";
        $result = $this->db->connection->query($query);
        return $result;
    }

    // Metode untuk mengedit daftar admin
    public function editUser($id_usr, $nama_usr, $username_usr, $password_usr) {
        if (empty('password_adm')){
            $query ="UPDATE {$this->table} SET nama_usr = ?, username_usr= ? WHERE id_usr=?";
        } else {
            $password_usr = password_hash('password_usr', PASSWORD_DEFAULT); // Hash password
            $query = "UPDATE {$this->table} SET nama_usr= ?, username_usr= ?, password_usr = ? WHERE id_usr= ?";                 
        }
        $stmt = $this->db->connection->prepare($query);
        $stmt->bind_param('sssi',$nama_usr, $username_usr, $password_usr, $id_usr);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function hapusUser($id_usr) {
        $query = "DELETE FROM {$this->table} WHERE id_usr= ?";
        $stmt = $this->db->connection->prepare($query);
        $stmt->bind_param('i', $id_usr);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>

