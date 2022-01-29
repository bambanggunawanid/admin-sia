<?php include "db.php" ?>
<?php ob_start(); ?>
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sistem Informasi Akademik Sekolah - Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-6 col-lg-8 col-md-10">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row justify-content-center">
              <div class="col-lg-12 ">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4 font-weight-bold">Login Guru - SIA</h1>
                  </div>
                  <form action="" method="POST" class="user">
                    <div class="form-group">
                      <input required name="input_nip" type="text" class="form-control form-control-user" id="exampleInputNIP" aria-describedby="nipHelp" placeholder="Masukkan NIP anda...">
                    </div>
                    <div class="form-group">
                      <input required name="input_pass" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <button type="submit" name="login_btn" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Lupa Password?</a>
                  </div>

                  <?php
                  if (isset($_POST['login_btn'])) {
                    $nip = $_POST['input_nip'];
                    $pass = $_POST['input_pass'];

                    $login_query = "SELECT * FROM tb_guru WHERE nip='$nip' and pass='$pass'";

                    $result = mysqli_query($connection, $login_query);

                    if ($result) {
                      $num_rows = mysqli_num_rows($result);
                      if ($num_rows == 1) {
                        while ($row = mysqli_fetch_array($result)) {
                          $user_nip = $row['nip'];
                          $user_name = $row['nama'];
                          $user_status = $row['status'];
                          $user_profile = $row['img_profile'];

                          $_SESSION["user_nip"] = $user_nip;
                          $_SESSION["user_nama"] = $user_name;
                          $_SESSION["user_status"] = $user_status;
                          $_SESSION["user_profile"] = $user_profile;
                        }
                        header("Location:dashboard.php");
                      } else {
                        echo "<script>
                    alert('User name and password invalid');
                    </script>";
                      }
                    } else {
                      echo "Error" . mysqli_error($connection);
                    }
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>