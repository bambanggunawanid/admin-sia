<?php
// Koneksi ke Database.. Parameter String : 1. Nama Host 2. username 3. nama database
global $connection;
$connection = mysqli_connect("localhost", "root", "", "db_sekolah");
if ($connection) {
    // echo "success";
} else {
    echo "Error";
}

function hapus_mapel($id){
    global $connection;
    mysqli_query($connection, "DELETE FROM tb_mapel WHERE kode_mapel= $id");
    return mysqli_affected_rows($connection);
}
function hapus_guru($id){
    global $connection;
    mysqli_query($connection, "DELETE FROM tb_guru WHERE nip= $id");
    return mysqli_affected_rows($connection);
}
function hapus_mengajar($id){
    global $connection;
    mysqli_query($connection, "DELETE FROM tb_mengajar WHERE id_ajar= $id");
    return mysqli_affected_rows($connection);
}
function ubah_guru($data){
    global $connection;

    $nip = $data["id"];
    $nama = htmlspecialchars ($data["nama"]);
    $pass = htmlspecialchars ($data["email"]);
    $jurusan= htmlspecialchars ($data["jurusan"]);

    $gambarLama = htmlspecialchars($data["gambarLama"]);

    $query ="UPDATE db_sekolah SET
        nim = '$nip',
        nama = '$nama',
        jurusan = '$jurusan',
        WHERE nip = $nip
    ";

    mysqli_query($connection,$query);
    return mysqli_affected_rows($connection);
}
function ubah_mengajar($data){
    global $connection;

    $nip = $data["id"];
    $nama = htmlspecialchars ($data["nama"]);
    $pass = htmlspecialchars ($data["email"]);
    $jurusan= htmlspecialchars ($data["jurusan"]);

    $gambarLama = htmlspecialchars($data["gambarLama"]);

    $query ="UPDATE db_sekolah SET
        nim = '$nip',
        nama = '$nama',
        jurusan = '$jurusan',
        WHERE nip = $nip
    ";

    mysqli_query($connection,$query);
    return mysqli_affected_rows($connection);
}
?>