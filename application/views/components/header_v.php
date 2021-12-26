<body>

  <div class="container-scroller">
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="<?= site_url() ?>">
          <!-- <div style="background-color:white; margin: 3px; padding: 3px; width: 100px; height: 50px;"> -->
          <img style="width:100%; height:70%;" src="<?= base_url('assets/images/adw.png') ?>" alt="logo" />
          <!-- </div> -->
        </a>
        <a class="navbar-brand brand-logo-mini" href="<?= site_url() ?>">
          <img src="<?= base_url('assets/images/adw.png') ?>" alt="logo" /> </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item font-weight-semibold d-none d-lg-block">
            <a style="text-decoration: none; font-weight:bold;" href="<?= site_url('auth/logout') ?>" onclick="return confirm('Are you sure?')" class="h5">Logout</a>
          </li>
          <li>&nbsp;&nbsp;&nbsp;&nbsp;</li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>