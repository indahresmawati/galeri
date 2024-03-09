<?php
session_start();
include 'koneksi.php';
if(!isset($_SESSION['userid'])){
  header("location:login.php");
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>galeri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#">Galeri Foto</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse mt-2" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="home.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="foto.php">Foto</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="album.php">Album</a>
            </li>
          </ul>
           
          <a href="proseslogout.php" class="btn btn-outline-success m-1">Logout</a>        
        </div>
      </div>
    </nav>

    <h1 class="text-center">Selamat Datang <br><?=$_SESSION['namalengkap']?></h1>
    
    <div class="container mt-3">

        
        <div class="row">
          <?php
          if(isset($_GET['albumid'])){
            $albumid = $_GET['albumid'];
            $sql2 = mysqli_query($conn, "SELECT * FROM foto WHERE userid='$userid' AND albumid='$albumid'");
            while($data = mysqli_fetch_array($sql2)) { ?>
            
          <?php } }else{
        $sql = mysqli_query($conn, "SELECT * FROM foto");
        while($data = mysqli_fetch_array($sql)) {
        ?>

        <div class="col-md-3 mt-2">
          <a type="button" data-bs-toggle="modal" data-bs-target="#komentar.php?fotoid=<?=$data['fotoid']?>">
          <div class="card mb-2">
            <img src="image/<?=$data['lokasifile']?>" class="card-img-top" title="<?=$data['judulfoto']?>" width="50">
            <div class="card-footer text-center">
              <?php
              $fotoid = $data['fotoid'];
              $ceksuka = mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
              if(mysqli_num_rows($ceksuka) == 1) {
                ?>
                <a href="like.php?fotoid=<?=$data['fotoid']?>" type="submit" name="suka"><i class="fa fa-heart"></i></a>
              <?php }else{ 
                ?>
                  <a href="like.php?fotoid=<?=$data['fotoid']?>" type="submit" name="suka"><i class="fa-regular fa-heart"></i></a>
                  <?php } 
                    $like = mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                    echo mysqli_num_rows($like). ' suka';
                 ?>
                 <a href="komentar.php?fotoid=<?=$data['fotoid']?>" type="submit" name="comment"><i class="fa fa-comment"></i></a>
                            
                  <?php
                    $comment = mysqli_query($conn, "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'");
                    echo mysqli_num_rows($comment). ' komentar';
                ?>
             </div>
          </div>
          </a>

          <div class="modal fade" id="komentar.php?fotoid=<?=$data['fotoid']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-body">
                  <div class="col-md-8">
                    <img src="image/<?=$data['lokasifile']?>" class="card-img-top" title="<?=$data['judulfoto']?>">
                  </div>
                  <div class="col-md-4">
                    <div class="m-2">
                      <div class="overflow-auto">
                        <div class="sticky-top">
                          <strong><?=$data['judulfoto']?></strong><br>
                          <span class="badge bg-secondary"><?=$data['userid']?></span>
                          <span class="badge bg-secondary"><?=$data['tanggalunggah']?></span>
                          <span class="badge bg-primary"><?=$data['albumid']?></span>
                        </div>
                        <hr>
                        <p align="left">
                        <?=$data['deskripsifoto']?>
                        </p>
                        <hr>
                        <?php
                            $fotoid = $data['fotoid'];
                            $komentar = mysqli_query($conn, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid=user.userid WHERE komentarfoto.fotoid='$fotoid'");
                            while($data = mysqli_fetch_array($komentar)) {
                              ?>
                        <hr>
                        <p align="left">
                        <strong><?=$data['userid']?></strong>
                        <?=$data['isikomentar']?>
                        </p>
                              <a href="komentar.php?fotoid=<?=$data['fotoid']?>" type="submit" name="comment"><i class="fa fa-comment"></i></a>
                            
                              <?php } 
                            $comment = mysqli_query($conn, "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'");
                            echo mysqli_num_rows($comment). ' komentar';
                            ?>
                        <hr>
                        <div class="sticky-bottom">
                          <form action="komentar.php" method="POST">
                            <div class="input-group">
                            <input type="hidden" name="fotoid" value="<?=$data['fotoid']?>">  
                            <input type="text" name="isikomentar" class="form-control" placeholder="Tambah Komentar">
                            </div>
                            <div class="input-group-prepend">
                            <button type="submit" name="kirimkomentar" class="btn btn-outline-primary">Kirim</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <?php } } ?>
      </div>
    </div>


    <footer class="d-flex justify-content-center border-top mt-3 bg-dark fixed-bottom">
      <p>&copy; Galeri Foto</p>   
    </footer>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
