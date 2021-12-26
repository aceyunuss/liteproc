<!-- partial -->
<div class="container-fluid page-body-wrapper">
  <!-- partial:partials/_sidebar.html -->
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
          <div class="profile-image">
            <img class="img-xs rounded-circle" src="images/faces/face8.jpg" alt="profile image">
            <div class="dot-indicator bg-success"></div>
          </div>
          <div class="text-wrapper">
            <p class="profile-name">Admin</p>
            <p class="designation">Super User</p>
          </div>
        </a>
      </li>
      <li class="nav-item nav-category">Main Menu</li>
      <li class="nav-item menu-home">
        <a class="nav-link" href="<?= site_url('home') ?>">
          <i class="menu-icon typcn typcn-document-text"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <!-- <li class="nav-item menu-schedule">
        <a class="nav-link" href="<?= site_url('schedule') ?>">
          <i class="menu-icon typcn typcn-shopping-bag"></i>
          <span class="menu-title">Schedule</span>
        </a>
      </li>
      <li class="nav-item menu-settings">
        <a class="nav-link" href="<?= site_url('settings') ?>">
          <i class=" menu-icon typcn typcn-shopping-bag"></i>
          <span class="menu-title">Settings</span>
        </a>
      </li> -->
      <li class="nav-item">
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

      <li class="nav-item menu-users">
        <a class="nav-link" href="<?= site_url('users') ?>">
          <i class="menu-icon typcn typcn-th-large-outline"></i>
          <span class="menu-title">Users</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#proc" aria-expanded="false" aria-controls="proc">
          <i class="menu-icon typcn typcn-coffee"></i>
          <span class="menu-title">Procurement</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="proc">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="pages/ui-features/dropdowns.html">Create</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/ui-features/dropdowns.html">Monitor</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/set_background.html">Evaluation Template</a>
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
  </script>