<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
        <h4 class="card-title mb-0">Item</h4>
      </div>
      <div class="card-body">
        <center>
          <div class="table-responsive">
            <table class="table table-striped item_table">
              <thead>
                <tr>
                  <th style="text-align:center; width: 5%;"> No </th>
                  <th style="text-align:center; width: 30%;"> Item Name </th>
                  <th style="text-align:center; width: 5%;"> Quantity </th>
                  <th style="text-align:center; width: 30%;"> Commodity </th>
                  <th style="text-align:center; width: 20%;"> Estimated Price </th>
                  <th style="text-align:center; width: 10%;"> UOM </th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($req_item as $k => $v) { ?>
                  <tr>
                    <td>
                      <center><?= $k + 1 ?></center>
                    </td>
                    <td><?= $v['rqi_free_desc'] ?></td>
                    <td>
                      <center class="qty" data-itm="<?= $v['rqi_id'] ?>"><?= $v['rqi_qty'] ?></center>
                    </td>
                    <td>
                      <center>
                        <select class="select2" name="com_code[<?= $v['rqi_id'] ?>]" style="width: 100%;" required data-itm="<?= $v['rqi_id'] ?>">
                          <option value="">-- Select --</option>
                          <?php foreach ($com as $vc) { ?>
                            <option value="<?= $vc['com_code'] ?>"><?= $vc['com_code'] . " - " . $vc['name'] ?></option>
                          <?php } ?>
                        </select>
                      </center>
                      <input type="hidden" class="com_name_<?= $v['rqi_id'] ?>" name="com_name[<?= $v['rqi_id'] ?>]" value="">
                    </td>
                    <td>
                      <input class="form-control prc" data-itm="<?= $v['rqi_id'] ?>" type="number" name="price[<?= $v['rqi_id'] ?>]" required>
                    </td>
                    <td>
                      <center>
                        <uom class="uom_txt_<?= $v['rqi_id'] ?>"></uom>
                        <input class="uom_<?= $v['rqi_id'] ?>" type="hidden" name="uom[<?= $v['rqi_id'] ?>]" value="">
                      </center>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </center>
        <hr>
        <br>
        <div class="form-group row">
          <div class="col-sm-9">
            <h3 style="text-align: right;">Total</h3>
          </div>
          <div class="col-sm-3">
            <h3 style="text-align: right;" class="total">0</h3>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {

    $("select[name*='com_code']").change(function() {
      let thsval = $(this).val()
      let item = $(this).data('itm')

      $.ajax({
        url: "<?= site_url('commodity/load_com/') ?>" + thsval,
        type: "get",
        dataType: "json",
        success: function(data) {
          $(".com_name_" + item).val(data.name)
          $(".uom_" + item).val(data.uom)
          $(".uom_txt_" + item).text(data.uom)
        }
      })
    });

    $(".prc").on("keyup", function() {
      let subtotal = 0;
      let total = 0;
      $('.prc').each(function(i, obj) {
        itm = $(this).data('itm');
        prc = ($(this).val() == "") ? 0 : parseInt($(this).val());
        qty = parseInt($('.qty[data-itm=' + itm + ']').text());

        total = prc * qty;
        subtotal += total;
      });
      txt_subtotal = subtotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      $(".total").text(txt_subtotal);
    })
  })
</script>