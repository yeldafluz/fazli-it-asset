<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
include('config.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ringkasan Stok - IT Leader</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark mb-4 shadow-sm">
        <div class="container">
            <span class="navbar-brand fw-bold">IT ASSET STRATEGY</span>
            <div class="d-flex">
                <a href="index.php" class="btn btn-outline-light btn-sm me-2">Dashboard</a>
                <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark fw-bold mb-0">Analisis Stok Mengikut Kategori</h3>
            <a href="export_laporan.php" class="btn btn-success">
                <i class="bi bi-file-earmark-excel"></i> Export Ringkasan (Excel)
            </a>
        </div>
        
        <div class="card shadow border-0">
            <div class="card-body p-0">
                <table class="table table-bordered table-striped mb-0 text-center align-middle">
                    <thead class="table-dark text-uppercase small">
                        <tr>
                            <th class="text-start ps-4">Kategori Barang</th>
                            <th>Ready Stock (HQ)</th>
                            <th>In-Use (Outlet)</th>
                            <th>Repair (Vendor)</th>
                            <th>Jumlah Keseluruhan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query_kat = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY nama_kategori ASC");
                        while($kat = mysqli_fetch_array($query_kat)){
                            $nama_k = $kat['nama_kategori'];
                            $rs = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM aset WHERE kategori='$nama_k' AND status='Ready Stock'"));
                            $iu = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM aset WHERE kategori='$nama_k' AND status='In-Use'"));
                            $rp = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM aset WHERE kategori='$nama_k' AND status='Repair'"));
                            $total_per_kat = $rs['total'] + $iu['total'] + $rp['total'];
                        ?>
                        <tr>
                            <td class="text-start ps-4 fw-bold"><?php echo $nama_k; ?></td>
                            <td class="text-primary fw-bold"><?php echo $rs['total']; ?></td>
                            <td class="text-success fw-bold"><?php echo $iu['total']; ?></td>
                            <td class="text-danger fw-bold"><?php echo $rp['total']; ?></td>
                            <td class="bg-light fw-bold"><?php echo $total_per_kat; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4 text-center">
            <p class="text-muted small">Laporan ini dijana secara automatik berdasarkan data semasa dalam sistem.</p>
        </div>
    </div>
</body>
</html>