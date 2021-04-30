<section id="blog-header">
  <div class="container">
    <h1 class="text-white">DAFTAR BUKU</h1>
  </div>
</section><br><br>

<?php
if (isset($_GET['data'])) {
  $id_kategori_buku = $_GET['data'];
  $sql = "SELECT `kategori_buku` FROM `kategori_buku` WHERE `id_kategori_buku` = '$id_kategori_buku'";
  $query = mysqli_query($koneksi, $sql);
  while ($data_b = mysqli_fetch_row($query)) {
    $kategori_buku = $data_b[0];
  }
?>

  <section id="katalog-item">
    <main role="main" class="container">
      <h2 class="text-primary">CATEGORIES: <?php echo $kategori_buku ?> </h2><br><br>
      <div class="row">
        <div class="col-md-9 katalog-main">
          <div class="row">

            <?php
            $batas = 2;
            if (!isset($_GET['halaman'])) {
              $posisi = 0;
              $halaman = 1;
            } else {
              $halaman = $_GET['halaman'];
              $posisi = ($halaman - 1) * $batas;
            }

            $sql_b = "SELECT `b`.`id_buku`, `b`.`judul`, `k`.`kategori_buku`, `p`.`penerbit`, `b`.`cover` FROM `buku` `b` 
              INNER JOIN `kategori_buku` `k` ON `b`.`id_kategori_buku` = `k`.`id_kategori_buku` 
              INNER JOIN `penerbit` `p` ON `b`.`id_penerbit` = `p`.`id_penerbit` 
              WHERE `b`.`id_kategori_buku` = '$id_kategori_buku'";
            $sql_b .= " ORDER BY `k`.`kategori_buku` limit $posisi, $batas ";
            $query_b = mysqli_query($koneksi, $sql_b);
            $posisi = 1;
            $jum_b = mysqli_num_rows($sql_b);
            $hasil = ceil($jum_b);
            while ($data_b = mysqli_fetch_row($query_b)) {
              $id_buku = $data_b[0];
              $judul = $data_b[1];
              $kategori_buku = $data_b[2];
              $penerbit = $data_b[3];
              $cover = $data_b[4];
            ?>

              <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                  <img src="admin/cover/<?php echo $cover; ?>" class="img-fluid" alt="<?php echo $judul; ?>" title="<?php echo $judul; ?>">
                  <div class="card-body bg-warning">
                    <p class="card-text"> <?php echo $judul ?> </p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                        <a href="index.php?include=detail-buku&data=<?php echo $id_buku ?>" class="btn btn-primary">Detail</a>
                      </div>
                      <small class="text-muted"> <?php echo $penerbit ?> </small>
                    </div>
                  </div>

                </div>
              </div>
            <?php }
          } else if (isset($_GET['data-tag'])) {
            $id_tag = $_GET['data-tag'];
            $sql = "SELECT `tag` FROM `tag` WHERE `id_tag` = '$id_tag'";
            $query = mysqli_query($koneksi, $sql);
            while ($data_b = mysqli_fetch_row($query)) {
              $tag = $data_b[0];
            }
            ?>

            <section id="katalog-item">
              <main role="main" class="container">
                <h2 class="text-primary">TAG: <?php echo $tag ?> </h2><br><br>
                <div class="row">
                  <div class="col-md-9 katalog-main">
                    <div class="row">

                      <?php
                      $sql_b = "SELECT `b`.`id_buku`, `b`.`judul`, `k`.`kategori_buku`, `p`.`penerbit`, `b`.`cover`, `t`.`tag` FROM `buku` `b` 
                                INNER JOIN `kategori_buku` `k` ON `b`.`id_kategori_buku` = `k`.`id_kategori_buku` 
                                INNER JOIN `penerbit` `p` ON `b`.`id_penerbit` = `p`.`id_penerbit` 
                                INNER JOIN `tag_buku` `tb` ON `b`.`id_buku` = `tb`.`id_buku` 
                                INNER JOIN `tag` `t` ON `tb`.`id_tag` = `t`.`id_tag` 
                                WHERE `t`.`id_tag` = '$id_tag'";

                      $sql_b .= " ORDER BY `k`.`kategori_buku` limit $posisi, $batas ";
                      $query_b = mysqli_query($koneksi, $sql_b);
                      $posisi = 1;
                      while ($data_b = mysqli_fetch_row($query_b)) {
                        $id_buku = $data_b[0];
                        $judul = $data_b[1];
                        $kategori_buku = $data_b[2];
                        $penerbit = $data_b[3];
                        $cover = $data_b[4];
                        $tag = $data_b[5];
                      ?>

                        <div class="col-md-4">
                          <div class="card mb-4 shadow-sm">
                            <img src="admin/cover/<?php echo $cover; ?>" class="img-fluid" alt="<?php echo $judul; ?>" title="<?php echo $judul; ?>">
                            <div class="card-body bg-warning">
                              <p class="card-text"> <?php echo $judul ?> </p>
                              <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                  <a href="index.php?include=detail-buku&data=<?php echo $id_buku ?>" class="btn btn-primary">Detail</a>
                                </div>
                                <small class="text-muted"> <?php echo $penerbit ?> </small>
                              </div>
                            </div>

                          </div>
                        </div>
                    <?php }
                    } ?>



                    </div><!-- .row-->

                    <nav class="blog-pagination">
                      <!-- <a class="btn btn-outline-primary" href="#">Older</a>
                      <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Newer</a> -->
                      <?php
                      $query_b = "SELECT `b`.`id_buku`, `b`.`judul`, `k`.`kategori_buku`, `p`.`penerbit`, `b`.`cover` FROM `buku` `b` 
                      INNER JOIN `kategori_buku` `k` ON `b`.`id_kategori_buku` = `k`.`id_kategori_buku` 
                      INNER JOIN `penerbit` `p` ON `b`.`id_penerbit` = `p`.`id_penerbit` 
                      WHERE `b`.`id_kategori_buku` = '$id_kategori_buku'";
                      $query_b .= "ORDER BY `k`.`kategori_blog`, `b`.`judul`";
                      $query_jum = mysqli_query($koneksi, $sql_b);
                      $jum_data = mysqli_num_rows($query_jum);
                      $jum_halaman = ceil($jum_data / $batas);

                      if ($jum_halaman == 0) {
                        echo 'tidak ada halaman';
                      } else if ($jum_halaman == 1) {
                        echo "<a class='page-link' href='index.php?include=buku&halaman=$sebelum'>Newer</a>";
                        echo "<a class='page-link' href='index.php?include=buku&halaman=$setelah'>Older</a>";
                      } else {
                        $sebelum = $halaman - 1;
                        $setelah = $halaman + 1;

                        if ($halaman != 1) {
                          echo "<a class='page-link' href='index.php?include=buku&halaman=$sebelum'>Newer</a>";
                        }
                        if ($halaman != $jum_halaman) {
                          echo "<a class='page-link' href='index.php?include=buku&halaman=$setelah'>Older</a>";
                        }
                      } ?>
                    </nav>
                  </div><!-- /.katalog-main -->

                  <aside class="col-md-3 katalog-sidebar">

                    <div class="pl-4 pb-4">
                      <h4 class="font-italic">Kategori</h4>
                      <ol class="list-unstyled mb-0">
                        <?php
                        $sql_kat = "SELECT `id_kategori_buku`, `kategori_buku` FROM `kategori_buku` ";
                        $query_kat = mysqli_query($koneksi, $sql_kat);
                        while ($data_kat = mysqli_fetch_row($query_kat)) {
                          $id_kategori_buku = $data_kat[0];
                          $kategori_buku = $data_kat[1];
                        ?>
                          <li><a href="index.php?include=daftar-buku-kategori&data=<?php echo $id_kategori_buku ?>"> <?php echo $kategori_buku ?> </a></li>
                        <?php } ?>
                    </div>

                    <div class="p-4">
                      <h4 class="font-italic">Tag</h4>
                      <ol class="list-unstyled">
                        <?php
                        $sql_tag = "SELECT `id_tag`, `tag` FROM `tag`";
                        $query_tag = mysqli_query($koneksi, $sql_tag);
                        while ($data_tag = mysqli_fetch_row($query_tag)) {
                          $id_tag = $data_tag[0];
                          $tag = $data_tag[1];
                        ?>
                          <li><a href="index.php?include=daftar-buku-tag&data-tag=<?php echo $id_tag ?>"> <?php echo $tag ?> </a></li>
                        <?php } ?>
                      </ol>
                    </div>
                  </aside> <!-- /.katalog-sidebar -->

                </div><!-- /.row -->
              </main><!-- /.container -->
            </section>