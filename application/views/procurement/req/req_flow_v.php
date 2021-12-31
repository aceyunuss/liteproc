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
    <form class="forms-sample req_form" method="POST" enctype="multipart/form-data" action="<?= site_url('procurement/submit_req') ?>">

      <input type="hidden" name="pid" value="<?= $pid ?>">
      <input type="hidden" name="hist_id" value="<?= $hist_id ?>">

      <?php
      foreach ($cid_content as $val) {
        include($val['cid_type'] . '_' . $val['cid_file'] . ".php");
      }
      include(APPPATH . "/views/procurement/comment_v.php");
      ?>

      <div class="card">
        <div class="card-body">
          <center>
            <input type="hidden" name="status" value="" id="status">
            <button style="font-size: 16px;" type="submit" onclick="history.back()" class="btn btn-secondary btn-sm  act" data-stat="n">&nbsp;&nbsp;Back&nbsp;&nbsp;</button>
            <button style="font-size: 16px;" type="submit" class="btn btn-danger btn-sm  act" data-stat="r">Reject</button>
            <button style="font-size: 16px;" type="submit" class="btn btn-success  btn-sm act" data-stat="y">Submit</button>
          </center>
        </div>
      </div>

    </form>
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