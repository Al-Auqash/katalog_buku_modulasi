<?php
// $koneksi = mysqli_connect("localhost","root","k@g4wa585261TRIAL","katalog_buku");
$koneksi = mysqli_connect("localhost","root","","katalog_buku");
// cek koneksi
if (!$koneksi){
 die("Error koneksi: " . mysqli_connect_errno());
}
?>
