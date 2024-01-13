<?php
include '../koneksi.php';

// Menangkap data dari form
$id = $_POST['id'];
$laporan = $_POST['laporan'];
$tanggal_diterima = $_POST['tanggal_diterima'];
$tanggal_proses = $_POST['tanggal_proses'];
$tanggal_selesai = $_POST['tanggal_selesai'];
$status = $_POST['status'];
$keterangan = $_POST['keterangan'];

// Periksa apakah pengguna dengan ID yang dimasukkan ada di tabel tbl_pelaporan
$updateQuery = "UPDATE tbl_pelaporan SET laporan='$laporan', tanggal_diterima='$tanggal_diterima', tanggal_proses='$tanggal_proses', tanggal_selesai='$tanggal_selesai', status='$status', keterangan='$keterangan' WHERE pelaporan_id='$id'";

if (mysqli_query($koneksi, $updateQuery)) {
    header("Location:../admin/pelaporan.php?edit=Sukses");
} else {
    echo "Error: " . $updateQuery . "<br>" . mysqli_error($koneksi);
}

// Menutup koneksi
mysqli_close($koneksi);
?>


