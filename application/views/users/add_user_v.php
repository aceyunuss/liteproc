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
        <form class="forms-sample" method="POST" action="<?= site_url('users/submit_add') ?>">

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">NPP</label>
            <div class="col-sm-6">
              <input type="text" maxlength="20" class="form-control" name="npp" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Fullname</label>
            <div class="col-sm-6">
              <input type="text" maxlength="255" class="form-control" name="name" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Role</label>
            <div class="col-sm-6">
              <select class="form-control form-control cat" name="role" required>
                <option value=""> -- Select -- </option>
                <?php foreach ($role as $v) { ?>
                  <option value="<?= $v['role_name'] ?>"><?= $v['role_name'] ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Division</label>
            <div class="col-sm-6">
              <select class="form-control form-control cat" name="div" required>
                <option value=""> -- Select -- </option>
                <?php foreach ($div as $v) { ?>
                  <option value="<?= $v['div_id'] ?>"><?= $v['div_code'] . ' - ' . $v['div_name'] ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Phone</label>
            <div class="col-sm-6">
              <input type="text" maxlength="16" class="form-control" name="phone" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-6">
              <input type="email" maxlength="255" class="form-control" name="email" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-6">
              <input type="password" maxlength="255" class="form-control" name="password" required>
            </div>
          </div>

          <center>
            <a class="btn btn-inverse-warning btn-sm" href="<?= site_url('users') ?>">Cancel</a>
            <button type="submit" class="btn btn-success btn-sm">Submit</button>
          </center>

        </form>
      </div>
    </div>
  </div>