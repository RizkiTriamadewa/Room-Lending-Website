<?php
session_start();
include ('../database.php');
include ('user.php');

$db = new Database();
$user = new User($db);

if (isset($_GET['id'])){
    $id_usr = $_GET['id'];

    $query = "SELECT * FROM {$user->table} WHERE id_usr=?";
    $stmt = $db->connection->prepare($query);
    $stmt->bind_param('i', $id_usr);
    $stmt->execute();
    $result = $stmt->get_result();
    $data_user = $result->fetch_assoc();    
}

if (isset($_POST['submit'])){
    $id_usr = $_POST['id_usr'];
    $nama_usr = $_POST['nama_usr'];
    $usermame_usr = $_POST['username_usr'];
    $password_usr = $_POST['password_usr'];

    if ($user->editUser($id_usr, $nama_usr, $usermame_usr, $password_usr)){
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
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <h2>Edit User</h2>
        <form action="" method="post">
            <input type="hidden" name="id_usr" value="<?php echo $data_user['id_usr']; ?>">
            <input type="text" name="nama_usr" value="<?php echo $data_user['nama_usr']; ?>" required>
            <input type="text" name="username_usr" value="<?php echo $data_user['username_usr']; ?>" required>
            <input type="password" name="password_usr" placeholder="Password (kosongkan jika tidak ingin mengubah)" />
            <button type="submit" name="submit">Update User</button>
            <a href="../dashboard.php" class="btn btn-secondary"> Kembali </a>
        </form>
    </div>
</body>
</html>
