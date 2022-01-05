<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
        <h4 class="card-title mb-0">Vendor Nego</h4>
      </div>

      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="table-responsive">
              <table id="vendor_nego" class="table table-striped"></table>
            </div>
          </div>
        </div>

        <br>
        <br>
        <div class="form-group row">
          <p class="col-sm-2 col-form-label">Nego Status</p>
          <div class="form-check form-check-flat">
            <label class="form-check-label">
              <input type="checkbox" class="cmpl" name="complete_nego" value="1" class="form-input"> Complete <i class="input-helper"></i>
            </label>
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
        <h4 class="card-title mb-0">Vendor Winner</h4>
      </div>

      <div class="card-body">
        <div class="form-group row">
          <div class="col-sm-12">
            <center>
              <select class="form-control select2 winner" name="winner" style="width: 50%;">
                <option value="">-- Select --</option>
                <?php foreach ($vnd_list as $key => $value) { ?>
                  <option value="<?= $value['prv_vnd_id'] ?>"><?= $value['vendor_name'] . " (" . $value['score'] . ")" ?></option>
                <?php } ?>
              </select>
            </center>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="modal_min" tabindex="-1" role="dialog" aria-labelledby="modal_minLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog  modal-dialog-centered modal-lg" class="overflow-y: initial !important" role="document" style="width:60%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modal_minLabel"></h4>
        </button>
      </div>
      <div class="modal-body" style="overflow-y: auto;">

        <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
          <h4 class="card-title mb-0">Item</h4>
        </div>
        <div class="card-body">
          <center>
            <div class="table-responsive">
              <table class="table table-striped nego_table">
                <thead>
                  <tr>
                    <th style="text-align:center; width: 5%;"> No </th>
                    <th style="text-align:center; width: 50%;"> Item Name </th>
                    <th style="text-align:center; width: 5%;"> Quantity </th>
                    <th style="text-align:center; width: 10%;"> UOM </th>
                    <th style="text-align:center; width: 15%;"> Quot Price </th>
                    <th style="text-align:center; width: 15%;"> Nego Price </th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </center>
          <hr>
          <div class="form-group row">
            <div class="col-sm-8">
              <h4 style="text-align: right;">Total Quot Price</h4>
            </div>
            <div class="col-sm-4">
              <h4 style="text-align: right;" class="quo_total">0</h4>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-8">
              <h4 style="text-align: right;">Total Nego Price</h4>
            </div>
            <div class="col-sm-4">
              <h4 style="text-align: right;" class="nego_total">0</h4>
            </div>
          </div>
        </div>

        <center>
          <button type="button" class="btn btn-inverse-warning btn-sm" id="tutup-btn" data-dismiss="modal">Back</button>
        </center>

      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
  jQuery.extend({
    getCustomJSON: function(url) {
      var result = null;
      $.ajax({
        url: url,
        type: 'get',
        dataType: 'json',
        async: false,
        success: function(data) {
          result = data;
        }
      });
      return result;
    }
  });


  function operateFormatterso(value, row, index) {
    var link = "<?php echo site_url('procurement') ?>";
    var dis = row.prv_nego == 2 ? "btn-outline-primary" : "btn-outline-secondary disabled";

    return [
      '<a class="btn btn-xs shn action ' + dis + '" data-toggle="modal" data-target="#modal_min" data-nego="' + value + '"  href="#">',
      'View',
      '</a>  ',
    ].join('');
  }
</script>

