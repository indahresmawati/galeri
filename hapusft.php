<?php
include 'koneksi.php';
session_start();

$fotoid = $_GET['fotoid'];

$sql = mysqli_query($conn, "DELETE FROM foto WHERE fotoid='$fotoid'");

    echo "<script>
    alert('Berhasil dihapus');
    </script>";
    header("location:foto.php");

?>