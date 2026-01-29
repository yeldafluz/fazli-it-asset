<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
include('config.php');

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Ringkasan_Stok_Kategori.xls");
?>

<table border="1">
    <thead>
        <tr>
            <th colspan="5" style="font-size: 16px; height: 40px; background-color: #f2f2f2;">RINGKASAN STOK MENGIKUT KATEGORI</th>
        </tr>
        <tr>
            <th style="background-color: #333; color: white;">Kategori</th>
            <th style="background-color: #333; color: white;">Ready Stock (HQ)</th>
            <th style="background-color: #333; color: white;">In-Use (Outlet)</th>
            <th style="background-color: #333; color: white;">Repair (Vendor)</th>
            <th style="background-color: #333; color: white;">Jumlah Keseluruhan</th>
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
            $total = $rs['total'] + $iu['total'] + $rp['total'];

            echo "<tr>
                <td><b>".$nama_k."</b></td>
                <td>".$rs['total']."</td>
                <td>".$iu['total']."</td>
                <td>".$rp['total']."</td>
                <td>".$total."</td>
            </tr>";
        }
        ?>
    </tbody>
</table>