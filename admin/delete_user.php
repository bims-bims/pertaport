<?php
	include '../koneksi.php';
	$id = $_GET['id'];
	$data = mysqli_query($koneksi, "DELETE FROM tbl_users WHERE user_id=$id");
	header("Location:../admin/user.php?hapus=Sukses");
?>