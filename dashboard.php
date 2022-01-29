<?php include "header.php" ?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Content Row -->
  <div class="row">
    <!-- Begin Page Content -->
    <div class="container-fluid">
      <?php
      if ($_SESSION['user_status'] == "admin" || $_SESSION['user_status'] == "guru") {
        $join_query = "SELECT `tb_mengajar` . * ,`tb_guru` . *, `tb_mapel` . *
        FROM `tb_mengajar`
        JOIN `tb_guru`
            ON `tb_guru` . `nip` = `tb_mengajar` . `nip`
        JOIN `tb_mapel`
            ON `tb_mapel` . `kode_mapel` = `tb_mengajar` . `kode_mapel`";
        $result = mysqli_query($connection, $join_query);
      }else{
        $status_guru_biasa = $_SESSION['user_status'];
        $join_query_guru_biasa = "SELECT `tb_mengajar` . * ,`tb_guru` . *, `tb_mapel` . *
        FROM `tb_mengajar`
        JOIN `tb_guru`
            ON `tb_guru` . `nip` = `tb_mengajar` . `nip`
        JOIN `tb_mapel`
            ON `tb_mapel` . `kode_mapel` = `tb_mengajar` . `kode_mapel`
        WHERE `tb_guru`.`status`='$status_guru_biasa'";
        $result = mysqli_query($connection, $join_query_guru_biasa);
      }

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
                  <?php if ($_SESSION['user_status'] == "admin") : ?>
                    <th>Action</th>
                  <?php endif; ?>
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
                    <?php if ($_SESSION['user_status'] == "admin") : ?>
                      <td class="col-xl-2 text-center">
                        <button type="button" class="btn btn-warning mr-2" data-toggle="modal" data-target="#editModal">
                          Ubah
                        </button>
                        <a href="hapus_mengajar.php?id=<?= $r["id_ajar"] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')">Hapus</a>
                      </td>
                    <?php endif; ?>
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
        <h5 class="modal-title" id="editModal">Ubah jadwal mengajar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="id_ajar">ID lama</label>
            <input type="text" class="form-control" id="id_ajar" name="id_ajar" placeholder="ID ajar">
          </div>
          <div class="form-group">
            <label for="hari">Hari mengajar</label>
            <select name="hari" class="form-control">
              <option value="Senin">Senin</option>
              <option value="Selasa">Selasa</option>
              <option value="Rabu">Rabu</option>
              <option value="Kamis">Kamis</option>
              <option value="Jumat">Jumat</option>
            </select>
          </div>
          <div class="form-group">
            <label for="jam">Durasi mengajar</label>
            <input type="number" class="form-control" id="jam" name="jam" placeholder="Durasi mengajar">
          </div>
          <div class="form-group">
            <?php
            $sql_guru = "SELECT * FROM tb_guru";
            $result_guru = mysqli_query($connection, $sql_guru);
            ?>
            <label for="nip">Nama guru</label>
            <select name="nip" class="form-control">
              <?php foreach ($result_guru as $rg) : ?>
                <option value="<?= $rg['nip'] ?>"><?= $rg['nama'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="kode_mapel">Nama mapel</label>
            <select name="kode_mapel" class="form-control">
              <?php
              $sql_mapel = "SELECT * FROM tb_mapel";
              $result_mapel = mysqli_query($connection, $sql_mapel);
              ?>
              <?php foreach ($result_mapel as $rm) : ?>
                <option value="<?= $rm['kode_mapel'] ?>"><?= $rm['nama_mapel'] ?></option>
              <?php endforeach; ?>
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
  $id_ajar = $_POST['id_ajar'];
  $hari = $_POST['hari'];
  $jam = $_POST['jam'];
  $nip = $_POST['nip'];
  $kode_mapel = $_POST['kode_mapel'];
  $sql_edit = "UPDATE tb_mengajar SET hari='$hari', jam='$jam', nip='$nip', kode_mapel='$kode_mapel' WHERE `tb_mengajar`.`id_ajar` = '$id_ajar'";

  if (mysqli_query($connection, $sql_edit)) {
    header("Location:dashboard.php");
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
            <?php
            $sql_guru = "SELECT * FROM tb_guru";
            $result_guru = mysqli_query($connection, $sql_guru);
            ?>
            <label for="nip">Nama guru</label>
            <select name="nip" class="form-control">
              <?php foreach ($result_guru as $rg) : ?>
                <option value="<?= $rg['nip'] ?>"><?= $rg['nama'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="hari">Hari mengajar</label>
            <select name="hari" class="form-control">
              <option value="Senin">Senin</option>
              <option value="Selasa">Selasa</option>
              <option value="Rabu">Rabu</option>
              <option value="Kamis">Kamis</option>
              <option value="Jumat">Jumat</option>
            </select>
          </div>
          <div class="form-group">
            <label for="jam">Durasi mengajar</label>
            <input type="number" class="form-control" id="jam" name="jam" placeholder="Durasi (jam)">
          </div>
          <div class="form-group">
            <label for="kode_mapel">Nama mapel</label>
            <select name="kode_mapel" id="kode_mapel" class="form-control">
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
  $nip = $_POST['nip'];
  $hari = $_POST['hari'];
  $jam = $_POST['jam'];
  $kode_mapel = $_POST['kode_mapel'];
  $sql = "INSERT INTO tb_mengajar (id_ajar, hari, jam, nip, kode_mapel) VALUES (NULL, '$hari', '$jam', '$nip', '$kode_mapel')";

  if (mysqli_query($connection, $sql)) {
    header("Location:dashboard.php");
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($connection);
  }
}
?>
<?php include 'footer.php'; ?>