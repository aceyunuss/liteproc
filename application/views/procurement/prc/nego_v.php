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
    <form class="forms-sample req_form" method="POST" enctype="multipart/form-data" action="<?= site_url('procurement/submit_nego') ?>">

      <input type="hidden" name="prv_id" value="<?= $prv_id ?>">

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
                  <label class="col-form-label"><?= $head['prc_number'] ?></label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Procurement Name</label>
                <div class="col-sm-6">
                  <label class="col-form-label"><?= $head['proc_name'] ?></label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-9">
                  <label class="col-form-label"><?= $head['proc_desc'] ?></label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Date Needed</label>
                <div class="col-sm-3">
                  <label class="col-form-label"><?= substr($head['date_needed'], 0, 10) ?></label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Bid Number</label>
                <div class="col-sm-4">
                  <label class="col-form-label"><?= $head['bid_number'] ?></label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Attachment</label>
                <div class="col-sm-6">
                  <label class="col-form-label">
                    <a target="_blank" href="<?= site_url('auth/dop/bid/') . $head['prv_att'] ?>"><?= $head['prv_att'] ?></a>
                  </label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Notes</label>
                <div class="col-sm-8">
                  <label class="col-form-label"><?= $head['prv_notes'] ?></label>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>


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
                        <th style="text-align:center; width: 40%;"> Item Name </th>
                        <th style="text-align:center; width: 5%;"> Quantity </th>
                        <th style="text-align:center; width: 10%;"> Estimated Price </th>
                        <th style="text-align:center; width: 10%;"> UOM </th>
                        <th style="text-align:center; width: 10%;"> Quot Price </th>
                        <th style="text-align:center; width: 20%;"> Nego Price </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $total = $subtotal = $totalq = $subtotalq = 0;
                      foreach ($item as $k => $v) {
                        $total = $v['pvi_price'] * $v['pvi_qty'];
                        $subtotal += $total;

                        $totalq = $v['pvi_qprice'] * $v['pvi_qty'];
                        $subtotalq += $totalq;
                      ?>
                        <tr>
                          <td class="text-center"><?= $k + 1 ?></td>
                          <td><?= $v['pvi_desc'] ?></td>
                          <td class="text-center qty" data-itm="<?= $v['pvi_id'] ?>"><?= $v['pvi_qty'] ?></td>
                          <td class="text-right"><?= number_format($v['pvi_price'], 2, ',', '.') ?></td>
                          <td class="text-center"><?= $v['pvi_uom'] ?></td>
                          <td class="text-right"><?= number_format($v['pvi_qprice'], 2, ',', '.') ?></td>
                          <td>
                            <input required type="number" data-itm="<?= $v['pvi_id'] ?>" min="0" name="nprice[<?= $v['pvi_id'] ?>]" class="prc form-control" value="<?= $v['pvi_nprice'] ?>">
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
                  <h4 style="text-align: right;">Total Estimated Price</h4>
                </div>
                <div class="col-sm-3">
                  <h4 style="text-align: right;"><?= number_format($subtotal, 2, ',', '.') ?></h4>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-9">
                  <h4 style="text-align: right;">Total Quot Price</h4>
                </div>
                <div class="col-sm-3">
                  <h4 style="text-align: right;"><?= number_format($subtotalq, 2, ',', '.') ?></h4>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-9">
                  <h4 style="text-align: right;">Total Nego Price</h4>
                </div>
                <div class="col-sm-3">
                  <h4 style="text-align: right;" class="total"><?= number_format($subtotalq, 2, ',', '.') ?></h4>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>



      <div class="card">
        <div class="card-body">
          <center>
            <input type="hidden" name="status" value="" id="status">
            <button style="font-size: 16px;" onclick="history.back()" class="btn btn-secondary btn-sm">&nbsp;&nbsp;Back&nbsp;&nbsp;</button>
            <button style="font-size: 16px;" type="submit" class="btn btn-success  btn-sm act" data-stat="y">Submit</button>
          </center>
        </div>
      </div>

    </form>
  </div>


  <script>
    $(document).ready(function() {

      $('.act').click(function() {
        if (typeof er_msg === "undefined") {
          let stat = $(this).data("stat");
          $('#status').val(stat)
        } else {
          if (er_msg != "") {
            e.preventDefault();
            alert(er_msg)
          }
        }
      })


      $(".prc").on("keyup", function() {
        let subtotal = 0;
        let total = 0;
        $('.prc').each(function(i, obj) {
          itm = $(this).data('itm');
          prc = ($(this).val() == "") ? 0 : parseInt($(this).val());
          qty = parseInt($('.qty[data-itm=' + itm + ']').text());
          // console.log
          total = prc * qty;
          subtotal += total;
        });
        txt_subtotal = subtotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ",00";
        $(".total").text(txt_subtotal);
      })
    })
  </script>