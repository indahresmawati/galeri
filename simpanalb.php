<?php
session_start();
include 'koneksi.php';

$namaalbum = $_POST['namaalbum'];
$deskripsi = $_POST['deskripsi'];
$tanggaldibuat = date('Y-m-d');
$userid = $_SESSION['userid'];

$sql = mysqli_query($conn, "INSERT INTO album VALUES('','$namaalbum','$deskripsi','$tanggaldibuat','$userid')");

    echo "<script>
    alert('Berhasil disimpan');
    </script>";

header("location:album.php");
?>