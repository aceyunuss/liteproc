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
        <h5 class="font-weight-semibold mb-0">Form</h5>
      </div>
      <div class="card-body">
        <form class="forms-sample" method="POST" action="<?= site_url('division/submit_edit') ?>">

          <input type="hidden" value="<?= $div['div_id'] ?>" name="div_id">

          <div class="form-group row mat">
            <label class="col-sm-2 col-form-label">Code</label>
            <div class="col-sm-6">
              <input type="text" maxlength="10" value="<?= $div['div_code'] ?>" class="form-control" name="code" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-6">
              <input type="text" maxlength="255" value="<?= $div['div_name'] ?>" class="form-control" name="name" required>
            </div>
          </div>

          <center>
            <a class="btn btn-inverse-warning btn-sm" href="<?= site_url('division') ?>">Cancel</a>
            <button type="submit" class="btn btn-success btn-sm">Submit</button>
          </center>

        </form>
      </div>
    </div>
  </div>