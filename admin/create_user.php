<?php 
// koneksi database
include '../koneksi.php';
 
// menangkap data yang di kirim dari form
$nama_user = $_POST['username'];
$email = $_POST['email'];
$password = md5($_POST['password']);
$role = $_POST['role'];
$created_at = $_POST['created_at'];

 
// menginput data ke database
mysqli_query($koneksi,"insert into tbl_users values('','$nama_user','$email','$password','$role','$created_at')");
 
// mengalihkan halaman kembali ke index.php
header("location:./user.php?tambah=sukses");
 
?>