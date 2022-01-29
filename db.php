<?php
// Koneksi ke Database.. Parameter String : 1. Nama Host 2. username 3. nama database
global $connection;
$connection = mysqli_connect("localhost", "root", "", "db_sekolah");
if ($connection) {
    // echo "success";
} else {
    echo "Error";
}

function query($query){
    global $connection;
    $result = mysqli_query($connection,$query);
    $rows=[];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[]=$row;
    }
    return $rows;
}

function tambah($data){
    global $connection;
    $nim = htmlspecialchars ($data["nim"]);
    $nama = htmlspecialchars ($data["nama"]);
    $email = htmlspecialchars ($data["email"]);
    $jurusan= htmlspecialchars ($data["jurusan"]);

    // upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query ="INSERT INTO mahasiswa VALUES(
        '','$nama','$nim','$email','$jurusan','$gambar'
    )";
    mysqli_query($connection,$query);
    return mysqli_affected_rows($connection);
}

function upload(){
    $namaFile = $_FILES["gambar"]["name"];
    $ukuranFile = $_FILES["gambar"]["size"];
    $error = $_FILES["gambar"]["error"];
    $tmpName = $_FILES["gambar"]["tmp_name"];

    // cek apakah tidak ada gambar yang di upload
    if ($error === 4) {
        echo "<script>
            alert('pilih gambar terlebih dahulu!');
            </script>
        ";
        return false;
    }
    // cek yang di upload gambar atau bukan
    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.',$namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar,$ekstensiGambarValid)) {
        echo "<script>
            alert('Yang anda upload bukan gambar');
            </script>
        ";
        return false;
    }

    // cek jika ukuran terlalu besar
    if ($ukuranFile > 1000000) {
        echo "<script>
            alert('Ukuran gambar terlalu besar');
            </script>
        ";
    }

    // Lolos Pengecekan gambar Siap Upload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName,'img/'.$namaFileBaru);
    return $namaFileBaru;

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
?>