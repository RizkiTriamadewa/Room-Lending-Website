<?php
session_start();
include ('../database.php');
include ('peminjaman.php');

$db = new Database();
$peminjaman = new Peminjaman($db);

if (isset($_GET['id'])){
    $id_peminjaman = $_GET['id'];

    $query = "SELECT p.*, u.nama_usr, r.nama_ruangan 
            FROM {$peminjaman->table} p 
            JOIN user u ON p.id_usr = u.id_usr 
            JOIN ruangan r ON p.id_ruangan = r.id_ruangan 
            WHERE p.id_peminjaman= ?";
    $stmt = $db->connection->prepare($query);
    $stmt->bind_param('i', $id_peminjaman);
    $stmt->execute();
    $result = $stmt->get_result();
    $data_peminjaman = $result->fetch_assoc();    
}

if (isset($_POST['submit'])){
    $id_peminjaman = $_POST['id_peminjaman'];
    $id_usr = $_POST['id_usr'];
    $id_ruangan = $_POST['id_ruangan'];
    $tanggal_peminjaman = $_POST['tanggal_peminjaman'];

    if ($peminjaman->editPeminjaman($id_peminjaman,$id_usr, $id_ruangan, $tanggal_peminjaman)){
        header("Location: ../dashboard.php?message=edit-success");
        exit;
    } else {
        echo "<div class= 'alert alert-danger'> Data gagal diperbarui! </div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Peminjaman</h2>
        <form action="" method="post">
            <input type="hidden" name="id_peminjaman" value="<?php echo $data_peminjaman['id_peminjaman']; ?>">
            <select name="id_usr" required>
                <option value="">Pilih User</option>
                <?php
                $userResult = $db->connection->query("SELECT * FROM user");
                while ($user = $userResult->fetch_assoc()) {
                    $selected = ($user['id_usr'] == $data_peminjaman['id_usr']) ? 'selected' : '';
                    echo "<option value='" . $user['id_usr'] . "' $selected>" . $user['nama_usr'] . "</option>";
                }
                ?>
            </select>
            <select name="id_ruangan" required>
                <option value="">Pilih Ruangan</option>
                <?php
                $ruanganResult = $db->connection->query("SELECT * FROM ruangan");
                while ($ruangan = $ruanganResult->fetch_assoc()) {
                    $selected = ($ruangan['id_ruangan'] == $data_peminjaman['id_ruangan']) ? 'selected' : '';
                    echo "<option value='" . $ruangan['id_ruangan'] . "' $selected>" . $ruangan['nama_ruangan'] . "</option>";
                }
                ?>
            </select>
            <input type="date" name="tanggal_peminjaman" value="<?php echo $data_peminjaman['tanggal_peminjaman']; ?>" required>
            <button type="submit" name="submit">Update Peminjaman</button>
            <a href="../dashboard.php" class="btn btn-secondary"> Kembali </a>
        </form>
    </div>
</body>
</html>
