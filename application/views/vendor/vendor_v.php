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
        <h5 class="font-weight-semibold mb-0">Data Vendor</h5>
      </div>
      <div class="card-body">
        <a class="btn btn-success btn-md" href="<?= site_url('vendor/sync') ?> "><i class="fa fa-exchange"></i> Sinkron Pengadaan.com<a>
            <div class="table-responsive">
              <table id="vnd_table" class="table table-bordered table-striped"></table>
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
      var link = "<?php echo site_url('vendor') ?>";

      return [
        '<a class="btn btn-outline-info btn-xs action" href="' + link + '/detail/' + value + '">',
        'Detail',
        '</a>',
      ].join('');
    }
  </script>

  <script type="text/javascript">
    var $vnd_table = $('#vnd_table')

    $(function() {

      $vnd_table.bootstrapTable({

        url: "<?php echo site_url('vendor/get_data_vendor') ?>",
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

        idField: "vendor_id",
        columns: [{
            field: 'vendor_id',
            title: 'Action',
            align: 'center',
            valign: 'middle',
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
            field: 'email_address',
            title: 'Email',
            sortable: true,
            order: true,
            searchable: true,
            align: 'left',
            valign: 'middle'
          },
          {
            field: 'address_street',
            title: 'Address',
            sortable: true,
            order: true,
            searchable: true,
            align: 'left',
            valign: 'middle'
          },
          {
            field: 'last_sync',
            title: 'Last Sync',
            sortable: true,
            order: true,
            searchable: true,
            align: 'left',
            valign: 'middle'
          },
        ]
      });

      setTimeout(function() {
        $vnd_table.bootstrapTable('resetView');
      }, 200);

      $vnd_table.on('expand-row.bs.table', function(e, index, row, $detail) {
        $detail.html(detailFormatter(index, row, "alias_vendor"));
      });


      $vnd_table.on('expand-row.bs.table', function(e, index, row, $detail) {
        $detail.html(detailFormatter(index, row));

      });
      $vnd_table.on('all.bs.table', function(e, name, args) {
        //console.log(name, args);
      });

      function getIdSelections() {
        return $.map($vnd_table.bootstrapTable('getSelections'), function(row) {
          return row.com_code
        });
      }

      function responseHandler(res) {
        $.each(res.rows, function(i, row) {
          row.state = $.inArray(row.com_code, selections) !== -1;
        });
        return res;
      }



    });
  </script>