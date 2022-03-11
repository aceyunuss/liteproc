<div class="main-panel">
  <div class="content-wrapper">
    <div class="row page-title-header">
      <div class="col-12">
        <div class="page-header">
          <h4 class="page-title"><?= $pg_title ?></h4>
        </div>
      </div>
    </div>

    <!-- <div class="row">
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
    </div> -->

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
            <h4 class="font-weight-semibold mb-0">To-do List</h4>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="table-responsive">
                  <table id="todo_table" class="table table-striped"></table>
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
      var link = "<?php echo site_url('procurement') ?>";
      var typ = row.category
      return [
        '<a class="btn btn-outline-primary btn-xs action" href="' + link + '/' + typ + '/' + value + '">',
        'Process',
        '</a>  ',
      ].join('');
    }
  </script>

  <script type="text/javascript">
    var $todo_table = $('#todo_table')

    $(function() {

      $todo_table.bootstrapTable({

        url: "<?php echo site_url('procurement/get_todo') ?>",
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

        idField: "hist_id",
        columns: [{
            field: 'hist_id',
            title: '#',
            align: 'center',
            valign: 'middle',
            width: '20%',
            formatter: operateFormatter
          },
          {
            field: 'number',
            title: 'Number',
            sortable: true,
            order: true,
            searchable: true,
            align: 'center',
            valign: 'middle'
          },
          {
            field: 'name',
            title: 'Name',
            sortable: true,
            order: true,
            searchable: true,
            align: 'left',
            valign: 'middle'
          },
          {
            field: 'role',
            title: 'Current Role',
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
            field: 'pid_name',
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
        $todo_table.bootstrapTable('resetView');
      }, 200);

      $todo_table.on('expand-row.bs.table', function(e, index, row, $detail) {
        $detail.html(detailFormatter(index, row, "alias_vendor"));
      });


      $todo_table.on('expand-row.bs.table', function(e, index, row, $detail) {
        $detail.html(detailFormatter(index, row));

      });
      $todo_table.on('all.bs.table', function(e, name, args) {
        //console.log(name, args);
      });

      function getIdSelections() {
        return $.map($todo_table.bootstrapTable('getSelections'), function(row) {
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