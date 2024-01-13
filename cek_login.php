<?php
// mengaktifkan session

session_start();

// menghubungkan dengan koneksi
include 'koneksi.php';

// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = md5($_POST['password']);

// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($koneksi, "select * from tbl_users where nama_user='$username' and password='$password'");

// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);

if ($cek > 0) {
    $row = mysqli_fetch_assoc($data);
    $role = $row['role'];

    if ($role == 'user') {
        $_SESSION['username'] = $username;
        $_SESSION['status'] = "login";
        header("location:user/pelaporan.php");
    } else if ($role == 'manager') {
        $_SESSION['username'] = $username;
        $_SESSION['status'] = "login";
        header("location:manager/pelaporan.php");
    } else {
        $_SESSION['username'] = $username;
        $_SESSION['status'] = "login";
        header("location:admin/pelaporan.php");
    }
} else {
    header("location:index.php?pesan=gagal");
}
?>
