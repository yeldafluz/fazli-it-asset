<?php
session_start();
include('config.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    
    if (mysqli_num_rows($result) === 1) {
        $_SESSION['login'] = true;
        $_SESSION['user'] = $username;
        header("Location: index.php");
        exit;
    } else {
        $error = true;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login IT Asset System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-secondary d-flex align-items-center" style="height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-lg">
                    <div class="card-body p-5 text-center">
                        <h3 class="mb-4">IT Leader Login</h3>
                        <?php if(isset($error)) echo "<div class='alert alert-danger'>Username/Password Salah!</div>"; ?>
                        <form method="POST">
                            <input type="text" name="username" class="form-control mb-3" placeholder="Username" required>
                            <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
                            <button type="submit" name="login" class="btn btn-primary w-100">Masuk Sistem</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>