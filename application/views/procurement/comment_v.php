<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
        <h4 class="card-title mb-0">Comment History</h4>
      </div>
      <div class="card-body">

        <table class="table table-striped">
          <thead>
            <tr>
              <th style="text-align:center"> Date </th>
              <th style="text-align:center"> User </th>
              <th style="text-align:center"> Role </th>
              <th style="text-align:center"> Notes </th>
              <th style="text-align:center"> Attachment </th>
            </tr>
          </thead>
          <tbody>

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
            <textarea style="height: 150px;" class="form-control" name="comment" required></textarea>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>