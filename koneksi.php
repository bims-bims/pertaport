<?php 
// isi nama host, username mysql, dan password mysql anda
$koneksi = mysqli_connect("localhost","admin","password","db_pertamedika");
 
// isikan dengan nama database yang akan di hubungkan
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}

?>

