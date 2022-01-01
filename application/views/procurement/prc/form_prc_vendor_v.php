<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
        <h4 class="card-title mb-0">Vendor</h4>
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
  var $daftar_vendor = $('#daftar_vendor')

  $(function() {

    $daftar_vendor.bootstrapTable({

      url: "<?php echo site_url('procurement/get_vendor/' . str_replace("/", ".", $prc_head['prc_number'])) ?>",
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
          field: 'checkbox',
          checkbox: true,
          align: 'center',
          valign: 'middle'
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
</script>