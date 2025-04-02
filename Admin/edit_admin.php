<?php
session_start();
include ('../database.php');
include ('admin.php');

$db = new Database();
$admin = new Admin($db);

if (isset($_GET['id'])){
    $id_adm = $_GET['id'];

    $query = "SELECT * FROM {$admin->table} WHERE id_adm=?";
    $stmt = $db->connection->prepare($query);
    $stmt->bind_param('i', $id_adm);
    $stmt->execute();
    $result = $stmt->get_result();
    $data_admin = $result->fetch_assoc();    
}

if (isset($_POST['submit'])){
    $id_adm = $_POST['id_adm'];
    $nama_adm = $_POST['nama_adm'];
    $usermame_adm = $_POST['username_adm'];
    $password_adm = $_POST['password_adm'];

    if ($admin->editAdmin($id_adm, $nama_adm, $usermame_adm, $password_adm)){
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
    <title>Edit admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Admin</h2>
        <form action="" method="post">
            <input type="hidden" name="id_adm" value="<?php echo $data_admin['id_adm']; ?>">
            <input type="text" name="nama_adm" value="<?php echo $data_admin['nama_adm']; ?>" required>
            <input type="text" name="username_adm" value="<?php echo $data_admin['username_adm']; ?>" required>
            <input type="password" name="password_adm" placeholder="Password (kosongkan jika tidak ingin mengubah)" />
            <button type="submit" name="submit">Update admin</button>
            <a href="../dashboard.php" class="btn btn-secondary"> Kembali </a>
        </form>
    </div>
</body>
</html>
