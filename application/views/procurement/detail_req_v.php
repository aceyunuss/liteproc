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
    foreach ($cid_content as $val) {
      include('req/view_' . $val['cid_file'] . ".php");
    }
    include(APPPATH . "/views/procurement/view_comment_v.php");
    ?>

    <div class="card">
      <div class="card-body">
        <center>
          <button style="font-size: 16px;" onclick="history.back()" class="btn btn-secondary btn-sm">&nbsp;&nbsp;Back&nbsp;&nbsp;</button>
        </center>
      </div>
    </div>

  </div>


  <script>
    $(document).ready(function() {

      $('.act').click(function() {
        if (typeof er_msg === "undefined") {
          let stat = $(this).data("stat");
          $('#status').val(stat)
        } else {
          if (er_msg != "") {
            e.preventDefault();
            alert(er_msg)
          }
        }
      })
    })
  </script>