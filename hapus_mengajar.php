<?php
session_start();
require 'db.php';
$id = $_GET["id"];
if (hapus_mengajar($id) > 0) {
    echo "
    <script>
        alert('Data Berhasil Di Hapus !');
        document.location.href = 'index.php';
    </script>
    ";
    header("Location:dashboard.php");
} else {
    echo "
    <script>
        alert('Data Gagal Di Hapus !');
        document.location.href = 'index.php';
    </script>
    ";
    header("Location:dashboard.php");
}
