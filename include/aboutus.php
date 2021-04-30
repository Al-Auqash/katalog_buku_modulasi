<section id="blog-header">
  <div class="container">
    <h1 class="text-white">ABOUT US</h1>
  </div>
</section><br><br>
<section id="blog-list">
  <main role="main" class="container">
    <div class="row">
      <div class="col-md-9 blog-main">
        <div class="blog-post">

          <?php
          $sql_b = "SELECT `id_konten`, `judul`, `tanggal`, `isi` FROM `konten` WHERE `id_konten` = 1 ";
          $query_b = mysqli_query($koneksi, $sql_b);
          while ($data_b = mysqli_fetch_row($query_b)) {
            $id_konten = $data_b[0];
            $judul = $data_b[1];
            $tanggal = $data_b[2];
            $isi = $data_b[3];
          }
          ?>

          <h2 class="blog-post-title"> <?php echo $judul; ?> </h2>
          <p class="blog-post-meta"> <?php echo $tanggal; ?> </p>

          <p> <?php echo $isi; ?> </p>

        </div><br><br><!-- /.blog-post -->
      </div><!-- /.blog-main -->

      <aside class="col-md-3 blog-sidebar">

        <div class="p-4">
          <h4 class="font-italic">Social Media</h4>
          <ol class="list-unstyled">
            <li><a href="https://www.github.com/">GitHub</a></li>
            <li><a href="https://www.twitter.com/">Twitter</a></li>
            <li><a href="https://www.facebook.com/">Facebook</a></li>
            <li><a href="https://www.instagram.com/">Instagram</a></li>
          </ol>
        </div>
      </aside><!-- /.blog-sidebar -->

    </div><!-- /.row -->

  </main><!-- /.container -->
</section> <br><br>