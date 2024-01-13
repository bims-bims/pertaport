<?php
include '../koneksi.php';

// Menangkap data dari form
$id_user = $_POST['nama_user'];
$id_devisi = $_POST['nama_devisi'];
$laporan = $_POST['laporan'];
$tanggal_pelaporan = $_POST['tanggal_pelaporan'];
$tanggal_diterima = $_POST['tanggal_diterima'];
$tanggal_proses = $_POST['tanggal_proses'];
$tanggal_selesai = $_POST['tanggal_selesai'];
$status = $_POST['status'];
$keterangan = $_POST['keterangan'];

// Periksa apakah pengguna dengan ID yang dimasukkan ada di tabel tbl_users
$checkUserQuery = "SELECT * FROM tbl_users WHERE user_id = $id_user";
$result = mysqli_query($koneksi, $checkUserQuery);

if(mysqli_num_rows($result) > 0) {
    // Pengguna ada, lanjutkan dengan memasukkan data ke tbl_pelaporan
    $insertQuery = "INSERT INTO tbl_pelaporan (id_user, id_devisi, laporan, tanggal_pelaporan, tanggal_diterima, tanggal_proses, tanggal_selesai, status, keterangan) VALUES ('$id_user', '$id_devisi', '$laporan', '$tanggal_pelaporan', '$tanggal_diterima', '$tanggal_proses', '$tanggal_selesai', '$status', '$keterangan')";
    
    if(mysqli_query($koneksi, $insertQuery)) {
        // Mengalihkan halaman kembali ke pelaporan.php
        header("location:./pelaporan.php?tambah=sukses");
    } else {
        echo "Error: " . $insertQuery . "<br>" . mysqli_error($koneksi);
    }
} else {
    echo "Pengguna dengan ID $id_user tidak ditemukan.";
}

// Menutup koneksi
mysqli_close($koneksi);
?>