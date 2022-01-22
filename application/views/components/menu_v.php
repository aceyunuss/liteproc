<!-- partial -->
<div class="container-fluid page-body-wrapper">
  <!-- partial:partials/_sidebar.html -->
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
          <div class="profile-image">
            <i class="fa fa-smile-o fa-3x"></i>
          </div>
          <div class="text-wrapper">
            <p class="profile-name" style="font-size:17px;"><?= $this->session->userdata('user_ses')['name'] ?></p>
            <p class="designation" style="font-size:12px;"><?= $this->session->userdata('user_ses')['role'] ?></p>
          </div>
        </a>
      </li>
      <li class="nav-item menu-home">
        <a class="nav-link" href="<?= site_url('home') ?>">
          <i class="menu-icon typcn typcn-document-text"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item menu-commodity menu-vendor menu-division menulist">
        <a class="nav-link" data-toggle="collapse" href="#master" aria-expanded="false" aria-controls="master">
          <i class="menu-icon typcn typcn-coffee"></i>
          <span class="menu-title">Master Data</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="master">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="<?= site_url('commodity') ?>">Commodity</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= site_url('vendor') ?>">Vendor</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= site_url('division') ?>">Division</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item menu-users menulist">
        <a class="nav-link" href="<?= site_url('users') ?>">
          <i class="menu-icon typcn typcn-th-large-outline"></i>
          <span class="menu-title">Users</span>
        </a>
      </li>

      <li class="nav-item menu-procurement menulist">
        <a class="nav-link" data-toggle="collapse" href="#proc" aria-expanded="false" aria-controls="proc">
          <i class="menu-icon typcn typcn-coffee"></i>
          <span class="menu-title">Procurement</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="proc">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item menulist create">
              <a class="nav-link" href="<?= site_url('procurement/create') ?>">Create</a>
            </li>
            <li class="nav-item menulist monitor">
              <a class="nav-link" href="<?= site_url('procurement/monitor') ?>">Monitor</a>
            </li>
            <li class="nav-item menulist templ">
              <a class="nav-link" href="<?= site_url('procurement/eval_template') ?>">Evaluation Template</a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </nav>

  <script>
    var sel_menu = "<?= $sel_menu ?>";
    $(".menu-" + sel_menu).css({
      "background-color": "#293846"
    });

    let role = "<?= $this->session->userdata('user_ses')['role'] ?>"

    $('.menulist').hide();
    switch (role) {
      case "PIC USER":
        $('.menu-procurement, .monitor, .create').show();
        break;
      case "PIC PROCUREMENT":
        $('.menu-procurement, .menu-commodity, .menu-vendor, .menu-division, .monitor, .templ, .menu-users').show();
        break;
      case "FINANCE":
        $('.menu-procurement, .monitor').show();
        break;
      case "DIV HEAD":
        $('.menu-procurement, .monitor').show();
        break;
    }
  </script>