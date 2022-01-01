<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
        <h4 class="card-title mb-0">Header</h4>
      </div>
      <div class="card-body">

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Request Number</label>
          <div class="col-sm-6">
            <label class="col-form-label"><?= $req_head['req_number'] ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">User Requester</label>
          <div class="col-sm-6">
            <label class="col-form-label"><?= $req_head['user_name'] ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Division</label>
          <div class="col-sm-6">
            <label class="col-form-label"><?= $req_head['div_name'] ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Procurement Name</label>
          <div class="col-sm-6">
            <label class="col-form-label"><?= $req_head['proc_name'] ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Description</label>
          <div class="col-sm-9">
            <label class="col-form-label"><?= $req_head['proc_desc'] ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Date Needed</label>
          <div class="col-sm-3">
            <label class="col-form-label"><?= substr($req_head['date_needed'], 0, 10) ?></label>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>