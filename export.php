<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
include('config.php');

// Arahan untuk menukarkan format fail kepada Excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Aset_IT.xls");
?>

<table border="1">
    <thead>
        <tr>
            <th colspan="7" style="font-size: 18px; height: 50px;">LAPORAN ASET IT - 52 CAWANGAN</th>
        </tr>
        <tr>
            <th>Bil</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>No. Siri</th>
            <th>Lokasi Semasa</th>
            <th>Tarikh Beli (In)</th>
            <th>Tarikh Keluar (Out)</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $q = mysqli_query($koneksi, "SELECT * FROM aset ORDER BY id DESC");
        while($row = mysqli_fetch_array($q)){
            echo "<tr>
                <td>".$no++."</td>
                <td>".$row['nama_barang']."</td>
                <td>".$row['kategori']."</td>
                <td>'".$row['no_siri']."</td> <td>".$row['lokasi_sekarang']."</td>
                <td>".$row['tarikh_masuk']."</td>
                <td>".$row['tarikh_keluar']."</td>
                <td>".$row['status']."</td>
            </tr>";
        }
        ?>
    </tbody>
</table>