<script type="text/javascript">
  var $vendor_nego = $('#vendor_nego')

  $(function() {

    $vendor_nego.bootstrapTable({

      url: "<?php echo site_url('procurement/get_vendor_nego/' . str_replace("/", ".", $prc_head['prc_number'])) ?>",
      selectItemName: "vendor_nego[]",
      striped: true,
      sidePagination: 'server',
      smartDisplay: false,
      cookie: true,
      cookieExpire: '1h',
      showExport: true,
      showFilter: true,
      flat: true,
      keyEvents: false,
      showMultiSort: false,
      reorderableColumns: false,
      resizable: false,
      pagination: true,
      cardView: false,
      detailView: false,
      search: true,
      showRefresh: true,
      showToggle: true,
      clickToSelect: true,
      showColumns: true,

      cookieIdTable: "vendor_nego",

      idField: "hist_id",
      columns: [{
          field: 'checkbox',
          checkbox: true,
          align: 'center',
          valign: 'middle'
        },
        {
          field: 'prv_id',
          title: 'Action',
          align: 'center',
          valign: 'middle',
          width: '20%',
          formatter: operateFormatterso
        },
        {
          field: 'vendor_name',
          title: 'Vendor Name',
          sortable: true,
          order: true,
          searchable: true,
          align: 'left',
          valign: 'middle'
        },
        {
          field: 'class',
          title: 'Classification',
          sortable: true,
          order: true,
          searchable: true,
          align: 'left',
          valign: 'middle'
        },
      ]
    });

    setTimeout(function() {
      $vendor_nego.bootstrapTable('resetView');
    }, 200);

    $vendor_nego.on('expand-row.bs.table', function(e, index, row, $detail) {
      $detail.html(detailFormatter(index, row, "alias_vendor"));
    });

    $vendor_nego.on('check.bs.table  check-all.bs.table', function() {

      selections = getIdSelections();
      var param = "";
      $.each(selections, function(i, val) {
        param += val + "=1&";
      });
      $.ajax({
        url: "<?php echo site_url('procurement/selection/selection_vendor_nego') ?>",
        data: param,
        type: "get"
      });

    });
    $vendor_nego.on('uncheck.bs.table uncheck-all.bs.table', function() {

      selections = getIdSelections();

      var param = "";
      $.each(selections, function(i, val) {
        param += val + "=0&";
      });
      $.ajax({
        url: "<?php echo site_url('procurement/selection/selection_vendor_nego') ?>",
        data: param,
        type: "get"
      });
    });
    $vendor_nego.on('expand-row.bs.table', function(e, index, row, $detail) {
      $detail.html(detailFormatter(index, row));

    });
    $vendor_nego.on('all.bs.table', function(e, name, args) {
      //console.log(name, args);
    });

    function getIdSelections() {
      return $.map($vendor_nego.bootstrapTable('getSelections'), function(row) {
        return row.vendor_id
      });
    }

    function responseHandler(res) {
      $.each(res.rows, function(i, row) {
        row.state = $.inArray(row.vendor_id, selections) !== -1;
      });
      return res;
    }

  });



  $(document).on('click', '.shn', function() {

    let quo = $(this).data("nego")
    let de = ""

    $('.nego_table tbody').html("")

    $.get({
      url: "<?= site_url('procurement/load_quo/')  ?>" + quo,
      type: "GET",
      success: function(data) {
        de = JSON.parse(data)

        total = 0;
        subtotal = 0;
        totaln = 0;
        subtotaln = 0
        $.each(de.item, function(index, value) {

          i = index + 1;
          qprice = value.pvi_qprice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
          nprice = value.pvi_nprice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

          tbody = '<tr>\
            <td class="text-center">' + i + '</td>\
            <td>' + value.pvi_desc + '</td>\
            <td class="text-center">' + value.pvi_qty + '</td>\
            <td class="text-center">' + value.pvi_uom + '</td>\
            <td class="text-right">' + qprice + '</td>\
            <td class="text-right">' + nprice + '</td>\
          </tr>';

          total = value.pvi_qprice * value.pvi_qty;
          subtotal += total;

          totaln = value.pvi_nprice * value.pvi_qty;
          subtotaln += totaln;
          $('.nego_table tbody').append(tbody)
        })
        $('.quo_total').text(subtotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ",00")
        $('.nego_total').text(subtotaln.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ",00")


      }
    })


  })


  $(document).on('click', '.cmpl', function() {
    let ce = $('.cmpl').is(":checked")
    if(ce){
      $('.winner').attr("required", true)
    }

  })
</script>