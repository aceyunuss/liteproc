<div class="main-panel">
  <div class="content-wrapper">
    <!-- Page Title Header Starts-->
    <div class="row page-title-header">
      <div class="col-12">
        <div class="page-header">
          <h4 class="page-title">Settings</h4>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
        <h4 class="card-title mb-0">Background</h4>
      </div>
      <div class="card-body">
        <a class="btn btn-success btn-md" href="<?= site_url('commodity/add') ?> "><i class="fa fa-plus"></i>Add Commodity<a>
        <div class="table-responsive">
          <table id="daftar_vendor" class="table table-bordered table-striped"></table>
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

    function detailFormatter(index, row, url) {

      var mydata = $.getCustomJSON("<?php echo site_url('Procurement') ?>/" + url);

      var html = [];
      $.each(row, function(key, value) {
        var data = $.grep(mydata, function(e) {
          return e.field == key;
        });

        if (typeof data[0] !== 'undefined') {

          html.push('<p><b>' + data[0].alias + ':</b> ' + value + '</p>');
        }
      });

      return html.join('');

    }
  </script>

  <script type="text/javascript">
    var $daftar_vendor = $('#daftar_vendor'),
      selections = [];
  </script>

  <script type="text/javascript">
    $(function() {

      $("input[name='vendor_district']").change(function() {

        var val = $(this).val();
        $.ajax({
          url: "<?php echo site_url('procurement/set_session/selection_district') ?>/" + val,
          success: function() {
            $daftar_vendor.bootstrapTable('refresh');
          }
        })

      });

      $daftar_vendor.bootstrapTable({

        url: "<?php echo site_url('Procurement/data_vendor_tender') ?>",
        selectItemName: "vendor_tender[]",
        striped: true,
        sidePagination: 'server',
        cookie: true,
        cookieExpire: '1h',
        showFilter: true,
        flat: true,
        pagination: true,
        search: true,
        clickToSelect: true,
        cookieIdTable: "vendor_tender",

        idField: "vendor_id",
        columns: [{
            field: 'checkbox',
            checkbox: true,
            align: 'center',
            valign: 'middle'
          },
          {
            field: 'vendor_name',
            title: 'Nama Vendor',
            sortable: true,
            order: true,
            searchable: true,
            align: 'left',
            valign: 'middle'
          },
          {
            field: 'fin_class',
            title: 'Klasifikasi Vendor',
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
          url: "<?php echo site_url('Procurement/selection/selection_vendor_tender') ?>",
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
          url: "<?php echo site_url('Procurement/selection/selection_vendor_tender') ?>",
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


    // $('form').submit(function(e) {
    //   var responact = $("select[name='status_inp[0]'] option:selected").text();
    //   if ($('#daftar_vendor input[type=checkbox]:checked').length == 0 && $('#metode_pengadaan_inp').val() != 2 && responact != "Simpan Sebagai Draft") {
    //     e.preventDefault();
    //     alert('Tidak Ada Vendor Yang Diundang');
    //   }
    // })
  </script>