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
        <h4 class="card-title mb-0">Data Evaluation Template</h4>
      </div>
      <div class="card-body">
        <a class="btn btn-success btn-md" href="<?= site_url('procurement/add_eval') ?> "><i class="fa fa-plus"></i>Add Template<a>
            <div class="table-responsive">
              <table id="eval_table" class="table table-bordered table-striped"></table>
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

      return [
        '<a class="btn btn-outline-primary btn-xs action" href="' + link + '/edit_eval/' + value + '">',
        'Edit',
      ].join('');
    }
  </script>

  <script type="text/javascript">
    var $eval_table = $('#eval_table')

    $(function() {

      $eval_table.bootstrapTable({

        url: "<?php echo site_url('procurement/get_data_eval') ?>",
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

        idField: "eval_id",
        columns: [{
            field: 'eval_id',
            title: 'Action',
            align: 'center',
            valign: 'middle',
            width: '20%',
            formatter: operateFormatter
          },
          {
            field: 'eval_name',
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
        $eval_table.bootstrapTable('resetView');
      }, 200);

      $eval_table.on('expand-row.bs.table', function(e, index, row, $detail) {
        $detail.html(detailFormatter(index, row, "alias_vendor"));
      });


      $eval_table.on('expand-row.bs.table', function(e, index, row, $detail) {
        $detail.html(detailFormatter(index, row));

      });
      $eval_table.on('all.bs.table', function(e, name, args) {
        //console.log(name, args);
      });

      function getIdSelections() {
        return $.map($eval_table.bootstrapTable('getSelections'), function(row) {
          return row.eval_id
        });
      }

      function responseHandler(res) {
        $.each(res.rows, function(i, row) {
          row.state = $.inArray(row.eval_id, selections) !== -1;
        });
        return res;
      }



    });
  </script>