<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
        <h4 class="card-title mb-0">Comment History</h4>
      </div>
      <div class="card-body">

        <table class="table table-bordered">
          <thead>
            <tr>
              <th style="text-align:center; width:15%;"> Date </th>
              <th style="text-align:center; width:20%;"> User </th>
              <th style="text-align:center; width:20%;"> Role </th>
              <th style="text-align:center; width:30%;"> Comment </th>
              <th style="text-align:center; width:15%;"> Attachment </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ((array)$hist as $val) { ?>
              <tr>
                <td class="text-center"><?= $val['date'] ?></td>
                <td><?= $val['name'] ?></td>
                <td><?= $val['role'] ?></td>
                <td><?= $val['comment'] ?></td>
                <td>
                  <a target="_blank" href="<?= site_url('auth/dop/' . $dir . "/" . $val['att']) ?>"><?= $val['att'] ?></a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
        <h4 class="card-title mb-0">Comment</h4>
      </div>
      <div class="card-body">
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Attachment</label>
          <div class="col-sm-6">
            <div class="input-group col-xs-12">
              <input type="file" class="form-control file-upload-info file-icon" name="comment_att" placeholder="Upload File">
              <span class="input-group-append">
                <button class="file-upload-browse btn btn-inverse-success" type="button"><i class="fa fa-upload"></i></button>
              </span>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Comment</label>
          <div class="col-sm-9">
            <textarea style="height: 100px;" class="form-control" name="comment" required></textarea>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>