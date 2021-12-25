<div class="main-panel">
  <div class="content-wrapper">
    <!-- Page Title Header Starts-->
    <div class="row page-title-header">
      <div class="col-12">
        <div class="page-header">
          <h4 class="page-title"><?= $pg_title ?></h4>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
        <h4 class="card-title mb-0">Form</h4>
      </div>
      <div class="card-body">
        <form class="forms-sample" method="POST" action="<?= site_url('commodity/submit_add') ?>">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Type</label>
            <div class="col-sm-6">
              <select class="form-control form-control type" name="type" required>
                <option value=""> -- Select -- </option>
                <option value="Goods">Goods</option>
                <option value="Service">Service</option>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Category</label>
            <div class="col-sm-6">
              <select class="form-control form-control cat" name="cat" required>
                <option value=""> -- Select -- </option>
                <?php foreach ($group_lv1 as $v) { ?>
                  <option value="<?= $v['group_code'] ?>"><?= $v['group_code'] . ' - ' . $v['group_name'] ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Sub Category</label>
            <div class="col-sm-6">
              <select class="form-control form-control sub-cat" name="sub_cat" required>
                <option value=""> -- Select -- </option>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-6">
              <input type="text" maxlength="255" class="form-control" name="name" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">UOM</label>
            <div class="col-sm-6">
              <input type="text" maxlength="255" class="form-control" name="uom" required>
            </div>
          </div>

          <div class="form-group row mat">
            <label class="col-sm-2 col-form-label">Brand Name</label>
            <div class="col-sm-6">
              <input type="text" maxlength="255" class="form-control" name="brand_name">
            </div>
          </div>

          <div class="form-group row mat">
            <label class="col-sm-2 col-form-label">Brand Model</label>
            <div class="col-sm-6">
              <input type="text" maxlength="255" class="form-control" name="brand_model">
            </div>
          </div>

          <div class="form-group row mat">
            <label class="col-sm-2 col-form-label">Dimension (cm)</label>
            <div class="col-sm-2">
              <input type="number" min="0" maxlength="16" class="form-control" name="long" placeholder="long">
            </div>
            <div class="col-sm-2">
              <input type="number" min="0" maxlength="16" class="form-control" name="width" placeholder="width">
            </div>
            <div class="col-sm-2">
              <input type="number" min="0" maxlength="16" class="form-control" name="height" placeholder="height">
            </div>
          </div>

          <div class="form-group row mat">
            <label class="col-sm-2 col-form-label">Colour</label>
            <div class="col-sm-6">
              <input type="text" maxlength="255" class="form-control" name="colour">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Specification</label>
            <div class="col-sm-6">
              <textarea style="height: 100px;" class="form-control" name="spec"></textarea>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Others</label>
            <div class="col-sm-6">
              <textarea style="height: 100px;" class="form-control" name="others"></textarea>
            </div>
          </div>

          <center>
            <a class="btn btn-inverse-warning btn-sm" href="<?= site_url('commodity') ?>">Cancel</a>
            <button type="submit" class="btn btn-success btn-sm">Submit</button>
          </center>

        </form>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {

      $('.cat').on('change', function() {
        $.ajax({
          url: "<?php echo site_url('commodity/get_sub_group?code=') ?>" + this.value,
          type: "get",
          dataType: "json",
          success: function(data) {
            $(".sub-cat").html("");
            $(".sub-cat").html("<option value=''> -- Select -- </option>");
            $.each(data, function(index, row) {
              $(".sub-cat").append("<option value='" + row.group_code + "'>" + row.group_code + " - " + row.group_name + "</option>");
            });
          }
        });
      });


      $('.type').on('change', function() {
        if (this.value == "S") {
          $('.mat').hide(200)
        } else {
          $('.mat').show(200)
        }
      });
    });
  </script>