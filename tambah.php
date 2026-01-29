<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
include('config.php');

if(isset($_POST['submit'])){
    $n = $_POST['nama']; $k = $_POST['kat']; $s = $_POST['siri']; 
    $l = $_POST['lokasi']; $st = $_POST['status']; $t = $_POST['tkh_masuk'];
    
    mysqli_query($koneksi, "INSERT INTO aset (nama_barang, kategori, no_siri, lokasi_sekarang, status, tarikh_masuk) 
                            VALUES ('$n', '$k', '$s', '$l', '$st', '$t')");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5 w-50">
        <div class="card shadow border-0">
            <div class="card-header bg-primary text-white">Daftar Aset Baru (Barang Masuk)</div>
            <div class="card-body p-4">
                <form method="POST">
                    <div class="mb-3"><label class="form-label">Nama Barang</label><input type="text" name="nama" class="form-control" placeholder="Contoh: Receipt Printer" required></div>
                    <div class="mb-3"><label class="form-label">Kategori</label>
                        <select name="kat" class="form-select">
                            <?php $k_q = mysqli_query($koneksi, "SELECT * FROM kategori"); while($rk = mysqli_fetch_array($k_q)) { echo "<option value='".$rk['nama_kategori']."'>".$rk['nama_kategori']."</option>"; } ?>
                        </select>
                    </div>
                    <div class="mb-3"><label class="form-label">Serial Number</label><input type="text" name="siri" class="form-control" required></div>
                    <div class="mb-3">
                        <label class="form-label">Lokasi Asal</label>
                        <input type="text" name="lokasi" class="form-control" value="Control Room">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tarikh Pembelian</label>
                        <input type="date" name="tkh_masuk" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                        <small class="text-muted text-primary">*Anda boleh tukar tarikh mengikut tarikh pembelian asal.</small>
                    </div>
                    <div class="mb-4"><label class="form-label">Status Awal</label>
                        <select name="status" class="form-select">
                            <option value="Ready Stock">Ready Stock (Dalam HQ)</option>
                            <option value="In-Use">In-Use (Terus Deployment)</option>
                        </select>
                    </div>
                    <button name="submit" class="btn btn-primary w-100 mb-2">Simpan Rekod Masuk</button>
                    <a href="index.php" class="btn btn-light border w-100">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>