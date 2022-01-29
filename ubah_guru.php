<?php
session_start();
require 'db.php';
$nip = $_GET["id"];
if (ubah_guru($nip) > 0) {
    echo "
    <script>
        alert('Data Berhasil Di Hapus !');
        document.location.href = 'index.php';
    </script>
    ";
    header("Location:guru.php");
} else {
    echo "
    <script>
        alert('Data Gagal Di Hapus !');
        document.location.href = 'guru.php';
    </script>
    ";
    header("Location:guru.php");
}
