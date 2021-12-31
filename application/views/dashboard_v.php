<div class="main-panel">
  <div class="content-wrapper">
    <div class="row page-title-header">
      <div class="col-12">
        <div class="page-header">
          <h4 class="page-title"><?= $pg_title ?></h4>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-3 col-md-6">
                <div class="d-flex">
                  <div class="wrapper">
                    <h3 class="mb-0 font-weight-semibold">32,451</h3>
                    <h5 class="mb-0 font-weight-medium text-primary">Visits</h5>
                    <p class="mb-0 text-muted">+14.00(+0.50%)</p>
                  </div>
                  <div class="wrapper my-auto ml-auto ml-lg-4">
                    <canvas height="50" width="100" id="stats-line-graph-1"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                <div class="d-flex">
                  <div class="wrapper">
                    <h3 class="mb-0 font-weight-semibold">15,236</h3>
                    <h5 class="mb-0 font-weight-medium text-primary">Impressions</h5>
                    <p class="mb-0 text-muted">+138.97(+0.54%)</p>
                  </div>
                  <div class="wrapper my-auto ml-auto ml-lg-4">
                    <canvas height="50" width="100" id="stats-line-graph-2"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                <div class="d-flex">
                  <div class="wrapper">
                    <h3 class="mb-0 font-weight-semibold">7,688</h3>
                    <h5 class="mb-0 font-weight-medium text-primary">Conversation</h5>
                    <p class="mb-0 text-muted">+57.62(+0.76%)</p>
                  </div>
                  <div class="wrapper my-auto ml-auto ml-lg-4">
                    <canvas height="50" width="100" id="stats-line-graph-3"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                <div class="d-flex">
                  <div class="wrapper">
                    <h3 class="mb-0 font-weight-semibold">1,553</h3>
                    <h5 class="mb-0 font-weight-medium text-primary">Downloads</h5>
                    <p class="mb-0 text-muted">+138.97(+0.54%)</p>
                  </div>
                  <div class="wrapper my-auto ml-auto ml-lg-4">
                    <canvas height="50" width="100" id="stats-line-graph-4"></canvas>
                  </div>
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
          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="table-responsive">
                  <table id="div_table" class="table table-strikped"></table>
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