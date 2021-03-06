<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
        <h5 class="font-weight-semibold mb-0"><?= $shp ?></h5>
      </div>
      <div class="card-body">
        <div class="form-group row">
          <label class="col-sm-2 col-form-label"><?= $shp ?> Attachment</label>
          <div class="col-sm-8">
            <label class="col-form-label"><a target="_blank" href="<?= site_url('auth/dop/' . $dir . "/" . $ord_head['vnd_att']) ?>"><?= $ord_head['vnd_att'] ?></a></label>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Notes</label>
          <div class="col-sm-8">
            <textarea class="form-control" readonly><?= $ord_head['vnd_notes'] ?></textarea>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>