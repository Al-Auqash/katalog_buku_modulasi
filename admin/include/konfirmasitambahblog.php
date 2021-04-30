<?php
$id_user = $_SESSION['id_user'];
$id_kategori_blog = $_POST['kategori_blog'];
$judul = $_POST['judul'];
$isi = $_POST['isi'];
$date =  date("Y-m-d");
$tanggal = $date;
if (empty($id_kategori_blog)) {
    header("Location:index.php?include=tambahblog&notif=tambahkosong&jenis=kategoriblog");
} else if (empty($judul)) {
    header("Location:index.php?include=tambahblog&notif=tambahkosong&jenis=judul");
} else {
    // $sql = "INSERT INTO `blog` (`id_kategori_blog`, `judul`, `isi`) VALUES ('$id_kategori_blog', '$judul', '$isi')";
    $sql = "INSERT INTO `blog` (`id_kategori_blog`, `id_user`, `tanggal`, `judul`, `isi`) VALUES ('$id_kategori_blog', '$id_user', '$date', '$judul', '$isi')";
    mysqli_query($koneksi, $sql);
    header("Location:index.php?include=blog&notif=tambahberhasil");
}
