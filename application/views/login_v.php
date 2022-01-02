<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/iconfonts/ionicons/dist/css/ionicons.css">
  <link rel="stylesheet" href="assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/shared/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="assets/images/adw.ico" />
  <link rel="stylesheet" href="assets/js/sweetalert/dist/sweetalert2.min.css">
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <p class="h2 text-center tittl">Login Internal</p>
            <p>
            <div class="auto-form-wrapper">
              <form method="POST" action="<?= site_url('auth/login') ?>">
                <input type="hidden" id="tit" value="i" name="role">
                <div class="form-group">
                  <label class="label">Email</label>
                  <div class="input-group">
                    <input type="text" name="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Password</label>
                  <div class="input-group">
                    <input type="password" name="password" class="form-control" placeholder="*********">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <input value="Login" type="submit" class="btn btn-primary submit-btn btn-block go-login">
                </div>
                <div class="form-group d-flex justify-content-between">
                  &nbsp;
                  <a href="#" id="swc" class="text-small forgot-password text-black">Login as Vendor</a>
                </div>
              </form>
            </div>
            <ul class="auth-footer">
              <li>
                <a href="#">Conditions</a>
              </li>
              <li>
                <a href="#">Help</a>
              </li>
              <li>
                <a href="#">Terms</a>
              </li>
            </ul>
            <p class="footer-text text-center">Copyright &copy; 2021 Al. All rights reserved.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="assets/vendors/js/vendor.bundle.addons.js"></script>
  <script src="assets/js/core.js"></script>
  <script src="assets/js/sweetalert/dist/sweetalert2.all.min.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="assets/js/shared/off-canvas.js"></script>
  <script src="assets/js/shared/misc.js"></script>
  <!-- endinject -->
  <!-- <script src="assets/js/shared/jquery.cookie.js" type="text/javascript"></script> -->
</body>

</html>


<script>
  $(document).ready(function() {

    $('#swc').click(function() {

      if ($('#tit').val() == "v") {

        st = "Internal";
        ft = "Vendor";
        ds = "inline";
        ti = "i";
      } else {
        st = "Vendor";
        ft = "Internal";
        ds = "none";
        ti = "v";
      }

      $('.tittl').text("Login " + st)
      $('#swc').text("Login as " + ft)
      $('#tit').val(ti);
      $('.cons').css({
        'display': ds
      })
    })
  })
</script>