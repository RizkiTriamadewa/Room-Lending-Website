<?php
session_start();
include ('../database.php');
include ('ruangan.php');

// Mengambil data dari form
$db = new Database();
// Buat instansi dari kelas Admin
$ruangan = new Ruangan($db);

if (isset($_POST['submit'])){
    $nama_ruangan = $_POST['nama_ruangan'];
    $kapasitas_ruangan = $_POST['kapasitas_ruangan'];
    $status_ruangan = $_POST['status_ruangan'];
    
    // Simpan admin baru
    if ($ruangan->tambahRuangan($nama_ruangan, $kapasitas_ruangan, $status_ruangan)) {
        header("Location: ../dashboard.php"); // Arahkan ke dashboard setelah berhasil
        exit();
    } else {
        echo "<div class='alert alert-danger'> Error: Gagal menyimpan ruangan. </div>"; // Tampilkan pesan error jika ada
    }
} 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Ruangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <h2>Tambah Ruangan</h2>
        <form action="" method="post">
            <input type="text" name="nama_ruangan" placeholder="Nama Ruangan" required>
            <input type="number" name="kapasitas_ruangan" placeholder="Kapasitas Ruangan" required>
            <select name="status_ruangan" required>
                <option value="Tersedia">Tersedia</option>
                <option value="Sedang digunakan">Sedang digunakan</option>
                <option value="Sedang diperbaiki">Sedang diperbaiki</option>
            </select>
            <button type="submit" name="submit">Simpan Ruangan</button>
            <a href="../dashboard.php" class="btn btn-secondary"> Kembali </a>

        </form>
    </div>
</body>
</html>
