<?php
if (isset($_GET['data'])) {
  $id_user = $_GET['data'];
  //get foto
  $sql_f = "SELECT `foto`, `nama`, `email` FROM `user` WHERE `id_user`='$id_user'";
  $query_f = mysqli_query($koneksi, $sql_f);
  $jumlah_f = mysqli_num_rows($query_f);
  if ($jumlah_f > 0) {
    while ($data_f = mysqli_fetch_row($query_f)) {
      $foto = $data_f[0];
      $nama = $data_f[1];
      $email = $data_f[2];
    }
  }
}
?>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h3><i class="fas fa-edit"></i> Edit Profil</h3>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?include=profil">Profil</a></li>
          <li class="breadcrumb-item active">Edit Profil</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

  <div class="card card-info">
    <div class="card-header">
      <h3 class="card-title" style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Edit Profil</h3>
      <div class="card-tools">
        <a href="index.php?include=profil" class="btn btn-sm btn-warning float-right"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
      </div>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    </br>

    <?php if ((!empty($_GET['notif'])) && (!empty($_GET['jenis']))) { ?>
      <?php if ($_GET['notif'] == "editkosong") { ?>
        <div class="alert alert-danger" role="alert">Maaf data
          <?php echo $_GET['jenis']; ?> wajib di isi</div>
      <?php } ?>
    <?php } ?>


    <form class="form-horizontal" method="post" action="index.php?include=konfirmasi-edit-profil&data=<?php echo $id_user ?>" enctype="multipart/form-data">
      <div class="card-body">
        <div class="form-group row">
          <label for="foto" class="col-sm-12 col-form-label">
            <span class="text-info">
              <i class="fas fa-user-circle"></i>
              <u>PROFIL USER</u>
            </span>
          </label>
        </div>
        <div class="form-group row">
          <label for="foto" class="col-sm-3 col-form-label">
            Foto Pegawai</label>
          <div class="col-sm-7">
            <div class="custom-file">
              <input type="file" class="custom-file-input" name="foto" id="customFile">
              <label class="custom-file-label" for="customFile">
                Choose file</label>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="nama" class="col-sm-3 col-form-label">Nama</label>
          <div class="col-sm-7">
            <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $nama; ?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="email" class="col-sm-3 col-form-label">Email</label>
          <div class="col-sm-7">
            <input type="text" class="form-control" name="email" id="email" value="<?php echo $email; ?>">
          </div>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <div class="col-sm-12">
          <button type="submit" class="btn btn-info float-right">
            <i class="fas fa-save"></i> Simpan</button>
        </div>
      </div>
      <!-- /.card-footer -->
    </form>
  </div>
  <!-- /.card -->

</section>