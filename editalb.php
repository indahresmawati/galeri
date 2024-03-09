<?php
session_start();
include 'koneksi.php';

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>galeri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
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

    <form action="updatealb.php" method="POST">
    <?php
        include 'koneksi.php';
        $albumid = $_GET['albumid'];
        $sql = mysqli_query($conn,  "SELECT * FROM album WHERE albumid='$albumid'");
        while($data=mysqli_fetch_array($sql)) {
    ?>
    <input type="text" name="albumid" value="<?=$data['albumid']?>" hidden>
    <div class="container mt-3">
      <div class="row">
          <div class="card">
          <div class="mb-3">
            <label for="" class="form-label">Nama Album</label>
            <input type="text" class="form-control" name="namaalbum" value="<?=$data['namaalbum']?>">
          </div>
          <div class="mb-3">
            <label for="" class="form-label">Deskripsi</label>
            <input type="text" class="form-control" name="deskripsi" value="<?=$data['deskripsi']?>">
          </div>
          <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Simpan</button>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
</from>

    <footer class="d-flex justify-content-center border-top- mt-3 bg-dark fixed-bottom">
      <p>&copy; Galeri Foto</p>   
    </footer>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
