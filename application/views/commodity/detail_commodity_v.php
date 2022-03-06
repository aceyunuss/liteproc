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

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Code</label>
          <div class="col-sm-6">
            <label class="col-form-label"><?= $com['com_code'] ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Name</label>
          <div class="col-sm-6">
            <label class="col-form-label"><?= $com['name'] ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Type</label>
          <div class="col-sm-6">
            <label class="col-form-label"><?= $com['type'] ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Category</label>
          <div class="col-sm-6">
            <label class="col-form-label"><?= $com['p_code'] . " - " . $com['p_name'] ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Sub Category</label>
          <div class="col-sm-6">
            <label class="col-form-label"><?= $com['group_code'] . " - " . $com['group_name'] ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Uom</label>
          <div class="col-sm-6">
            <label class="col-form-label"><?= $com['uom'] ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Brand Name</label>
          <div class="col-sm-6">
            <label class="col-form-label"><?= $com['brand_name'] ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Brand Model</label>
          <div class="col-sm-6">
            <label class="col-form-label"><?= $com['brand_model'] ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Dimension (cm)</label>
          <div class="col-sm-6">
            <label class="col-form-label"><?= str_replace(",", " x ", $com['dimension']) ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Colour</label>
          <div class="col-sm-6">
            <label class="col-form-label"><?= $com['colour'] ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Specification</label>
          <div class="col-sm-6">
            <textarea style="height: 100px;" class="form-control" disabled><?= $com['spec'] ?></textarea>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Others</label>
          <div class="col-sm-6">
            <textarea style="height: 100px;" class="form-control" disabled><?= $com['others'] ?></textarea>
          </div>
        </div>

        <center>
          <a class="btn btn-outline-success btn-sm" href="<?= site_url('commodity') ?>">Back</a>
        </center>
      </div>
    </div>
  </div>