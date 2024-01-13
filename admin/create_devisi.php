<?php 
// koneksi database
include '../koneksi.php';
 
// menangkap data yang di kirim dari form
$nama_devisi = $_POST['nama_devisi'];


 
// menginput data ke database
mysqli_query($koneksi,"insert into tbl_devisi values('','$nama_devisi')");
 
// mengalihkan halaman kembali ke index.php
header("location:./devisi.php?tambah=sukses");
 
?>