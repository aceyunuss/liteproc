<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
        <h4 class="card-title mb-0">Header</h4>
      </div>
      <div class="card-body">

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Procurement Number</label>
          <div class="col-sm-6">
            <label class="col-form-label"><?= $ord_head['ord_number'] ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">User Requester</label>
          <div class="col-sm-6">
            <label class="col-form-label"><?= $ord_head['user_name'] ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Division</label>
          <div class="col-sm-6">
            <label class="col-form-label"><?= $ord_head['div_name'] ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Procurement Name</label>
          <div class="col-sm-6">
            <label class="col-form-label"><?= $ord_head['proc_name'] ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Description</label>
          <div class="col-sm-9">
            <label class="col-form-label"><?= $ord_head['proc_desc'] ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Vendor</label>
          <div class="col-sm-9">
            <label class="col-form-label"><?= $ord_head['vnd_name'] ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Address To</label>
          <div class="col-sm-8">
            <textarea name="address" class="form-control" required></textarea>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Order Date</label>
          <div class="col-sm-3">
            <input type="date" id="datefield" name="order_date" class="needed datetimepicker form-control" required>
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