<?php include 'header.php'; ?>
<?php
$mapel_query = "SELECT * FROM `tb_mapel`";
$result_mapel = mysqli_query($connection, $mapel_query); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Mapel</h1>
  </div>
  <a href="" data-toggle="modal" data-target="#newSubMenuModal" class=" btn btn-primary mb-4">Tambahkan Mapel Baru</a>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">List Mata Pelajaran</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr class="">
              <th>No</th>
              <th>Kode Mapel</th>
              <th>Nama Mapel</th>
              <th>Deskripsi</th>
              <th class="">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($result_mapel) {
              $i = 1;
              while ($row = mysqli_fetch_array($result_mapel)) {
            ?>
                <tr>
                  <td class="col-md-1"><?php echo $i ?></td>
                  <td class="col-md-3"><?php echo $row['kode_mapel'] ?></td>
                  <td class="col-md-3"><?php echo $row['nama_mapel'] ?></td>
                  <td class="col-md-3"><i style="width: 32em; display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $row['deskripsi'] ?></i></td>
                  <td class="col-md-3 text-center">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-warning mr-2" data-toggle="modal" data-target="#editModal">
                      Ubah
                    </button>
                    <!-- Modal Edit-->
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editModal">Ubah mapel</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="" method="post">
                            <div class="modal-body">
                              <div class="form-group">
                                <input type="text" class="form-control" id="kode_mapel_lama" name="kode_mapel_lama" placeholder="Kode mapel lama">
                              </div>
                              <div class="form-group">
                                <input type="text" class="form-control" id="kode_mapel_baru" name="kode_mapel_baru" placeholder="Kode mapel baru">
                              </div>
                              <div class="form-group">
                                <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" placeholder="Nama mapel">
                              </div>
                              <div class="form-group">
                                <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi">
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
                      $kode_lama = $_POST['kode_mapel_lama'];
                      $kode_baru = $_POST['kode_mapel_baru'];
                      $nama_mapel = $_POST['nama_mapel'];
                      $deskripsi = $_POST['deskripsi'];
                      $sql_ubah = "UPDATE tb_mapel SET kode_mapel = '$kode_baru', nama_mapel = '$nama_mapel', deskripsi = '$deskripsi' WHERE `tb_mapel`.`kode_mapel` = '$kode_lama'";

                      if (mysqli_query($connection, $sql_ubah)) {
                        header("Location:mapel.php");
                      } else {
                        echo "Error: " . $sql_ubah . "<br>" . mysqli_error($connection);
                      }
                    }
                    ?>

                    <!-- Delete -->
                    <a href="hapus_mapel.php?id=<?= $row["kode_mapel"] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')">Hapus</a>

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
<!-- Modal -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newSubMenuModal">Tambahkan Mapel Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="kode_mapel" name="kode_mapel" placeholder="Masukkan kode Mapel">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" placeholder="Masukkan nama mapel">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukkan deskripsi mapel">
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
  $kode_mapel = $_POST['kode_mapel'];
  $nama_mapel = $_POST['nama_mapel'];
  $deskripsi = $_POST['deskripsi'];
  $sql = "INSERT INTO tb_mapel (kode_mapel, nama_mapel, deskripsi) VALUES ('$kode_mapel', '$nama_mapel','$deskripsi')";

  if (mysqli_query($connection, $sql)) {
    header("Location:mapel.php");
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($connection);
  }
}
?>
</div>
<!-- End of Main Content -->


<?php include 'footer.php'; ?>