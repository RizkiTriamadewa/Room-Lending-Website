<?php
session_start();
include ('../database.php');
include ('admin.php');

// Mengambil data dari form
$db = new Database();
// Buat instansi dari kelas Admin
$admin = new Admin($db);

if (isset($_POST['submit'])){
    $nama_adm = $_POST['nama_adm'];
    $username_adm = $_POST['username_adm'];
    $password_adm = $_POST['password_adm'];

    // Simpan admin baru
    if ($admin->tambahAdmin($nama_adm, $username_adm, $password_adm)) {
        header("Location: ../dashboard.php"); // Arahkan ke dashboard setelah berhasil
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
    <title>Tambah Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <h2>Tambah Admin</h2>
        <form action="" method="post">
            <input type="text" name="nama_adm" placeholder="Nama Admin" required>
            <input type="text" name="username_adm" placeholder="Username" required>
            <input type="password" name="password_adm" placeholder="Password" required>
            <button type="submit" name="submit">Simpan Admin</button>
            <a href="../dashboard.php" class="btn btn-secondary"> Kembali </a>

        </form>
    </div>
</body>
</html>
