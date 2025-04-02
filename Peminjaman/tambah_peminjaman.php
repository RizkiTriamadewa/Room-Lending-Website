<?php
session_start();
include ('../database.php');
include ('Peminjaman.php');

// Mengambil data dari form
$db = new Database();
// Buat instansi dari kelas Admin
$peminjaman = new Peminjaman($db);

if (isset($_POST['submit'])){
    // Mengambil data dari form
    $id_usr = $_POST['id_usr'];
    $id_ruangan = $_POST['id_ruangan'];
    $tanggal_peminjaman = $_POST['tanggal_peminjaman'];

    // Simpan admin baru
    if ($peminjaman->tambahPeminjaman($id_usr, $id_ruangan, $tanggal_peminjaman)) {
        header("Location: ../dashboard_user.php"); // Arahkan ke dashboard setelah berhasil
        exit();
    } else {
        echo "<div class='alert alert-danger'> Error: Gagal menyimpan admin. </div>"; // Tampilkan pesan error jika ada
    }
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <h2>Tambah Peminjaman</h2>
        <form action="" method="post">
            <select name="id_usr" required>
                <option value="">Pilih User</option>
                <?php
                $result = $db->connection->query("SELECT * FROM user");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id_usr'] . "'>" . $row['nama_usr'] . "</option>";
                }
                ?>warning: Undefined variable $id_usr in C:\xampp\htdocs\Peminjaman\Peminjaman\tambah_peminjaman.php on line 64Warning: Undefined variable $id_ruangan in C:\xampp\htdocs\Peminjaman\Peminjaman\tambah_peminjaman.php on line
            </select>
            <select name="id_ruangan" required>
                <option value="">Pilih Ruangan</option>
                <?php
                $result = $db->connection->query("SELECT * FROM ruangan");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id_ruangan'] . "'>" . $row['nama_ruangan'] . "</option>";
                }
                ?>
            </select>
            <input type="date" name="tanggal_peminjaman" required>
            <button type="submit" name="submit">Simpan Peminjaman</button>
            <a href="../dashboard_user.php" class="btn btn-secondary"> Kembali </a>
        </form>
    </div>
</body>
</html>
