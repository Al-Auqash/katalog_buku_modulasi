<?php

$nama = $_POST['nama'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$level = $_POST['level'];
$lokasi_file = $_FILES['foto']['tmp_name'];
$nama_file = $_FILES['foto']['name'];
$direktori = 'foto/'.$nama_file;
chmod('foto/'.$_FILES['foto']['name'], 0777);
// $uploaddir = '/var/www/uploads/';
// $uploadfile = $uploaddir . basename($_FILES['foto']['name']);

if (empty($nama)) {
    header("Location:index.php?include=tambah-user&notif=tambahkosong&jenis=kategoribuku");
} else if (empty($email)) {
    header("Location:index.php?include=tambah-user&notif=tambahkosong&jenis=email");
} else if (empty($username)) {
    header("Location:index.php?include=tambah-user&notif=tambahkosong&jenis=username");
} else if (empty($password)) {
    header("Location:index.php?include=tambah-user&notif=tambahkosong&jenis=password");
} else if (empty($level)) {
    header("Location:index.php?include=tambah-user&notif=tambahkosong&jenis=level");
} else if (!move_uploaded_file($lokasi_file, $direktori)) {
    header("Location:index.php?include=tambah-user&notif=tambahkosong&jenis=foto");
} else {
    $sql = "INSERT INTO `user` (`nama`, `email`, `username`, `password`, `level`, `foto`) VALUES 
    ('$nama', '$email', '$username', MD5('$password'), '$level', '$nama_file')";
    //echo $sql;
    mysqli_query($koneksi, $sql);
    $id_buku = mysqli_insert_id($koneksi);
    header("Location:index.php?include=user&notif=tambahberhasil");
}
