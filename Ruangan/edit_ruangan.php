<?php
session_start();
include ('../database.php');
include ('ruangan.php');

$db = new Database();
$ruangan = new Ruangan($db);

if (isset($_GET['id'])){
    $id_ruangan = $_GET['id'];

    $query = "SELECT * FROM {$ruangan->table} WHERE id_ruangan=?";
    $stmt = $db->connection->prepare($query);
    $stmt->bind_param('i', $id_ruangan);
    $stmt->execute();
    $result = $stmt->get_result();
    $data_ruangan = $result->fetch_assoc();    
}

if (isset($_POST['submit'])){
    $id_ruangan = $_POST['id_ruangan'];
    $nama_ruangan = $_POST['nama_ruangan'];
    $kapasitas_ruangan = $_POST['kapasitas_ruangan'];
    $status_ruangan = $_POST['status_ruangan'];

    if ($ruangan->editRuangan($id_ruangan, $nama_ruangan, $kapasitas_ruangan, $status_ruangan)){
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
    <title>Edit Ruangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Ruangan</h2>
        <form action="" method="post">
            <input type="hidden" name="id_ruangan" value="<?php echo $data_ruangan['id_ruangan']; ?>">
            <input type="text" name="nama_ruangan" value="<?php echo $data_ruangan['nama_ruangan']; ?>" required>
            <input type="number" name="kapasitas_ruangan" value="<?php echo $data_ruangan['kapasitas_ruangan']; ?>" required>
            <select name="status_ruangan" required>
                <option value="Tersedia" <?php if($data_ruangan['status_ruangan'] == 'Tersedia') echo 'selected'; ?>>Tersedia</option>
                <option value="Sedang digunakan" <?php if($data_ruangan['status_ruangan'] == 'Sedang digunakan') echo 'selected'; ?>>Sedang digunakan</option>
                <option value="Sedang diperbaiki" <?php if($data_ruangan['status_ruangan'] == 'Sedang diperbaiki') echo 'selected'; ?>>Sedang diperbaiki</option>
            </select>
            <button type="submit" name="submit">Update Ruangan</button>
            <a href="../dashboard.php" class="btn btn-secondary"> Kembali </a>
        </form>
    </div>
</body>
</html>
