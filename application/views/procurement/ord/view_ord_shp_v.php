<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
        <h4 class="card-title mb-0"><?= $shp ?></h4>
      </div>
      <div class="card-body">
        <div class="form-group row">
          <label class="col-sm-2 col-form-label"><?= $shp ?> Attachment</label>
          <div class="col-sm-8">
            <a target="_blank" href="<?= site_url('auth/dop/' . $dir . "/" . $ord_head['vnd_att']) ?>"><?= $ord_head['vnd_att'] ?></a>
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