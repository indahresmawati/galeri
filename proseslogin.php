<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$sql = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' AND password='$password'");

$cek = mysqli_num_rows($sql);

if ($cek > 0) {
    while($data=mysqli_fetch_array($sql)) {
    $_SESSION['userid'] = $data['userid'];
    $_SESSION['namalengkap'] = $data['namalengkap'];
    echo "<script>
    alert('Login berhasil');
    </script>";
    header("location:home.php");

    }
}

?>