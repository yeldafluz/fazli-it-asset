<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
include('config.php');

if(isset($_POST['add'])){
    $n = $_POST['kat'];
    mysqli_query($koneksi, "INSERT INTO kategori (nama_kategori) VALUES ('$n')");
}
if(isset($_GET['del'])){
    $id = $_GET['del'];
    mysqli_query($koneksi, "DELETE FROM kategori WHERE id=$id");
    header("Location: kategori.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Urus Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5 w-50">
        <div class="card shadow border-0 mb-4">
            <div class="card-header bg-dark text-white">Tambah Kategori</div>
            <div class="card-body">
                <form method="POST" class="d-flex">
                    <input type="text" name="kat" class="form-control me-2" placeholder="Nama Kategori..." required>
                    <button name="add" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
        <div class="card shadow border-0">
            <table class="table mb-0">
                <thead><tr><th>Nama Kategori</th><th>Aksi</th></tr></thead>
                <tbody>
                    <?php $q = mysqli_query($koneksi, "SELECT * FROM kategori"); while($r = mysqli_fetch_array($q)){ ?>
                        <tr><td><?php echo $r['nama_kategori']; ?></td><td><a href="kategori.php?del=<?php echo $r['id']; ?>" class="text-danger">Padam</a></td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <a href="index.php" class="btn btn-link mt-3 text-decoration-none">← Kembali</a>
    </div>
</body>
</html>