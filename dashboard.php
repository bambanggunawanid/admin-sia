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
                  <th>Hari</th>
                  <th>Kode Mapel</th>
                  <th>Mapel</th>
                  <th>Durasi</th>
                  <th>Nama Guru</th>
                  <th>NIP</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $mapel_query = "SELECT * FROM `tb_mapel`";
                $result_mapel = mysqli_query($connection, $mapel_query);
                ?>
                <?php foreach ($result as $r) : ?>
                  <tr>
                    <td><?php print_r($r['hari']) ?></td>
                    <td><?php print_r($r['kode_mapel']) ?></td>
                    <td><?php print_r($r['nama_mapel']) ?></td>
                    <td><?php print_r($r['jam']) ?> Jam</td>
                    <td><?php print_r($r['nama']) ?></td>
                    <td><?php print_r($r['nip']) ?></td>
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