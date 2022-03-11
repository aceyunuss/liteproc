<div class="main-panel">
  <div class="content-wrapper">
    <div class="row page-title-header">
      <div class="col-12">
        <div class="page-header">
          <h4 class="page-title"><?= $pg_title ?></h4>
        </div>
      </div>
    </div>

    <?php
    $msg = $this->session->userdata('message');
    if (!empty($msg)) { ?>
      <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <?php echo $msg ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php $this->session->unset_userdata('message');
    } ?>

    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="card">
          <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
            <h5 class="font-weight-semibold mb-0">Monitor Request</h5>
          </div>

          <div class="card-body">
            <div class="form-group row">
              <label class="col-sm-1 col-form-label">Process</label>
              <div class="col-sm-4">
                <select class="form-control" id="req">
                  <option value="">-- All --</option>
                  <?php
                  foreach ($status as $k => $v) {
                    if ($v['pid'] < 20 || $v['pid'] == 81 || $v['pid'] == 91) { ?>
                      <option value="<?= $v['pid'] ?>"><?= $v['pid_name'] ?></option>
                  <?php }
                  } ?>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-1 col-form-label">Date</label>
              <div class="col-sm-2">
                <input type="date" id="req_fr" class="req_dt datetimepicker form-control">
              </div>
              &ndash;
              <div class="col-sm-2">
                <input type="date" id="req_to" class="req_dt datetimepicker form-control">
              </div>
            </div>

            <div class="row">
              <div class="col-lg-12">
                <div class="table-responsive">
                  <table id="req_table" class="table table-striped"></table>
                </div>
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
            <h5 class="font-weight-semibold mb-0">Monitor Procurement</h5>
          </div>

          <div class="card-body">

            <div class="form-group row">
              <label class="col-sm-1 col-form-label">Process</label>
              <div class="col-sm-4">
                <select class="form-control" id="prc">
                  <option value="">-- All --</option>
                  <?php
                  foreach ($status as $k => $v) {
                    if (($v['pid'] > 20 && $v['pid'] < 30) || $v['pid'] == 82 || $v['pid'] == 92) { ?>
                      <option value="<?= $v['pid'] ?>"><?= $v['pid_name'] ?></option>
                  <?php }
                  } ?>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-1 col-form-label">Date</label>
              <div class="col-sm-2">
                <input type="date" id="prc_fr" class="prc_dt datetimepicker form-control">
              </div>
              &ndash;
              <div class="col-sm-2">
                <input type="date" id="prc_to" class="prc_dt datetimepicker form-control">
              </div>
            </div>

            <div class="row">
              <div class="col-lg-12">
                <div class="table-responsive">
                  <table id="prc_table" class="table table-striped"></table>
                </div>
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
            <h5 class="font-weight-semibold mb-0">Monitor Order</h5>
          </div>

          <div class="card-body">

            <div class="form-group row">
              <label class="col-sm-1 col-form-label">Process</label>
              <div class="col-sm-4">
                <select class="form-control" id="ord">
                  <option value="">-- All --</option>
                  <?php
                  foreach ($status as $k => $v) {
                    if (in_array($v['pid'], [31, 83, 93])) { ?>
                      <option value="<?= $v['pid'] ?>"><?= $v['pid_name'] ?></option>
                  <?php }
                  } ?>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-1 col-form-label">Date</label>
              <div class="col-sm-2">
                <input type="date" id="ord_fr" class="ord_dt datetimepicker form-control">
              </div>
              &ndash;
              <div class="col-sm-2">
                <input type="date" id="ord_to" class="ord_dt datetimepicker form-control">
              </div>
            </div>

            <div class="row">
              <div class="col-lg-12">
                <div class="table-responsive">
                  <table id="ord_table" class="table table-striped"></table>
                </div>
              </div>
            </div>
          </div>
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


    function operateFormatterReq(value, row, index) {
      let link = "<?php echo site_url('procurement/detail_req') ?>";
      return [
        '<a class="btn btn-outline-primary btn-xs action" href="' + link + '/' + value + '">',
        'View',
        '</a>  ',
      ].join('');
    }

    function operateFormatterPrc(value, row, index) {
      let link = "<?php echo site_url('procurement/detail_prc') ?>";
      return [
        '<a class="btn btn-outline-primary btn-xs action" href="' + link + '/' + value + '">',
        'View',
        '</a>  ',
      ].join('');
    }

    function operateFormatterOrd(value, row, index) {
      let link = "<?php echo site_url('procurement/detail_ord') ?>";
      return [
        '<a class="btn btn-outline-primary btn-xs action" href="' + link + '/' + value + '">',
        'View',
        '</a>  ',
      ].join('');
    }
  </script>

  <script type="text/javascript">
    var $req_table = $('#req_table')

    $(function() {

      $req_table.bootstrapTable({

        url: "<?php echo site_url('procurement/data_monitor_req') ?>",
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

        cookieIdTable: "req",

        idField: "req_number",
        columns: [{
            field: 'rn',
            title: '#',
            align: 'center',
            valign: 'middle',
            width: '20%',
            formatter: operateFormatterReq
          },
          {
            field: 'req_number',
            title: 'Number',
            sortable: true,
            order: true,
            searchable: true,
            align: 'center',
            valign: 'middle'
          },
          {
            field: 'proc_name',
            title: 'Name',
            sortable: true,
            order: true,
            searchable: true,
            align: 'center',
            valign: 'middle'
          },
          {
            field: 'user_name',
            title: 'Requester',
            sortable: true,
            order: true,
            searchable: true,
            align: 'center',
            valign: 'middle'
          },
          {
            field: 'div_name',
            title: 'Division',
            sortable: true,
            order: true,
            searchable: true,
            align: 'center',
            valign: 'middle'
          },
          {
            field: 'created_date',
            title: 'Date',
            sortable: true,
            order: true,
            searchable: true,
            align: 'center',
            valign: 'middle'
          },
          {
            field: 'pname',
            title: 'Process',
            sortable: true,
            order: true,
            searchable: true,
            align: 'center',
            valign: 'middle'
          },
        ]
      });

      setTimeout(function() {
        $req_table.bootstrapTable('resetView');
      }, 200);

    });


    $('#req, .req_dt').change(function() {

      let req_stat = $("#req").val();
      let req_fr = $("#req_fr").val();
      let req_to = $("#req_to").val();
      let req_dt = ""

      if (req_fr != "" && req_to != "") {
        req_dt = "&fr=" + req_fr + "&to=" + req_to
      }

      $req_table.bootstrapTable('refresh', {
        url: "<?php echo site_url('procurement/data_monitor_req') ?>?status=" + req_stat + req_dt
      })

    })
  </script>



  <script type="text/javascript">
    var $prc_table = $('#prc_table')

    $(function() {

      $prc_table.bootstrapTable({

        url: "<?php echo site_url('procurement/data_monitor_prc') ?>",
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

        cookieIdTable: "prc",

        idField: "prc_number",
        columns: [{
            field: 'pn',
            title: '#',
            align: 'center',
            valign: 'middle',
            width: '20%',
            formatter: operateFormatterPrc
          },
          {
            field: 'prc_number',
            title: 'Number',
            sortable: true,
            order: true,
            searchable: true,
            align: 'center',
            valign: 'middle'
          },
          {
            field: 'proc_name',
            title: 'Name',
            sortable: true,
            order: true,
            searchable: true,
            align: 'center',
            valign: 'middle'
          },
          {
            field: 'user_name',
            title: 'Requester',
            sortable: true,
            order: true,
            searchable: true,
            align: 'center',
            valign: 'middle'
          },
          {
            field: 'div_name',
            title: 'Division',
            sortable: true,
            order: true,
            searchable: true,
            align: 'center',
            valign: 'middle'
          },
          {
            field: 'created_date',
            title: 'Date',
            sortable: true,
            order: true,
            searchable: true,
            align: 'center',
            valign: 'middle'
          },
          {
            field: 'pname',
            title: 'Process',
            sortable: true,
            order: true,
            searchable: true,
            align: 'center',
            valign: 'middle'
          },
        ]
      });

      setTimeout(function() {
        $prc_table.bootstrapTable('resetView');
      }, 200);

    });


    $('#prc, .prc_dt').change(function() {

      let prc_stat = $("#prc").val();
      let prc_fr = $("#prc_fr").val();
      let prc_to = $("#prc_to").val();
      let prc_dt = ""

      if (prc_fr != "" && prc_to != "") {
        prc_dt = "&fr=" + prc_fr + "&to=" + prc_to
      }

      $prc_table.bootstrapTable('refresh', {
        url: "<?php echo site_url('procurement/data_monitor_prc') ?>?status=" + prc_stat + prc_dt
      })

    })
  </script>




  <script type="text/javascript">
    var $ord_table = $('#ord_table')

    $(function() {

      $ord_table.bootstrapTable({

        url: "<?php echo site_url('procurement/data_monitor_ord') ?>",
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

        cookieIdTable: "ord",

        idField: "ord_number",
        columns: [{
            field: 'on',
            title: '#',
            align: 'center',
            valign: 'middle',
            width: '20%',
            formatter: operateFormatterOrd
          },
          {
            field: 'ord_number',
            title: 'Number',
            sortable: true,
            order: true,
            searchable: true,
            align: 'center',
            valign: 'middle'
          },
          {
            field: 'proc_name',
            title: 'Name',
            sortable: true,
            order: true,
            searchable: true,
            align: 'center',
            valign: 'middle'
          },
          {
            field: 'user_name',
            title: 'Requester',
            sortable: true,
            order: true,
            searchable: true,
            align: 'center',
            valign: 'middle'
          },
          {
            field: 'div_name',
            title: 'Division',
            sortable: true,
            order: true,
            searchable: true,
            align: 'center',
            valign: 'middle'
          },
          {
            field: 'created_date',
            title: 'Date',
            sortable: true,
            order: true,
            searchable: true,
            align: 'center',
            valign: 'middle'
          },
          {
            field: 'pname',
            title: 'Process',
            sortable: true,
            order: true,
            searchable: true,
            align: 'center',
            valign: 'middle'
          },
        ]
      });

      setTimeout(function() {
        $ord_table.bootstrapTable('resetView');
      }, 200);

    });


    $('#ord, .ord_dt').change(function() {

      let ord_stat = $("#ord").val();
      let ord_fr = $("#ord_fr").val();
      let ord_to = $("#ord_to").val();
      let ord_dt = ""

      if (ord_fr != "" && ord_to != "") {
        ord_dt = "&fr=" + ord_fr + "&to=" + ord_to
      }

      $ord_table.bootstrapTable('refresh', {
        url: "<?php echo site_url('procurement/data_monitor_ord') ?>?status=" + ord_stat + ord_dt
      })

    })
  </script>