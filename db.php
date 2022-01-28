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
function ubah($data){
    global $connection;

    $id = $data["id"];
    $nim = htmlspecialchars ($data["nim"]);
    $nama = htmlspecialchars ($data["nama"]);
    $email = htmlspecialchars ($data["email"]);
    $jurusan= htmlspecialchars ($data["jurusan"]);

    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    }else {
        $gambar = upload();

    }

    $query ="UPDATE mahasiswa SET
        nim = '$nim',
        nama = '$nama',
        jurusan = '$jurusan',
        gambar = '$gambar'
        WHERE id = $id
    ";

    mysqli_query($connection,$query);
    return mysqli_affected_rows($connection);
}

function cari($keyword){
    $query = "SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%' OR nim LIKE '%$keyword%' OR email LIKE '%$keyword%' OR jurusan LIKE '%$keyword%' ";
    return query($query);
}

function registrasi($data){
    global $connection;
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($connection,$data["password"]);
    $passwordKonfirmasi = mysqli_real_escape_string($connection,$data["passwordKonfirmasi"]);

    //cek username sudah ada atau belum?
    $result = mysqli_query($connection,"SELECT username FROM user WHERE username='$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('Username sudah terdaftar!')
            </script>
        ";
        return false;
    }
    //cek konfirmasi password
    if ($password !== $passwordKonfirmasi) {
        echo "<script>
            alert('Password tidak sama!');
            </script>
        ";
        return false;
    }
    // enkripsi password
    $password = password_hash($password,PASSWORD_DEFAULT);

    // tambah ke database
    mysqli_query($connection,"INSERT INTO user VALUES ('','$username','$password')");
    return mysqli_affected_rows($connection);
}

?>