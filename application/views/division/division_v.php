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

    <div class="card">
      <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
        <h5 class="font-weight-semibold mb-0">Data Division</h5>
      </div>
      <div class="card-body">
        <a class="btn btn-success btn-md" href="<?= site_url('division/add') ?> "><i class="fa fa-plus"></i>Add Division<a>
            <div class="table-responsive">
              <table id="div_table" class="table table-bordered table-striped"></table>
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
      var link = "<?php echo site_url('division') ?>";

      if (row.status == "Active") {
        cls = "danger"
        act = "Deactivate"
      } else {
        cls = "success"
        act = "Activate"
      }

      return [
        '<a class="btn btn-outline-primary btn-xs action" href="' + link + '/edit/' + value + '">',
        'Edit',
        '</a>  ',
        '<a onclick="return confirm(\'Are you sure?\')"  class="btn btn-outline-' + cls + ' btn-xs action" href="' + link + '/ch_status/' + value + '">',
        act,
        '</a>  ',
      ].join('');
    }
  </script>

  <script type="text/javascript">
    var $div_table = $('#div_table')

    $(function() {

      $div_table.bootstrapTable({

        url: "<?php echo site_url('division/get_data_division') ?>",
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

        idField: "div_id",
        columns: [{
            field: 'div_id',
            title: 'Action',
            align: 'center',
            valign: 'middle',
            width: '20%',
            formatter: operateFormatter
          },
          {
            field: 'div_code',
            title: 'Code',
            sortable: true,
            order: true,
            searchable: true,
            align: 'center',
            valign: 'middle'
          },
          {
            field: 'div_name',
            title: 'Name',
            sortable: true,
            order: true,
            searchable: true,
            align: 'left',
            valign: 'middle'
          },
          {
            field: 'updated_date',
            title: 'Updated Date',
            sortable: true,
            order: true,
            searchable: true,
            align: 'center',
            valign: 'middle'
          },
        ]
      });

      setTimeout(function() {
        $div_table.bootstrapTable('resetView');
      }, 200);

      $div_table.on('expand-row.bs.table', function(e, index, row, $detail) {
        $detail.html(detailFormatter(index, row, "alias_vendor"));
      });


      $div_table.on('expand-row.bs.table', function(e, index, row, $detail) {
        $detail.html(detailFormatter(index, row));

      });
      $div_table.on('all.bs.table', function(e, name, args) {
        //console.log(name, args);
      });

      function getIdSelections() {
        return $.map($div_table.bootstrapTable('getSelections'), function(row) {
          return row.div_id
        });
      }

      function responseHandler(res) {
        $.each(res.rows, function(i, row) {
          row.state = $.inArray(row.div_id, selections) !== -1;
        });
        return res;
      }



    });
  </script>