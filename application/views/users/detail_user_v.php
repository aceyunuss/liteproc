<div class="main-panel">
  <div class="content-wrapper">
    <!-- Page Title Header Starts-->
    <div class="row page-title-header">
      <div class="col-12">
        <div class="page-header">
          <h4 class="page-title"><?= $pg_title ?></h4>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
        <h4 class="card-title mb-0">Form</h4>
      </div>
      <div class="card-body">

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Code</label>
          <div class="col-sm-6">
            <label class="col-form-label"><?= $usr['npp'] ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Name</label>
          <div class="col-sm-6">
            <label class="col-form-label"><?= $usr['fullname'] ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Role</label>
          <div class="col-sm-6">
            <label class="col-form-label"><?= $usr['role_name'] ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Division</label>
          <div class="col-sm-6">
            <label class="col-form-label"><?= $usr['div_code'] . " - " . $usr['div_name'] ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Phone</label>
          <div class="col-sm-6">
            <label class="col-form-label"><?= $usr['phone'] ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-6">
            <label class="col-form-label"><?= $usr['email'] ?></label>
          </div>
        </div>

        <center>
          <a class="btn btn-outline-success btn-sm" href="<?= site_url('users') ?>">Back</a>
        </center>
      </div>
    </div>
  </div>