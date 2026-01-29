<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
include('config.php');
?>
<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Asset HQ - Dashboard Utama</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-stats { border-top: 5px solid; }
        .table-middle td { vertical-align: middle; }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark mb-4 shadow-sm">
        <div class="container">
            <span class="navbar-brand fw-bold">IT LEADER ASSET TRACKER</span>
            <div class="d-flex">
                <a href="laporan.php" class="btn btn-primary btn-sm me-2">Laporan Stok</a>
                <a href="kategori.php" class="btn btn-outline-light btn-sm me-2">Urus Kategori</a>
                <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        
        <?php
        $count_all = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM aset"));
        $count_in_use = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM aset WHERE status='In-Use'"));
        $count_ready = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM aset WHERE status='Ready Stock'"));
        $count_repair = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM aset WHERE status='Repair'"));
        ?>
        <div class="row mb-4 g-3 text-center">
            <div class="col-md-3">
                <div class="card p-3 shadow-sm border-0 card-stats border-dark h-100">
                    <small class="text-muted text-uppercase">Jumlah Aset</small>
                    <h3 class="mb-0 text-dark"><?php echo $count_all; ?></h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3 shadow-sm border-0 card-stats border-success h-100">
                    <small class="text-muted text-uppercase">In-Use (Outlet)</small>
                    <h3 class="mb-0 text-success"><?php echo $count_in_use; ?></h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3 shadow-sm border-0 card-stats border-primary h-100">
                    <small class="text-muted text-uppercase">Ready Stock (HQ)</small>
                    <h3 class="mb-0 text-primary"><?php echo $count_ready; ?></h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3 shadow-sm border-0 card-stats border-danger h-100">
                    <small class="text-muted text-uppercase">Dalam Repair</small>
                    <h3 class="mb-0 text-danger"><?php echo $count_repair; ?></h3>
                </div>
            </div>
        </div>

        <div class="card shadow border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">Senarai Aset Terperinci</h5>
                <div class="d-flex">
                    <form method="GET" class="d-flex me-2">
                        <input type="text" name="cari" class="form-control form-control-sm me-2" placeholder="Cari S/N, Lokasi..." value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>">
                        <button class="btn btn-dark btn-sm">Filter</button>
                    </form>

                    <a href="export.php" class="btn btn-success btn-sm me-2">Export Excel</a>

                    <a href="tambah.php" class="btn btn-success btn-sm">+ Tambah Barang</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-middle mb-0">
                        <thead class="table-light text-uppercase small">
                            <tr>
                                <th class="ps-3">Barang / Kategori</th>
                                <th>No. Siri</th>
                                <th>Lokasi Semasa</th>
                                <th>Tarikh Beli</th>
                                <th>Tarikh Keluar</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $where = "";
                            if(isset($_GET['cari']) && $_GET['cari'] != '') {
                                $c = mysqli_real_escape_string($koneksi, $_GET['cari']);
                                $where = " WHERE no_siri LIKE '%$c%' OR lokasi_sekarang LIKE '%$c%' OR nama_barang LIKE '%$c%'";
                            }
                            
                            $q = mysqli_query($koneksi, "SELECT * FROM aset $where ORDER BY id DESC");
                            
                            if(mysqli_num_rows($q) == 0){
                                echo "<tr><td colspan='7' class='text-center py-4 text-muted small'>Tiada rekod dijumpai.</td></tr>";
                            }

                            while($row = mysqli_fetch_array($q)){
                                // Logik Warna Status
                                $badge_class = "bg-secondary";
                                if($row['status'] == 'In-Use') $badge_class = "bg-success";
                                if($row['status'] == 'Ready Stock') $badge_class = "bg-primary text-white";
                                if($row['status'] == 'Repair') $badge_class = "bg-danger";

                                $tkh_out = ($row['tarikh_keluar'] == '0000-00-00' || $row['tarikh_keluar'] == null) ? '<span class="text-muted small">-</span>' : $row['tarikh_keluar'];
                                
                                echo "<tr>
                                    <td class='ps-3'>
                                        <div class='fw-bold'>".$row['nama_barang']."</div>
                                        <small class='text-muted'>".$row['kategori']."</small>
                                    </td>
                                    <td><code>".$row['no_siri']."</code></td>
                                    <td>".$row['lokasi_sekarang']."</td>
                                    <td>".$row['tarikh_masuk']."</td>
                                    <td>".$tkh_out."</td>
                                    <td><span class='badge $badge_class'>".$row['status']."</span></td>
                                    <td class='text-center py-3'>
                                        <div class='btn-group' role='group'>
                                            <a href='edit.php?id=".$row['id']."' class='btn btn-warning btn-sm'>Update</a>
                                            <a href='padam.php?id=".$row['id']."' class='btn btn-outline-danger btn-sm' onclick='return confirm(\"Padam rekod ini?\")'>X</a>
                                        </div>
                                    </td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <footer class="text-center mt-5 mb-4 text-muted small">
            &copy; 2024 IT Asset Management System | 52 Cawangan HQ
        </footer>
    </div>

</body>
</html>