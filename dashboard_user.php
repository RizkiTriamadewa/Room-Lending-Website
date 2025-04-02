<?php
session_start();
include ('database.php');
include ('Ruangan/ruangan.php');

$db = new Database();
$ruangan = new Ruangan($db);
$data_ruangan = $ruangan->tampilRuangan();

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Dashboard User</h2>
        <p>Selamat datang, User!</p>

        <!-- Tambahkan tautan logout -->
        <p><a href="login.php">Logout</a></p>
        
        <h3>Daftar Ruangan Tersedia</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama Ruangan</th>
                    <th>Kapasitas</th>
                    <th>Ketersediaan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $data_ruangan->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['nama_ruangan']; ?></td>
                    <td><?php echo $row['kapasitas_ruangan']; ?></td>
                    <td><?php echo $row['status_ruangan']; ?></td>
                    <td>
                        <a href="Peminjaman/tambah_peminjaman.php?id_ruangan=<?php echo $row['id_ruangan']; ?>" class="btn btn-primary">Pinjam</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
