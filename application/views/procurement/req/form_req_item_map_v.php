<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
        <h5 class="font-weight-semibold mb-0">Item</h5>
      </div>
      <div class="card-body">
        <center>
          <div class="table-responsive">
            <table class="table table-striped item_table">
              <thead>
                <tr>
                  <th style="text-align:center; width: 5%;"> No </th>
                  <th style="text-align:center; width: 35%;"> Item Name </th>
                  <th style="text-align:center; width: 10%;"> Quantity </th>
                  <th style="text-align:center; width: 10%;"> UOM </th>
                  <th style="text-align:center; width: 40%;"> Estimated Price </th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($req_item as $k => $v) { ?>
                  <tr>
                    <td>
                      <center><?= $k + 1 ?></center>
                      <input type="hidden" name="rqi[<?= $v['rqi_id'] ?>]" value="<?= $v['rqi_id'] ?>">
                    </td>
                    <td><?= $v['rqi_desc'] ?></td>
                    <td>
                      <center class="qty" data-itm="<?= $v['rqi_id'] ?>"><?= $v['rqi_qty'] ?></center>
                    </td>
                    <td>
                      <center>
                        <uom><?= $v['rqi_uom'] ?></uom>
                      </center>
                    </td>
                    <td>
                      <div class="form-group row">
                        <div class="col-sm-5">
                          <input class="form-control prc prc_start" data-itm="<?= $v['rqi_id'] ?>" type="number" name="price[<?= $v['rqi_id'] ?>]" required>
                        </div>
                        <p class="col-form-label">-</p>
                        <div class="col-sm-5">
                          <input class="form-control prc prc_end" data-itm="<?= $v['rqi_id'] ?>" type="number" name="price_end[<?= $v['rqi_id'] ?>]" required>
                        </div>
                      </div>
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
          <div class="col-sm-7">
            <h3 style="text-align: right;">Total</h3>
          </div>
          <div class="col-sm-5">
            <h3 style="text-align: right;" class="total">0</h3>
            <input type="hidden" id="total_start">
            <input type="hidden" id="total_end">
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {

    // $("select[name*='com_code']").change(function() {
    //   let thsval = $(this).val()
    //   let item = $(this).data('itm')

    //   $.ajax({
    //     url: "<?php //site_url('commodity/load_com/') 
                  ?>" + thsval,
    //     type: "get",
    //     dataType: "json",
    //     success: function(data) {
    //       $(".com_name_" + item).val(data.name)
    //       $(".uom_" + item).val(data.uom)
    //       $(".uom_txt_" + item).text(data.uom)
    //     }
    //   })
    // });

    $(".prc_start").on("keyup", function() {
      let subtotal_start = 0;
      let total_start = 0;
      let prc = 0;
      $('.prc_start').each(function(i, obj) {
        itm = $(this).data('itm');
        prc = $('.prc_start[data-itm=' + itm + ']').val()
        prc_start = (prc == 0) ? 0 : parseInt(prc);
        qty = parseInt($('.qty[data-itm=' + itm + ']').text());

        total_start = prc_start * qty;
        subtotal_start += total_start;
      });
      txt_subtotal_start = subtotal_start.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      txt_subtotal_end = $("#total_end").val().toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      $("#total_start").val(txt_subtotal_start);
      $(".total").text(txt_subtotal_start + " - " + txt_subtotal_end)
    })


    $(".prc_end").on("keyup", function() {
      let subtotal_end = 0;
      let total_end = 0;
      $('.prc_end').each(function(i, obj) {
        itm = $(this).data('itm');
        prc = $('.prc_end[data-itm=' + itm + ']').val()
        prc_end = (prc == 0) ? 0 : parseInt(prc);
        qty = parseInt($('.qty[data-itm=' + itm + ']').text());

        total_end = prc_end * qty;
        subtotal_end += total_end;
      });
      txt_subtotal_end = subtotal_end.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      txt_subtotal_start = $("#total_start").val().toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      $("#total_end").val(txt_subtotal_end);
      $(".total").text(txt_subtotal_start + " - " + txt_subtotal_end)
    })
  })
</script>