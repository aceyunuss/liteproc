<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
        <h5 class="font-weight-semibold mb-0"><?= $pg_title ?></h5>
      </div>
      <div class="card-body">
        <div class="form-group row">
          <label class="col-sm-2 col-form-label"><?= $pg_title ?> Attachment</label>
          <div class="col-sm-6">
            <div class="input-group col-xs-12">
              <input type="file" class="form-control file-upload-info file-icon" name="vnd_att" required placeholder="Upload File">
              <span class="input-group-append">
                <button class="file-upload-browse btn btn-inverse-success" type="button"><i class="fa fa-upload"></i></button>
              </span>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Notes</label>
          <div class="col-sm-8">
            <textarea class="form-control" name="vnd_notes"></textarea>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>