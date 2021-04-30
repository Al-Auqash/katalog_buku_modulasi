<section id="blog-header">
  <div class="container">
    <h1 class="text-white">BLOG</h1>
  </div>
</section><br><br>
<section id="blog-list">
  <main role="main" class="container">
    <div class="row">
      <div class="col-md-9 blog-main">
        <div class="blog-post">
          <!-- based category -->
          <?php
          $batas = 8;
          if (!isset($_GET['halaman'])) {
            $posisi = 0;
            $halaman = 1;
          } else {
            $halaman = $_GET['halaman'];
            $posisi = ($halaman - 1) * $batas;
          }

          if (isset($_GET['data'])) {
            $id_kategori_blog = $_GET['data'];
            $sql_cat = "SELECT `b`.`id_blog`, `k`.`kategori_blog`,`b`.`judul`, `p`.`nama`,`b`.`tanggal`, `b`.`isi` 
                  FROM `blog` `b` INNER JOIN `kategori_blog` `k` ON `b`.`id_kategori_blog`=`k`.`id_kategori_blog` 
                  INNER JOIN `user` `p` ON `b`.`id_user`= `p`.`id_user` WHERE `b`.`id_kategori_blog` = '$id_kategori_blog' ";
            $sql_cat .= " ORDER BY `k`.`kategori_blog` limit $posisi, $batas ";
            $query_cat = mysqli_query($koneksi, $sql_cat);
            $posisi = 1;
            while ($data_cat = mysqli_fetch_row($query_cat)) {
              $id_blog = $data_cat[0];
              $kategori_blog = $data_cat[1];
              $judul = $data_cat[2];
              $penulis = $data_cat[3];
              $tanggal = $data_cat[4];
              $isi = $data_cat[5];

          ?>

              <h2 class="blog-post-title"><a href="#"> <?php echo $judul ?> </a></h2>
              <p class="blog-post-meta"><?php echo $tanggal ?> by <a href="#"> <?php echo $penulis ?> </a></p>
              <!-- <img src="slideshow/slide-1.jpg" class="img-fluid" alt="Responsive image"><br><br> -->

              <p><?php echo $isi ?></p>
              <a href="index.php?include=detail-blog&data=<?php echo $id_blog; ?>" class="btn btn-primary">Continue reading..</a>

            <?php } ?>
        </div><!-- /.blog-post --><br><br>
        <?php } else if (isset($_GET['data-archive'])) {
            $data_archive = $_GET['data-archive'];
            $sql_cat = "SELECT `b`.`id_blog`, `k`.`kategori_blog`,`b`.`judul`, `p`.`nama`,`b`.`tanggal`, `b`.`isi` 
                  FROM `blog` `b` INNER JOIN `kategori_blog` `k` ON `b`.`id_kategori_blog`=`k`.`id_kategori_blog` 
                  INNER JOIN `user` `p` ON `b`.`id_user`= `p`.`id_user` WHERE `b`.`tanggal` = '$data_archive' ";
            $sql_cat .= " ORDER BY `k`.`kategori_blog` limit $posisi, $batas ";
            $query_cat = mysqli_query($koneksi, $sql_cat);
            while ($data_cat = mysqli_fetch_row($query_cat)) {
              $id_blog = $data_cat[0];
              $kategori_blog = $data_cat[1];
              $judul = $data_cat[2];
              $penulis = $data_cat[3];
              $tanggal = $data_cat[4];
              $isi = $data_cat[5];
        ?>

          <h2 class="blog-post-title"><a href="#"> <?php echo $judul ?> </a></h2>
          <p class="blog-post-meta"><?php echo $tanggal ?> by <a href="#"> <?php echo $penulis ?> </a></p>
          <!-- <img src="slideshow/slide-1.jpg" class="img-fluid" alt="Responsive image"><br><br> -->

          <p><?php echo $isi ?></p>
          <a href="index.php?include=detail-blog&data=<?php echo $id_blog; ?>" class="btn btn-primary">Continue reading..</a>

        <?php } ?>
      </div><!-- /.blog-post --><br><br>
    <?php } else { ?>

      <?php
            $sql_cat = "SELECT `b`.`id_blog`, `k`.`kategori_blog`,`b`.`judul`, `p`.`nama`,`b`.`tanggal`, `b`.`isi` 
                FROM `blog` `b` INNER JOIN `kategori_blog` `k` ON `b`.`id_kategori_blog`=`k`.`id_kategori_blog` 
                INNER JOIN `user` `p` ON `b`.`id_user`= `p`.`id_user` ";
            $sql_cat .= " ORDER BY `k`.`kategori_blog` limit $posisi, $batas ";
            $query = mysqli_query($koneksi, $sql_cat);
            while ($data = mysqli_fetch_row($query)) {
              $id_blog = $data[0];
              $kategori_blog = $data[1];
              $judul = $data[2];
              $penulis = $data[3];
              $tanggal = $data[4];
              $isi = $data[5];
      ?>

        <h2 class="blog-post-title"><a href="#"> <?php echo $judul ?> </a></h2>
        <p class="blog-post-meta"><?php echo $tanggal ?> by <a href="#"> <?php echo $penulis ?> </a></p>
        <!-- <img src="slideshow/slide-1.jpg" class="img-fluid" alt="Responsive image"><br><br> -->

        <p><?php echo $isi ?></p>
        <a href="index.php?include=detail-blog&data=<?php echo $id_blog; ?>" class="btn btn-primary">Continue reading..</a>

      <?php } ?>
    </div><!-- /.blog-post --><br><br>
  <?php } ?>


  <nav class="blog-pagination">
    <!-- <a class="btn btn-outline-primary" href="#">Older</a>
    <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Newer</a> -->
    <?php
    $query_jum = mysqli_query($koneksi, $sql_cat);
    $jum_data = mysqli_num_rows($query_jum);
    $jum_halaman = ceil($jum_data / $batas);

    if ($jum_halaman == 0) {
      echo 'tidak ada halaman';
    } else if ($jum_halaman == 1) {
      echo "<a class='btn btn-outline-secondary disabled' href='index.php?include=buku&halaman=$sebelum'>Newer</a>";
      echo "<a class='btn btn-outline-secondary disabled' href='index.php?include=buku&halaman=$setelah'>Older</a>";
    } else {
      $sebelum = $halaman - 1;
      $setelah = $halaman + 1;

      if (isset($_GET['data'])) {
        if ($halaman > 1 && $halaman < $jum_halaman) {
          echo "<a class='btn btn-outline-primary' href='index.php?include=blog&data=$id_kategori_blog&halaman=$setelah' >Older</a>";
          echo "<a class='btn btn-outline-primary' href='index.php?include=blog&data=$id_kategori_blog&halaman=$sebelum' >Newer</a>";
        } else if ($halaman != 1) {
          echo "<a class='btn btn-outline-secondary disabled' href='index.php?include=blog&data=$id_kategori_blog&halaman=$setelah' aria-disabled='true' >Older</a>";
          echo "<a class='btn btn-outline-primary' href='index.php?include=blog&data=$id_kategori_blog&halaman=$sebelum' tabindex='-1'>Newer</a>";
        } else if ($halaman != $jum_halaman) {
          echo "<a class='btn btn-outline-primary' href='index.php?include=blog&data=$id_kategori_blog&halaman=$setelah' >Older</a>";
          echo "<a class='btn btn-outline-secondary disabled' href='index.php?include=blog&data=$id_kategori_blog&halaman=$sebelum' tabindex='-1' aria-disabled='true'>Newer</a>";
        }
      }else if (isset($_GET['data-archive'])) {
        if ($halaman > 1 && $halaman < $jum_halaman) {
          echo "<a class='btn btn-outline-primary' href='index.php?include=blog&data=$data_archive&halaman=$setelah' >Older</a>";
          echo "<a class='btn btn-outline-primary' href='index.php?include=blog&data=$data_archive&halaman=$sebelum' >Newer</a>";
        } else if ($halaman != 1) {
          echo "<a class='btn btn-outline-secondary disabled' href='index.php?include=blog&data=$data_archive&halaman=$setelah' aria-disabled='true' >Older</a>";
          echo "<a class='btn btn-outline-primary' href='index.php?include=blog&data=$data_archive&halaman=$sebelum' tabindex='-1'>Newer</a>";
        } else if ($halaman != $jum_halaman) {
          echo "<a class='btn btn-outline-primary' href='index.php?include=blog&data=$data_archive&halaman=$setelah' >Older</a>";
          echo "<a class='btn btn-outline-secondary disabled' href='index.php?include=blog&data=$data_archive&halaman=$sebelum' tabindex='-1' aria-disabled='true'>Newer</a>";
        }
      }else{
        if ($halaman > 1 && $halaman < $jum_halaman) {
          echo "<a class='btn btn-outline-primary' href='index.php?include=blog&halaman=$setelah' >Older</a>";
          echo "<a class='btn btn-outline-primary' href='index.php?include=blog&halaman=$sebelum' >Newer</a>";
        } else if ($halaman != 1) {
          echo "<a class='btn btn-outline-secondary disabled' href='index.php?include=blog&halaman=$setelah' aria-disabled='true' >Older</a>";
          echo "<a class='btn btn-outline-primary' href='index.php?include=blog&halaman=$sebelum' tabindex='-1'>Newer</a>";
        } else if ($halaman != $jum_halaman) {
          echo "<a class='btn btn-outline-primary' href='index.php?include=blog&halaman=$setelah' >Older</a>";
          echo "<a class='btn btn-outline-secondary disabled' href='index.php?include=blog&halaman=$sebelum' tabindex='-1' aria-disabled='true'>Newer</a>";
        }
      }
    } ?>
  </nav>

  </div><!-- /.blog-main -->

  <aside class="col-md-3 blog-sidebar">

    <div class="p-4">
      <h4 class="font-italic">Categories</h4>
      <ol class="list-unstyled mb-0">

        <?php
        $sql_kat = "SELECT `id_kategori_blog`, `kategori_blog` FROM `kategori_blog` ";
        $query_kat = mysqli_query($koneksi, $sql_kat);
        while ($data_kat = mysqli_fetch_row($query_kat)) {
          $id_kategori_blog = $data_kat[0];
          $kategori_blog = $data_kat[1];
        ?>

          <li><a href="index.php?include=blog&data=<?php echo $id_kategori_blog ?>"><?php echo $kategori_blog ?> </a></li>
        <?php } ?>
      </ol>
    </div>

    <div class="p-4">
      <h4 class="font-italic">Archives</h4>
      <ol class="list-unstyled mb-0">

        <?php
        $sql_arc = "SELECT DISTINCT `id_kategori_blog`, `tanggal` FROM `blog` ";
        $query_arc = mysqli_query($koneksi, $sql_arc);
        while ($data_arc = mysqli_fetch_row($query_arc)) {
          $id_kategori_blog = $data_arc[0];
          $tanggal = $data_arc[1];
        ?>

          <li><a href="index.php?include=blog&data-archive=<?php echo $tanggal ?>"><?php echo $tanggal ?></a></li>

        <?php } ?>
      </ol>
    </div>


  </aside><!-- /.blog-sidebar -->

  </div><!-- /.row -->

  </main><!-- /.container -->
</section>