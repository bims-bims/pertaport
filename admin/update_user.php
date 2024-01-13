<?php 
// koneksi database
include '../koneksi.php';

// menangkap data yang di kirim dari form

$id = $_POST['id'];
$nama_user = $_POST['username'];
$email = $_POST['email'];
$password = md5($_POST['password']);
$role = $_POST['role'];
$created_at = $_POST['created_at'];


// update data ke database
mysqli_query($koneksi,"update tbl_users set nama_user='$nama_user', email='$email', password='$password', role='$role', created_at='$created_at' where user_id='$id'");
 
// mengalihkan halaman kembali ke index.php
header("Location:../admin/user.php?edit=Sukses");

?>
