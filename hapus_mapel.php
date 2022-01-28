<?php
session_start();
require 'db.php';
$kode_mapel = $_GET["id"];
if (hapus_mapel($kode_mapel) > 0) {
    echo "
    <script>
        alert('Data Berhasil Di Hapus !');
        document.location.href = 'index.php';
    </script>
    ";
    header("Location:mapel.php");
} else {
    echo "
    <script>
        alert('Data Gagal Di Hapus !');
        document.location.href = 'index.php';
    </script>
    ";
    header("Location:mapel.php");
}
