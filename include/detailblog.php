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

          <?php
          if (isset($_GET['data'])) {
            $id_blog = $_GET['data'];
            //gat data blog
            $sql = "SELECT `k`.`kategori_blog`,`b`.`judul`, `p`.`nama`,`b`.`tanggal`, `b`.`isi` 
                    FROM `blog` `b` INNER JOIN `kategori_blog` `k` ON `b`.`id_kategori_blog`=`k`.`id_kategori_blog` 
                    INNER JOIN `user` `p` ON `b`.`id_user`= `p`.`id_user` WHERE `b`.`id_blog`='$id_blog'";
            $query = mysqli_query($koneksi, $sql);
            while ($data = mysqli_fetch_row($query)) {
              $kategori_blog = $data[0];
              $judul = $data[1];
              $penulis = $data[2];
              $tanggal = $data[3];
              $isi = $data[4];
            }
          }
          ?>

          <h2 class="blog-post-title"> <?php echo $judul ?></h2>
          <p class="blog-post-meta"> <?php echo $tanggal ?> by <a href="#"> <?php echo $penulis ?> </a></p>

          <p>Category : <?php echo $kategori_blog ?></p>
          <hr>
          <p> <?php echo $isi ?></p>

        </div><br><br><!-- /.blog-post -->



      </div><!-- /.blog-main -->

      <aside class="col-md-3 blog-sidebar">

        <div class="p-4">
          <h4 class="font-italic">Categories</h4>
          <ol class="list-unstyled mb-0">

            <?php
            $sql = "SELECT `id_kategori_blog`, `kategori_blog` FROM `kategori_blog` ";
            $query = mysqli_query($koneksi, $sql);
            while ($data = mysqli_fetch_row($query)) {
              $id_kategori_blog = $data[0];
              $kategori_blog = $data[1];
            ?>

              <li><a href="index.php?include=blog&data<?php echo $id_kategori_blog ?>"><?php echo $kategori_blog ?> </a></li>
            <?php } ?>
        </div>

        <div class="p-4">
          <h4 class="font-italic">Archives</h4>
          <ol class="list-unstyled mb-0">

            <?php
            $sql = "SELECT  `id_kategori_blog`, `tanggal` FROM `blog` ";
            $query = mysqli_query($koneksi, $sql);
            while ($data = mysqli_fetch_row($query)) {
              $id_kategori_blog = $data[0];
              $tanggal = $data[1];
            ?>

              <li><a href="index.php?include=blog&data=<?php echo $id_kategori_blog ?>"><?php echo $tanggal ?></a></li>

            <?php } ?>
          </ol>
        </div>


      </aside><!-- /.blog-sidebar -->

    </div><!-- /.row -->

  </main><!-- /.container -->
</section>