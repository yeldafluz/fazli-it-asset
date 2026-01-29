<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
include('config.php');
$id = $_GET['id'];
$d = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM aset WHERE id=$id"));

if(isset($_POST['update'])){
    $l = $_POST['lokasi']; 
    $st = $_POST['status']; 
    $t_out = $_POST['tkh_keluar'];
    $t_in = $_POST['tkh_masuk']; // Ambil data tarikh masuk yang baru jika diubah
    
    // Kemaskini kedua-dua tarikh sekali gus
    mysqli_query($koneksi, "UPDATE aset SET 
        lokasi_sekarang='$l', 
        status='$st', 
        tarikh_keluar='$t_out', 
        tarikh_masuk='$t_in' 
        WHERE id=$id");
        
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Pergerakan Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5 w-50">
        <div class="card shadow border-0">
            <div class="card-header bg-warning">Update & Pembetulan Data: <?php echo $d['nama_barang']; ?></div>
            <div class="card-body p-4">
                
                <form method="POST">
                    <div class="alert alert-secondary border-0">
                        <label class="form-label fw-bold text-dark">Pembetulan Tarikh Masuk HQ (Jika Tersilap):</label>
                        <input type="date" name="tkh_masuk" class="form-control mb-1" value="<?php echo $d['tarikh_masuk']; ?>">
                        <small class="text-muted italic">*Hanya ubah jika tarikh pembelian asal salah.</small>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Pindah Ke (Outlet / Vendor)</label>
                        <input type="text" name="lokasi" class="form-control" value="<?php echo $d['lokasi_sekarang']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-danger">Tarikh Keluar / Update (Wajib Isi)</label>
                        <input type="date" name="tkh_keluar" class="form-control border-danger" value="<?php echo ($d['tarikh_keluar'] != '0000-00-00') ? $d['tarikh_keluar'] : date('Y-m-d'); ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Status Semasa</label>
                        <select name="status" class="form-select">
                            <option value="In-Use" <?php if($d['status']=='In-Use') echo 'selected'; ?>>In-Use (Di Outlet)</option>
                            <option value="Repair" <?php if($d['status']=='Repair') echo 'selected'; ?>>Repair (Di Vendor)</option>
                            <option value="Ready Stock" <?php if($d['status']=='Ready Stock') echo 'selected'; ?>>Ready Stock (Dalam HQ)</option>
                        </select>
                    </div>

                    <div class="row g-2">
                        <div class="col-6">
                            <button name="update" class="btn btn-warning w-100 fw-bold">Simpan Perubahan</button>
                        </div>
                        <div class="col-6">
                            <a href="index.php" class="btn btn-secondary w-100">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>