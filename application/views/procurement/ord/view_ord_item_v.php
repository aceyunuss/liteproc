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
                  <!-- <th style="text-align:center; width: 30%;"> Item Name </th> -->
                  <th style="text-align:center; width: 60%;"> Item Name </th>
                  <th style="text-align:center; width: 10%;"> Quantity </th>
                  <th style="text-align:center; width: 10%;"> UOM </th>
                  <th style="text-align:center; width: 15%;"> Price </th>
                </tr>
              </thead>
              <tbody>
                <?php
                $total = $subtotal = 0;
                foreach ($ord_item as $k => $v) {
                  $total = $v['ori_price'] * $v['ori_qty'];
                  $subtotal += $total;
                ?>
                  <tr>
                    <td class="text-center"><?= $k + 1 ?></td>
                    <td><?= $v['ori_desc'] ?></td>
                    <td class="text-center"><?= $v['ori_qty'] ?></td>
                    <td class="text-center"><?= $v['ori_uom'] ?></td>
                    <td class="text-right"><?= number_format($v['ori_price'], 2, ',', '.') ?></td>
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
            <h3 style="text-align: right;" class="total"><?= number_format($subtotal, 2, ',', '.') ?></h3>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>