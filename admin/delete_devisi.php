<?php
	include '../koneksi.php';
	$id = $_GET['id'];
	$data = mysqli_query($koneksi, "DELETE FROM tbl_devisi WHERE devisi_id=$id");
	header("Location:../admin/devisi.php?hapus=Sukses");
?>