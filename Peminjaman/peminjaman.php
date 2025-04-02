<?php
class Peminjaman {
    private $db;
    public $table = 'peminjaman';

    // Konstruktor untuk menginisialisasi koneksi database
    public function __construct($db) {
        $this->db = $db;
    }

    // Metode untuk menyimpan peminjaman baru
    public function tambahPeminjaman($id_usr, $id_ruangan, $tanggal_peminjaman) {
        // Siapkan pernyataan SQL
        $query = "INSERT INTO {$this->table} (id_usr, id_ruangan, tanggal_peminjaman) VALUES (?, ?, ?)";
        $stmt = $this->db->connection->prepare($query);
        $stmt->bind_param('iis', $id_usr, $id_ruangan, $tanggal_peminjaman);

        // Eksekusi pernyataan
        if ($stmt->execute()) {
            return true; // Sukses
        } else {
            return false; // Gagal
        }
    }

    // Metode untuk mendapatkan daftar peminjaman
    public function tampilPeminjaman() {
        $query = "SELECT p.*, u.nama_usr, r.nama_ruangan 
                FROM {$this->table} p
                JOIN user u ON p.id_usr = u.id_usr 
                JOIN ruangan r ON p.id_ruangan = r.id_ruangan";
        $result = $this->db->connection->query($query);
        return $result;
    }

    // Metode untuk mengedit daftar peminjaman
    public function editPeminjaman($id_peminjaman,$id_usr, $id_ruangan, $tanggal_peminjaman) {
        $query = "UPDATE peminjaman SET id_usr= ?, id_ruangan= ?, tanggal_peminjaman= ? WHERE id_peminjaman= ?";
        $stmt = $this->db->connection->prepare($query);
        $stmt->bind_param('iisi',$id_usr, $id_ruangan, $tanggal_peminjaman, $id_peminjaman);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function hapusPeminjaman($id_peminjaman) {
        $query = "DELETE FROM {$this->table} WHERE id_peminjaman=?";
        $stmt = $this->db->connection->prepare($query);
        $stmt->bind_param('i', $id_peminjaman);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>

