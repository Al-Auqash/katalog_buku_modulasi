<?php
    if(isset($_SESSION['id_penerbit'])){
        $id_penerbit = $_SESSION['id_penerbit'];
        $penerbit = $_POST['penerbit'];
        $alamat = $_POST['alamat'];
        if(empty($penerbit)){
            header("Location:index.php?include=edit-penerbit&data=".$id_penerbit."&if=editkosong");
        }else{
            $sql = "update `penerbit` set `penerbit`='$penerbit', `alamat`='$alamat'  where `id_penerbit`='$id_penerbit'";
            mysqli_query($koneksi,$sql);
            header("Location:index.php?include=penerbit&notif=editberhasil");
        }
    }
?>