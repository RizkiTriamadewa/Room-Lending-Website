<?php
session_start();
include ('database.php');

$db = new Database();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Menentukan apakah user atau admin yang login

    if ($role == 'admin') {
        // Query untuk admin
        $stmt = $db->connection->prepare("SELECT * FROM admin WHERE username_adm = ?");
    } else {
        // Query untuk user
        $stmt = $db->connection->prepare("SELECT * FROM user WHERE username_usr = ?");
    }

    if ($stmt === false) {
        die('Query error: ' . $db->connection->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Mengecek apakah user atau admin ada di database
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (($role == 'admin' && $password === $row['password_adm']) || ($role == 'user' && $password === $row['password_usr'])) {
            if ($role == 'admin') {
                $_SESSION['admin'] = $row['id_adm']; // Simpan ID admin di session
                header("Location: dashboard.php");
            } else {
                $_SESSION['user'] = $row['id_usr']; // Simpan ID user di session
                header("Location: dashboard_user.php");
            }
            exit();
        } else {
            $error = "Username atau password salah!";
        }
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="container" style="height: 70vh;">
            <div class="row h-100">
                <div class="col-md-4 d-flex align-items-center justify-content-center login-box p-4">
                    <div>
                        <h2>Login</h2>
                        <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
                        <form action="login.php" method="post">
                            <div class="mb-3">
                                <input type="text" name="username" class="form-control" placeholder="Username" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>
                            <div class="mb-3">
                                <select name="role" class="form-select" required>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>
                </div>

                <div class="col-md-8 d-none d-md-flex align-items-center justify-content-center text-center image-section">
    <div>
        <div class="welcome-message">
            <h1>SELAMAT DATANG DI PERPUSTAKAAN</h1>
        </div>
        <img src="Image/login-image.png" alt="Library Image" class="img-fluid" style="max-width: 100%; max-height: 300px; width: auto; height: auto; border-radius: 8px; object-fit: cover; display: block; margin: 0 auto;">
    </div>
</div>

                </div>
            </div>
        </div>
    </div>
</body>
</html>