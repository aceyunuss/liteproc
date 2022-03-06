<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
        <h5 class="font-weight-semibold mb-0">Vendor</h5>
      </div>

      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="table-responsive">
              <table id="daftar_vendor" class="table table-striped"></table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modal_max" tabindex="-1" role="dialog" aria-labelledby="modal_maxLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog  modal-dialog-centered modal-lg" class="overflow-y: initial !important" role="document" style="width:60%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modal_maxLabel"></h4>
        </button>
      </div>
      <div class="modal-body" style="overflow-y: auto;">


        <input type="hidden" name="prv_id" id="prv" value="">

        <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
          <h5 class="font-weight-semibold mb-0">Header</h5>
        </div>
        <div class="card-body">

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Bid Number</label>
            <div class="col-sm-6">
              <label class="col-form-label" id="bid_number"></label>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Attachment</label>
            <div class="col-sm-6">
              <label class="col-form-label">
                <a href="#" id="att_v" target="_blank"></a>
              </label>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Notes</label>
            <div class="col-sm-6">
              <label class="col-form-label" id="notes"></label>
            </div>
          </div>

        </div>


        <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
          <h5 class="font-weight-semibold mb-0">Item</h5>
        </div>
        <div class="card-body">
          <center>
            <div class="table-responsive">
              <table class="table table-striped quo_table">
                <thead>
                  <tr>
                    <th style="text-align:center; width: 5%;"> No </th>
                    <th style="text-align:center; width: 60%;"> Item Name </th>
                    <th style="text-align:center; width: 5%;"> Quantity </th>
                    <th style="text-align:center; width: 10%;"> UOM </th>
                    <th style="text-align:center; width: 20%;"> Quot Price </th>
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
              <h3 style="text-align: right;">Total</h3>
            </div>
            <div class="col-sm-4">
              <h3 style="text-align: right;" class="quo_total">0</h3>
            </div>
          </div>
        </div>



        <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
          <h5 class="font-weight-semibold mb-0">Evaluation</h5>
        </div>
        <div class="card-body evals">
          <?php foreach ($eval as $key => $value) { ?>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label"><?= $value['ec_name'] ?> </label>
              <div class="col-sm-7">
                <select class="form-control ee" data-ec="<?= $value['ec_id'] ?>">
                  <option value="">-- Select --</option>
                  <?php foreach ($value['sc'] as $v) { ?>
                    <option value="<?= $v['eci_id'] ?>"><?= $v['eci_name'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          <?php } ?>
        </div>
        <br>
        <center class="wase"><h4>This Vendor Was Evaluated</h4></center>
        <hr>
        <center>
          <button type="button" class="btn btn-inverse-warning btn-sm" id="tutup-btn" data-dismiss="modal">Cancel</button>
          <button class="evalsb btn btn-success btn-sm">Submit</button>
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


  function operateFormatter(value, row, index) {
    var link = "<?php echo site_url('procurement') ?>";
    var dis = row.bid_number == null ? "btn-outline-secondary disabled" : "btn-outline-primary";
    // console.log(is_null(row.bid_number)
    return [
      '<a class="btn btn-xs shmo action ' + dis + '" data-toggle="modal" data-target="#modal_max" data-quo="' + value + '"  href="#">',
      'Process',
      '</a>  ',
    ].join('');
  }
</script>

<script type="text/javascript">
  var $daftar_vendor = $('#daftar_vendor')

  $(function() {

    $daftar_vendor.bootstrapTable({

      url: "<?php echo site_url('procurement/get_selected_vendor/' . str_replace("/", ".", $prc_head['prc_number'])) ?>",
      selectItemName: "vendor_tender[]",
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

      cookieIdTable: "vendor_tender",

      idField: "prv_id",
      columns: [{
          field: 'prv_id',
          title: 'Action',
          align: 'center',
          valign: 'middle',
          width: '20%',
          formatter: operateFormatter
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
        {
          field: 'bid_number',
          title: 'Bid Number',
          sortable: true,
          order: true,
          searchable: true,
          align: 'left',
          valign: 'middle'
        },
        {
          field: 'score',
          title: 'Score',
          sortable: true,
          order: true,
          searchable: true,
          align: 'center',
          valign: 'middle'
        },
      ]
    });

    setTimeout(function() {
      $daftar_vendor.bootstrapTable('resetView');
    }, 200);

    $daftar_vendor.on('expand-row.bs.table', function(e, index, row, $detail) {
      $detail.html(detailFormatter(index, row, "alias_vendor"));
    });

    $daftar_vendor.on('check.bs.table  check-all.bs.table', function() {

      selections = getIdSelections();
      var param = "";
      $.each(selections, function(i, val) {
        param += val + "=1&";
      });
      $.ajax({
        url: "<?php echo site_url('procurement/selection/selection_vendor') ?>",
        data: param,
        type: "get"
      });

    });
    $daftar_vendor.on('uncheck.bs.table uncheck-all.bs.table', function() {

      selections = getIdSelections();

      var param = "";
      $.each(selections, function(i, val) {
        param += val + "=0&";
      });
      $.ajax({
        url: "<?php echo site_url('procurement/selection/selection_vendor') ?>",
        data: param,
        type: "get"
      });
    });
    $daftar_vendor.on('expand-row.bs.table', function(e, index, row, $detail) {
      $detail.html(detailFormatter(index, row));

    });
    $daftar_vendor.on('all.bs.table', function(e, name, args) {
      //console.log(name, args);
    });

    function getIdSelections() {
      return $.map($daftar_vendor.bootstrapTable('getSelections'), function(row) {
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



  $(document).on('click', '.shmo', function() {

    let quo = $(this).data("quo")
    let de = ""

    $('.quo_table tbody').html("")
    $('#bid_number').text("");
    $('#att_v').attr("href", "#")
    $('#att_v').text("")
    $('#notes').text("");
    $('#prv').val("");

    $('.ee').removeAttr("disabled");
    $('.evalsb').removeAttr("disabled");
    $('.wase').css("display", "none");

    $.get({
      url: "<?= site_url('procurement/load_quo/')  ?>" + quo,
      type: "GET",
      success: function(data) {
        de = JSON.parse(data)

        $('#bid_number').text(de.head.bid_number);
        $('#att_v').attr("href", "<?= site_url('auth/dop/bid/')  ?>" + de.head.prv_att)
        $('#att_v').text(de.head.prv_att)
        $('#notes').text(de.head.prv_notes);
        $('#prv').val(de.head.prv_id);

        if (de.head.eval_status == 1) {
          $('.wase').css("display", "inline");
          $('.ee').attr("disabled", true)
        }

        total = 0;
        subtotal = 0;
        $.each(de.item, function(index, value) {

          i = index + 1;
          qprice = value.pvi_qprice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

          tbody = '<tr>\
                    <td class="text-center">' + i + '</td>\
                    <td>' + value.pvi_desc + '</td>\
                    <td class="text-center">' + value.pvi_qty + '</td>\
                    <td class="text-center">' + value.pvi_uom + '</td>\
                    <td class="text-right">' + qprice + '</td>\
                  </tr>';

          total = value.pvi_qprice * value.pvi_qty;
          subtotal += total;
          $('.quo_table tbody').append(tbody)
        })
        $('.quo_total').text(subtotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ",00")


      }
    })


  })

  $('.evalsb').click(function(e) {
    e.preventDefault()

    ids = new Array();

    $(".ee").each(function(k, v) {
      id = $(this).data('ec');
      vl = $(this).val()
      ids.push({
        id,
        vl
      });
    });

    prvs = $('#prv').val();

    $.ajax({
      url: '<?= site_url('procurement/submit_prc_eval') ?>',
      type: "POST",
      data: {
        prvs: prvs,
        go: ids
      },
      dataType: 'json',
      cache: false,
      asynce: false,
      success: (function(data) {
        if (data.status == "success") {
          alert("Success")
          location.reload();
        } else {
          alert("Failed")
        }
      })
    });

  })
</script>