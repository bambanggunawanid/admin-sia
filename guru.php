<?php include 'header.php'; ?>
<?php
$guru_query = "SELECT * FROM `tb_guru`";
$result_guru = mysqli_query($connection, $guru_query); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Guru</h1>
  </div>
  <a href="" data-toggle="modal" data-target="#newSubMenuModal" class=" btn btn-primary mb-4">Tambahkan Daftar Guru</a>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">List Data Guru</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr class="">
              <th>NIP</th>
              <th>Nama</th>
              <th>TTL</th>
              <th>Alamat</th>
              <th>Jenis Kelamin</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>

            <?php

            if ($result_guru) {
              $i = 1;
              while ($row = mysqli_fetch_array($result_guru)) {
            ?>

                <tr>
                  <td><?php echo $row['nip'] ?></td>
                  <td><?php echo $row['nama'] ?></td>
                  <td><?php echo $row['tmp_lahir'] ?>, <?php echo date("d-m-Y", strtotime($row['tgl_lahir'])) ?></td>
                  <td><?php echo $row['alamat'] ?></td>
                  <td><?php echo $row['jenis_kelamin'] ?></td>
                  <td><?php echo $row['status'] ?></td>
                  <td class="col-xl-2 text-center">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-warning mr-2" data-toggle="modal" data-target="#editModal">
                      Ubah
                    </button>
                    <!-- Delete -->
                    <a href="hapus_guru.php?id=<?= $row["nip"] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')">Hapus</a>
                  </td>
                </tr>
            <?php
                $i++;
              }
            } else {
              echo "Error :" . mysqli_error($connection);
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
<!-- Modal Edit-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModal">Ubah data akun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="nip_lama" name="nip_lama" placeholder="NIP lama">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="nip_baru" name="nip_baru" placeholder="NIP baru">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama anda">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="password" name="password" placeholder="Password anda">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="tmp_lahir" name="tmp_lahir" placeholder="Tempat lahir">
          </div>
          <div class="form-group">
            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="Tanggal lahir">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="Alamat" name="Alamat" placeholder="Alamat">
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefaultA">
            <label class="form-check-label" for="flexRadioDefaultA">
              Laki-laki
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefaultB">
            <label class="form-check-label" for="flexRadioDefaultB">
              Perempuan
            </label>
          </div>
          <div class="form-group">
            <select name="status" class="form-control">
              <option value="admin">Admin</option>
              <option value="guru">Guru</option>
              <option value="guru_biasa">Guru biasa</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" name="submit_edit_modal">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
if (isset($_POST['submit_edit_modal'])) {
  $nip_lama = $_POST['nip_lama'];
  $nip_baru = $_POST['nip_baru'];
  $nama = $_POST['nama'];
  $pass = $_POST['password'];
  $tmp_lahir = $_POST['tmp_lahir'];
  $tgl_lahir = $_POST['tgl_lahir'];
  $alamat = $_POST['alamat'];
  $jenis_kelamin = $_POST['flexRadioDefault'];
  $status = $_POST['status'];
  $sql = "UPDATE tb_guru SET nip = '$nip_baru', nama = '$nama', pass = '$pass', tmp_lahir = '$tmp_lahir', tgl_lahir = '$tgl_lahir', alamat = '$alamat', jenis_kelamin = '$jenis_kelamin', status='$status' WHERE `tb_guru`.`nip` = '$nip_lama'";

  if (mysqli_query($connection, $sql)) {
    header("Location:guru.php");
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($connection);
  }
}
?>

<!-- Modal -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newSubMenuModal">Tambahkan Daftar Guru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" name="nip" placeholder="NIP">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="nama" placeholder="Nama anda">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="tmp_lahir" placeholder="Tempat lahir">
          </div>
          <div class="form-group">
            <input type="date" class="form-control" name="tgl_lahir" placeholder="Tanggal lahir">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="alamat" placeholder="Alamat">
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
            <label class="form-check-label" for="flexRadioDefault1">
              Laki-laki
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
            <label class="form-check-label" for="flexRadioDefault2">
              Perempuan
            </label>
          </div>
          <div class="form-group">
            <select name="status" id="status" class="form-control">
              <option value="admin">Admin</option>
              <option value="guru">Guru</option>
              <option value="guru_biasa">Guru biasa</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="submit_btn_modal">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
if (isset($_POST['submit_btn_modal'])) {
  $nip = $_POST['nip'];
  $nama = $_POST['nama'];
  $pass = $_POST['password'];
  $tmp_lahir = $_POST['tmp_lahir'];
  $tgl_lahir = $_POST['tgl_lahir'];
  $alamat = $_POST['alamat'];
  $jenis_kelamin = $_POST['flexRadioDefault'];
  $status = $_POST['status'];
  $sql = "INSERT INTO tb_guru (nip, nama, pass, tmp_lahir, tgl_lahir, alamat, jenis_kelamin, status, img_profile) VALUES ('$nip', '$nama','$pass', '$tmp_lahir', '$tgl_lahir', '$alamat', '$jenis_kelamin', '$status', 'profile-default.jpg')";

  if (mysqli_query($connection, $sql)) {
    header("Location:guru.php");
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($connection);
  }
}
?>
<?php include 'footer.php'; ?>