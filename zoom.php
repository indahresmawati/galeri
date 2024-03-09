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
                          <span class="badge bg-secondary"><?=$data['namalengkap']?></span>
                          <span class="badge bg-secondary"><?=$data['tanggalunggah']?></span>
                          <span class="badge bg-primary"><?=$data['namaalbum']?></span>
                        </div>
                        <hr>
                        <p align="left">
                        <?=$data['deskripsifoto']?>
                        </p>
                        <hr>
                        <?php
                            $fotoid = $data['fotoid'];
                            $komentar = mysqli_query($conn, "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'");
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
