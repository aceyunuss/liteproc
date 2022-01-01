<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
        <h4 class="card-title mb-0">Preparation</h4>
      </div>
      <div class="card-body">

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Bid Opening</label>
          <div class="col-sm-6">
            <input type="date" id="datefield" name="needed" class="needed datetimepicker form-control" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Bid Closing</label>
          <div class="col-sm-6">
            <input type="date" id="datefield" name="needed" class="needed datetimepicker form-control" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Method</label>
          <div class="col-sm-6">
            <select class="form-control" name="method" required>
              <option value="">-- Select --</option>
              <?php foreach ($method as $k => $v) { ?>
                <option value="<?= $k ?>"><?= $v ?></option>
              <?php } ?>
            </select>
          </div>
        </div>


        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Evaluation Template</label>
          <div class="col-sm-6">
            <select class="form-control" name="method" required>
              <option value="">-- Select --</option>
              <?php foreach ($eval as $k => $v) { ?>
                <option value="<?= $v['eval_id'] ?>"><?= $v['eval_name'] ?></option>
              <?php } ?>
            </select>
          </div>
        </div>


        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Division</label>
          <div class="col-sm-6">
            <label class="col-form-label"><?= $usr['div_name'] ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Procurement Name</label>
          <div class="col-sm-6">
            <input type="text" maxlength="255" class="form-control" name="proc_name" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Description</label>
          <div class="col-sm-9">
            <textarea class="form-control" name="proc_desc"></textarea>
          </div>
        </div>


        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Date Needed</label>
          <div class="col-sm-3">
            <input type="date" id="datefield" name="needed" class="needed datetimepicker form-control" required>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0 so need to add 1 to make it 1!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd
    }
    if (mm < 10) {
      mm = '0' + mm
    }
    today = yyyy + '-' + mm + '-' + dd;
    $('.needed').attr("min", today)

  })
</script>