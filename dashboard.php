<?php
session_start();
include ('database.php');
include ('Admin/admin.php');
include ('User/user.php');
include ('Peminjaman/peminjaman.php');
include ('Ruangan/ruangan.php');

// Pastikan admin sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$db = new Database();
$admin = new Admin($db);
$user = new User($db);
$peminjaman = new Peminjaman($db);
$ruangan = new Ruangan($db);
$data_admin = $admin->tampilAdmin();
$data_user = $user->tampilUser();
$data_ruangan = $ruangan->tampilRuangan();
$data_peminjaman = $peminjaman->tampilPeminjaman();


//cek apakah ada pesan sukses
$message = isset($_GET['message']) ? $_GET['message'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Dashboard Admin</h2>

        <?php if ($message == 'success'): ?>
            <div class="alert alert-success">
                Data berhasil ditambahkan!
            </div>
        <?php elseif ($message == 'edit-success'): ?>
            <div class="alert alert-success">
                Data berhasil diperbarui!
            </div>
        <?php elseif ($message == 'delete-success'): ?>
            <div class="alert alert-success">
                Data berhasil dihapus!
            </div>
        <?php endif; ?>
        

        <h3>Data Ruangan</h3>
        <a href="Ruangan/tambah_ruangan.php" class="btn btn-primary mb-2">Tambah Ruangan</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Ruangan</th>
                    <th>Nama Ruangan</th>
                    <th>Kapasitas</th>
                    <th>Ketersediaan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $data_ruangan->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id_ruangan']; ?></td>
                        <td><?php echo $row['nama_ruangan']; ?></td>
                        <td><?php echo $row['kapasitas_ruangan']; ?></td>
                        <td><?php echo $row['status_ruangan']; ?></td>
                        <td>
                            <a href="Ruangan/edit_ruangan.php?id=<?php echo $row['id_ruangan']; ?>" class="btn btn-warning btn-sm">Edit</a> 
                            <a href="Ruangan/hapus_ruangan.php?id=<?php echo $row['id_ruangan']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <h3>Data Admin</h3>
        <a href="Admin/tambah_admin.php" class="btn btn-primary mb-2">Tambah Admin</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Admin</th>
                    <th>Nama Admin</th>
                    <th>Username</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $data_admin->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id_adm']; ?></td>
                        <td><?php echo $row['nama_adm']; ?></td>
                        <td><?php echo $row['username_adm']; ?></td>
                        <td>
                            <a href="Admin/edit_admin.php?id=<?php echo $row['id_adm']; ?>" class="btn btn-warning btn-sm">Edit</a> 
                            <a href="Admin/hapus_admin.php?id=<?php echo $row['id_adm']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <h3>Data User</h3>
        <a href="User/tambah_user.php" class="btn btn-primary mb-2">Tambah User</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID User</th>
                    <th>Nama User</th>
                    <th>Username</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $data_user->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id_usr']; ?></td>
                        <td><?php echo $row['nama_usr']; ?></td>
                        <td><?php echo $row['username_usr']; ?></td>
                        <td>
                            <a href="User/edit_user.php?id=<?php echo $row['id_usr']; ?>" class="btn btn-warning btn-sm">Edit</a> 
                            <a href="User/hapus_user.php?id=<?php echo $row['id_usr']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <h3>Data Peminjaman</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Peminjaman</th>
                    <th>Nama User</th>
                    <th>Nama Ruangan</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $data_peminjaman->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id_peminjaman']; ?></td>
                        <td><?php echo $row['nama_usr']; ?></td>
                        <td><?php echo $row['nama_ruangan']; ?></td>
                        <td><?php echo $row['tanggal_peminjaman']; ?></td>
                        <td>
                            <a href="Peminjaman/edit_peminjaman.php?id=<?php echo $row['id_peminjaman']; ?>" class="btn btn-warning btn-sm">Edit</a> 
                            <a href="Peminjaman/hapus_peminjaman.php?id=<?php echo $row['id_peminjaman']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="login.php" class="btn btn-danger mt-3">Logout</a>
    </div>
</body>
</html>
