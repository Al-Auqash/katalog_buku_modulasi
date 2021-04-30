<?php
    if(isset($_SESSION['id_kategori_blog'])){
        $id_kategori_blog = $_SESSION['id_kategori_blog'];
        $kategori_blog = $_POST['kategori_blog'];
        if(empty($kategori_blog)){
            header("Location:index.php?include=edit-kategori-blog&data=".$id_kategori_blog."&if=editkosong");
        }else{
            $sql = "update `kategori_blog` set `kategori_blog`='$kategori_blog' where `id_kategori_blog`='$id_kategori_blog'";
            mysqli_query($koneksi,$sql);
            header("Location:index.php?include=kategori-blog&notif=editberhasil");
        }
    }
?>