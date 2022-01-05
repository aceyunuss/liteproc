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
            <label class="col-form-label"><?= substr($prc_head['bid_open'], 0, 10) ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Bid Closing</label>
          <div class="col-sm-6">
            <label class="col-form-label"><?= substr($prc_head['bid_close'], 0, 10) ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Evaluation Template</label>
          <div class="col-sm-6">
            <label class="col-form-label"><?= substr($prc_head['date_needed'], 0, 10) ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Procurement Type</label>
          <div class="col-sm-6">
            <label class="col-form-label"><?= $prc_head['proc_type'] ?></label>
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