<?php
include 'koneksi.php';
session_start();

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

    <div class="container mt-3">
      <div class="row">
    <form action="tambahft.php" method="POST">
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Tambah</button>
        </div>
    </form>
    
        <div class="card">
          <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Judul</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Tanggal Unggah</th>
                <th scope="col">Lokasi File</th>
                <th scope="col">Album</th>
                <th scope="col">Disukai</th>
                <th scope="col">Aksi</th>
                </tr>
                    <?php
                        include 'koneksi.php';
                        $userid = $_SESSION['userid'];
                        $sql = mysqli_query($conn,  "SELECT * FROM foto,album WHERE foto.userid='$userid' AND foto.albumid=album.albumid");
                        while($data=mysqli_fetch_array($sql)) {
                    ?>
            </thead>
            
            <tbody>
                <tr>
                <td><?=$data['albumid']?></td>
                <td><?=$data['judulfoto']?></td>
                <td><?=$data['deskripsifoto']?></td>
                <td><?=$data['tanggalunggah']?></td>
                <td>
                  <img src="image/<?=$data['lokasifile']?>" width="200px">
                </td>
                <td>
                  <?=$data['namaalbum']?>
                </td>
                <td>
                    <?php
                    include 'koneksi.php';
                    $userid = $_SESSION['userid'];
                    $sql2=mysqli_query($conn, "SELECT * FROM likefoto");
                    echo mysqli_num_rows($sql2);
                    ?>
                </td>
                <td>
                    <a href="editdata.php?fotoid=<?=$data['fotoid']?>">Edit</button>
                    <a href="hapusdata.php?fotoid=<?=$data['fotoid']?>">Hapus</button>
                </td>
                </tr>
            </tbody>
            <?php } ?>
          </table>
        </div>
      </div>
    </div>

    <footer class="d-flex justify-content-center border-top- mt-3 bg-dark fixed-bottom">
      <p>&copy; Galeri Foto</p>   
    </footer>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
