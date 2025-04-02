<?php
session_start();
include ('../database.php');
include ('ruangan.php');

$db = new Database();
$ruangan = new Ruangan($db);

if(isset($_POST['confirm'])){
    $id_ruangan = $_GET['id'];

    if ($ruangan->hapusRuangan($id_ruangan)) {
        header("Location: ../dashboard.php?message-delete-success");
        exit();
    } else {
        echo "<div class='alert alert-danger'> Data gagal dihapus! </div>";
    }

}

if (isset($_POST['cancel'])){
    header("Location: ../dashboard.php");
    exit();
}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Ruangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container" style="margin-top: 50px;">
        <h2>Konfirmasi Hapus Ruangan</h2>
        <form action="" method="POST">
            <p>Apakah anda yakin ingin menghapus data ini?</p>
            <button type="submit" name="confirm" class="btn btn-danger">Ya, Hapus</button>
            <button type="submit" name="cancel" class="btn btn-secondary">Batal</button>
        </form>
    </div>
</body>
</html>
