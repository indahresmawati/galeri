<?php
include 'koneksi.php';
session_start();

$judulfoto = $_POST['judulfoto'];
$deskripsifoto = $_POST['deskripsifoto'];
$albumid = $_POST['albumid'];

if($_FILES['lokasifile']['tmp_name'] == ""){
    $rand = rand();
    $ekstensi = array('png','jpg','jpeg','gif');
    $filename = $_FILES['lokasifile']['name'];
    $ukuran = $_FILES['lokasifile']['size'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    
    if(!in_array($ext, $ekstensi)) {
        header("location:foto.php");
    }else{
        if($ukuran < 1044070){
            $xx = $rand.'-'.$filename;
            move_uploaded_file($_FILES['lokasifile']['tmp_name'], 'image/'.$rand.'-'.$filename);
            mysqli_query($conn, "UPDATE foto SET judulfoto='$judulfoto', deskripsifoto='$deskripsifoto', lokasifile='$lokasifile', '$xx','$albumid'");
            header("location:foto.php");
        }else{
            header("location:foto.php");
        }
    }
    
    }else{
        mysqli_query($conn, "UPDATE foto SET judulfoto='$judulfoto', deskripsifoto='$deskripsifoto'");
        header("location:foto.php");
    }

?>