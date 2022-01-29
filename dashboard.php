<?php include "header.php" ?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Content Row -->
  <div class="row">
    <!-- Begin Page Content -->
    <div class="container-fluid">
      <?php
      $join_query = "SELECT `tb_mengajar` . * ,`tb_guru` . *, `tb_mapel` . *
      FROM `tb_mengajar`
      JOIN `tb_guru`
          ON `tb_guru` . `nip` = `tb_mengajar` . `nip`
      JOIN `tb_mapel`
          ON `tb_mapel` . `kode_mapel` = `tb_mengajar` . `kode_mapel`";
      $result = mysqli_query($connection, $join_query);
      ?>
      <!-- Page Heading -->
      <h1 class="h3 text-gray-800">Selamat datang, <?= $_SESSION['user_nama'] ?> </h1>
      <p class="mb-5 text-gray-800">Status: <?= $_SESSION['user_status'] ?> </p>
      <a href="" data-toggle="modal" data-target="#newSubMenuModal" class=" btn btn-primary mb-4">Tambahkan Daftar Mengajar</a>
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Daftar Mengajar</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Hari</th>
                  <th>Kode Mapel</th>
                  <th>Mapel</th>
                  <th>Durasi</th>
                  <th>Nama Guru</th>
                  <th>NIP</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($result as $r) : ?>
                  <tr>
                    <td><?php print_r($r['id_ajar']) ?></td>
                    <td><?php print_r($r['hari']) ?></td>
                    <td><?php print_r($r['kode_mapel']) ?></td>
                    <td><?php print_r($r['nama_mapel']) ?></td>
                    <td><?php print_r($r['jam']) ?> Jam</td>
                    <td><?php print_r($r['nama']) ?></td>
                    <td><?php print_r($r['nip']) ?></td>
                    <td class="col-xl-2 text-center">
                      <button type="button" class="btn btn-warning mr-2" data-toggle="modal" data-target="#editModal">
                        Ubah
                      </button>
                      <a href="hapus_mengajar.php?id=<?= $row["id_ajar"] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')">Hapus</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- End of Main Content -->
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
            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat">
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefaultA" value="Laki-laki">
            <label class="form-check-label" for="flexRadioDefaultA">
              Laki-laki
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefaultB" value="Perempuan">
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
  $sql_edit = "UPDATE tb_guru SET nip = '$nip_baru', nama = '$nama', pass = '$pass', tmp_lahir = '$tmp_lahir', tgl_lahir = '$tgl_lahir', alamat = '$alamat', jenis_kelamin = '$jenis_kelamin', status='$status' WHERE `tb_guru`.`nip` = '$nip_lama'";

  if (mysqli_query($connection, $sql_edit)) {
    header("Location:guru.php");
  } else {
    echo "Error: " . $sql_edit . "<br>" . mysqli_error($connection);
  }
}
?>
<!-- Modal -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newSubMenuModal">Tambahkan Daftar Mengajar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="hari" name="hari" placeholder="Hari">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="jam" name="jam" placeholder="Durasi (jam)">
          </div>
          <div class="form-group">
            <select name="nama_mapel" id="nama_mapel" class="form-control">
              <?php foreach ($result_mapel as $rm) : ?>
                <option value="<?= $rm['kode_mapel'] ?>"><?= $rm['nama_mapel'] ?></option>
              <?php endforeach; ?>
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
  $nip = $_SESSION['user_nip'];
  $hari = $_POST['hari'];
  $jam = $_POST['jam'];
  $kode_mapel = $_POST['nama_mapel'];
  $sql = "INSERT INTO tb_mengajar (id_ajar, hari, jam, nip, kode_mapel) VALUES (NULL, '$hari', '$jam', '$nip', '$kode_mapel')";

  if (mysqli_query($connection, $sql)) {
    header("Location:dashboard.php");
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($connection);
  }
}
?>
<?php include 'footer.php'; ?>