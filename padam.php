<?php 
include('config.php'); 

// Ambil ID dari URL
$id = $_GET['id'];

// Jalankan arahan buang data
$query = "DELETE FROM aset WHERE id=$id";

if(mysqli_query($koneksi, $query)){
    echo "<script>alert('Barang telah dipadam dari rekod!'); window.location='index.php';</script>";
} else {
    echo "Gagal memadam: " . mysqli_error($koneksi);
}
?>