<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
        <h5 class="font-weight-semibold mb-0">Header</h5>
      </div>
      <div class="card-body">

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Order Number</label>
          <div class="col-sm-6">
            <label class="col-form-label"><?= $ord_head['ord_number'] ?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Procurement Number</label>
          <div class="col-sm-6">
            <label class="col-form-label"><?= $ord_head['prc_number'] ?></label>
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
            <textarea readonly class="form-control"><?= $ord_head['address'] ?></textarea>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Order Date</label>
          <div class="col-sm-3">
            <label class="col-form-label"><?= substr($ord_head['order_date'], 0, 10) ?></label>
          </div>
        </div>

        <!-- <div class="form-group row">
          <label class="col-sm-2 col-form-label">Payment Attachment</label>
          <div class="col-sm-6">
            <?php if ($pa) { ?>
              <div class="input-group col-xs-12">
                <input required type="file" class="form-control file-upload-info file-icon" name="pay_att" placeholder="Upload File">
                <span class="input-group-append">
                  <button class="file-upload-browse btn btn-inverse-success" type="button"><i class="fa fa-upload"></i></button>
                </span>
              </div>
            <?php } else { ?>
              <label class="col-form-label">
                <a target="_blank" href="<?= site_url('auth/dop/' . $dir . "/" . $ord_head['pay_att']) ?>"><?= $ord_head['pay_att'] ?></a>
              </label>
            <?php } ?>
          </div>
        </div> -->

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