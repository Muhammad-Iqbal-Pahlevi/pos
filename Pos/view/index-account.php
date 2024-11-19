<?php

require_once __DIR__ . "/../Model/model.php";
require_once __DIR__ . "/../Model/Users.php";

if(!isset($_SESSION["full_name"])) {
    header("Location: login.php");
    exit;
  }

$users = new Users();
$accounts = $users->all();


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Blank Page &mdash; Stisla</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="../assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/../assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="../assets/modules/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../assets/modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="../assets/modules/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="../assets/modules/jquery-selectric/selectric.css">
  <link rel="stylesheet" href="../assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="../assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/components.css">
  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>
  <!-- /END GA -->
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <?php include('../component/layout/nav.php'); ?>

      <!-- Sidebar -->
      <?php include('../component/layout/sidebar.php'); ?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item">Profile</div>
            </div>
          </div>
          <div class="section-body">
            <h2 class="section-title">Hi, Ujang!</h2>
            <p class="section-lead">
              Change information about yourself on this page.
            </p>

            <div class="col">
              <div class="col-12 col-sm-12">
                <div class="card author-box card-primary">
                  <?php foreach ($accounts as $account) : ?>
                  <div class="card-body">
                    <div class="author-box-left">
                      <img alt="image" src="../public/img/users/<?= $account['avatar'] ?>" class="rounded-circle author-box-picture" width="100" height="100">
                      <div class="clearfix"></div>
                      <a href="#" class="btn btn-primary mt-3 follow-btn" data-follow-action="alert('follow clicked');" data-unfollow-action="alert('unfollow clicked');">Follow</a>
                    </div>
                    <div class="author-box-details">
                      <div class="author-box-name">
                        <a href="#"><?= $account['full_name'] ?></a>
                      </div>
                      <div class="author-box-job"><?= $account['email'] ?></div>
                      <div class="author-box-description">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                          consequat.</p>
                      </div>
                      <div class="mb-2 mt-3">
                        <div class="text-small font-weight-bold">Follow Hasan On</div>
                      </div>
                      <a href="#" class="btn btn-social-icon mr-1 btn-facebook">
                        <i class="fab fa-facebook-f"></i>
                      </a>
                      <a href="#" class="btn btn-social-icon mr-1 btn-twitter">
                        <i class="fab fa-twitter"></i>
                      </a>
                      <a href="#" class="btn btn-social-icon mr-1 btn-github">
                        <i class="fab fa-github"></i>
                      </a>
                      <a href="#" class="btn btn-social-icon mr-1 btn-instagram">
                        <i class="fab fa-instagram"></i>
                      </a>
                      <div class="w-100 d-sm-none"></div>
                      <div class="float-right mt-sm-0 mt-3">
                        <a href="#" class="btn">View Posts <i class="fas fa-chevron-right"></i></a>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>
              <div class="col-12 col-sm-12">
                <div class="card">
                  <form method="post" class="needs-validation" novalidate="">
                    <div class="card-header">
                      <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="form-group col-md-6 col-12">
                          <label>Nama</label>
                          <input type="text" class="form-control" value="Ujang" required="">
                          <div class="invalid-feedback">
                            Please fill in the first name
                          </div>
                        </div>
                        <div class="form-group col-md-6 col-12">
                          <label>Gender</label>
                          <select class="form-control selectric">
                            <option>Laki-Laki</option>
                            <option>Perempuan</option>
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-6 col-12">
                          <label>Email</label>
                          <input type="email" class="form-control" value="ujang@maman.com" required="">
                          <div class="invalid-feedback">
                            Please fill in the email
                          </div>
                        </div>
                        <div class="form-group col-md-6 col-12">
                        <label class="form-control-label ">Pilih Gambar</label>
                        <div class="">
                          <div class="custom-file">
                            <input type="file" name="site_logo" class="custom-file-input" id="site-logo">
                            <label class="custom-file-label">Choose File</label>
                          </div>
                        </div>
                    </div>
                      </div>
                      <div class=" text-right">
                        <button class="btn btn-primary">Save Changes</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <?php include('../component/layout/footer.php'); ?>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="../assets/modules/jquery.min.js"></script>
  <script src="../assets/modules/popper.js"></script>
  <script src="../assets/modules/tooltip.js"></script>
  <script src="../assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="../assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="../assets/modules/moment.min.js"></script>
  <script src="../assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="../assets/modules/cleave-js/dist/cleave.min.js"></script>
  <script src="../assets/modules/cleave-js/dist/addons/cleave-phone.us.js"></script>
  <script src="../assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="../assets/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="../assets/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
  <script src="../assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
  <script src="../assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
  <script src="../assets/modules/select2/dist/js/select2.full.min.js"></script>
  <script src="../assets/modules/jquery-selectric/jquery.selectric.min.js"></script>


  <!-- Page Specific JS File -->

  <!-- Template JS File -->
  <script src="../assets/js/scripts.js"></script>
  <script src="../assets/js/custom.js"></script>
</body>

</html>