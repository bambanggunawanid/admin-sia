<?php
global $connection;
$connection = mysqli_connect("localhost","root","","db_sekolah");
if($connection)
{
    // echo "success";
}
else
{
    echo "Error";
}
$query = "  SELECT
                tb_guru.`nip`,
                tb_mengajar.`kode_mapel`,
                tb_mengajar.`hari`,
                tb_mengajar.`jam`,
                tb_mapel.`kode_mapel`,
                tb_mapel.`kode_mapel`,
            FROM item
            JOIN suplier ON item.`kodes` = suplier.`kodes`
            JOIN gudang ON item.`kodeg` = gudang.`kodeg"
?>