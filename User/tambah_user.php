<?php
session_start();
include ('../database.php');
include ('user.php'); // Mengimpor kelas User

$db = new Database();
// Membuat instansi dari kelas User
$user = new User($db);

if (isset($_POST['submit'])){
    $nama_usr = $_POST['nama_usr'];
    $username_usr = $_POST['username_usr'];
    $password_usr = $_POST['password_usr']; // Belum di-hash (sebaiknya di-hash untuk keamanan)
    
    // Simpan admin baru
    if ($user->tambahUser($nama_usr, $username_usr, $password_usr)) {
        header("Location: ../dashboard.php"); // Arahkan ke dashboard setelah berhasil
        exit();
    } else {
        echo "<div class='alert alert-danger'> Error: Gagal menyimpan user. </div>"; // Tampilkan pesan error jika ada
    }
    } 
// Mengambil data dari form


// Simpan user baru
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <h2>Tambah User</h2>
        <form action="" method="post">
            <input type="text" name="nama_usr" placeholder="Nama User" required>
            <input type="text" name="username_usr" placeholder="Username" required>
            <input type="password" name="password_usr" placeholder="Password" required>
            <button type="submit" name="submit">Simpan User</button>
            <a href="../dashboard.php" class="btn btn-secondary"> Kembali </a>

        </form>
    </div>
</body>
</html>
