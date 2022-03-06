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

    <form class="forms-sample" id="eval_form" method="POST" action="<?= site_url('procurement/submit_edit_eval') ?>">

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
              <h5 class="font-weight-semibold mb-0">Header</h5>
            </div>
            <div class="card-body">

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-6">
                  <input type="hidden" value="<?= $eval['eval_id'] ?>" name="eval_id">
                  <input type="text" maxlength="255" value="<?= $eval['eval_name'] ?>" class="form-control" name="name" required>
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
              <h5 class="font-weight-semibold mb-0">Criteria</h5>
            </div>
            <div class="card-body">

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Criteria</label>
                <div class="col-sm-6">
                  <input type="text" maxlength="255" class="form-control" id="det_name" value="">
                  <input type="hidden" id="ecid" value="">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Type</label>
                <div class="col-sm-3">
                  <select class="form-control" id="det_type">
                    <option value="">-- Select --</option>
                    <option value="Benefit">Benefit</option>
                    <option value="Cost">Cost</option>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Weight (%)</label>
                <div class="col-sm-1">
                  <input type="number" min="1" max="100" maxlength="255" class="form-control" id="det_weight" value="">
                </div>
              </div>

              <center>
                <a class="btn btn-inverse-success add">Add</a>
              </center>
              <br>
              <hr>
              <br>
              <center>
                <div class="table-responsive">
                  <table class="table table-striped item_table">
                    <thead>
                      <tr>
                        <th style="text-align:center; width: 20%;"> # </th>
                        <th style="text-align:center; width: 50%"> Criteria </th>
                        <th style="text-align:center; width: 15%"> Type </th>
                        <th style="text-align:center; width: 15%;"> Weight (%) </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ((array)$crit as $k => $v) { ?>
                        <tr data-row='<?= $k + 1 ?>'>
                          <td>
                            <center>
                              <i class="edit fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;
                              <i class="remove fa fa-trash-o"></i>&nbsp;&nbsp;&nbsp;
                              <i data-toggle="modal" data-target="#modal_max" data-ec="<?= $v['ec_id'] ?>" class="sub fa fa-bars"></i>
                            </center>
                            <input class="ec_id_<?= $k + 1 ?>" type="hidden" value="<?= $v['ec_id'] ?>" name="ec_id[]">
                          </td>
                          <td><?= $v['ec_name'] ?></td>
                          <input class="ec_name_<?= $k + 1 ?>" type="hidden" value="<?= $v['ec_name'] ?>" name="cr_name[]">
                          <td><?= $v['ec_type'] ?></td>
                          <input class="ec_type_<?= $k + 1 ?>" type="hidden" value="<?= $v['ec_type'] ?>" name="cr_type[]">
                          <td>
                            <center><?= $v['ec_weight'] ?></center>
                          </td>
                          <input class="ec_weight_<?= $k + 1 ?> wg" type="hidden" value="<?= $v['ec_weight'] ?>" name="cr_weight[]">
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </center>

            </div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <center>
            <a class="btn btn-inverse-warning btn-sm" href="<?= site_url('procurement/eval_template') ?>">Cancel</a>
            <button type="submit" class="btn btn-success btn-sm">Submit</button>
          </center>
        </div>
      </div>

    </form>

  </div>




  <div class="modal fade" id="modal_max" tabindex="-1" role="dialog" aria-labelledby="modal_maxLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog  modal-dialog-centered modal-lg" class="overflow-y: initial !important" role="document" style="width:60%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="modal_maxLabel"></h4>
          </button>
        </div>
        <div class="modal-body" style="overflow-y: auto;">
          <form id="formsc">

            <input type="hidden" name="ecc" id="ecc" value="">

            <br>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Sub Criteria</label>
              <div class="col-sm-8">
                <input type="text" maxlength="255" class="form-control" id="sname" value="">
                <input type="hidden" id="ecid" value="">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Score</label>
              <div class="col-sm-2">
                <input type="number" min="1" max="100" maxlength="255" class="form-control" id="sscore" value="">
              </div>
            </div>
            <center>
              <a class="btn btn-inverse-success ads">Add</a>
            </center>
            <br>
            <hr>
            <br>
            <center>
              <div class="table-responsive">
                <table class="table table-striped stable">
                  <thead>
                    <tr>
                      <th style="text-align:center; width: 20%;"> # </th>
                      <th style="text-align:center; width: 60%"> Sub Criteria </th>
                      <th style="text-align:center; width: 20%"> Score </th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <br><br>
              <button type="button" class="btn btn-inverse-warning btn-sm" id="tutup-btn" data-dismiss="modal">Cancel</button>
              <button class="scr btn btn-success btn-sm">Submit</button>
            </center>
          </form>
        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>


  <script>
    $(document).ready(function() {

      $('.add').click(function() {
        let name = $('#det_name').val()
        let weight = $('#det_weight').val()
        let type = $('#det_type').val()
        let i = $('.item_table tr').length + 1;

        if (name == "" || weight == "" || type == "") {
          alert('Please fill form item')

        } else if (weight > 100) {

          alert("Max value is 100")

        } else {

          tbody = '<tr data-row=' + i + '>\
                    <td><center>\
                      <i class="edit fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;\
                      <i class="remove fa fa-trash-o"></i>&nbsp;&nbsp;&nbsp;\
                      <i class="fa"></i>&nbsp;&nbsp;&nbsp;\
                    <center></td>\
                    <input class="ec_' + i + '" type="hidden" value="" name="ec_id[]">\
                    <td>' + name + '</td>\
                    <input class="ec_name_' + i + '" type="hidden" value="' + name + '" name="cr_name[]">\
                    <td>' + type + '</td>\
                    <input class="ec_type_' + i + '" type="hidden" value="' + type + '" name="cr_type[]">\
                    <td><center>' + weight + '</center></td>\
                    <input class="ec_weight_' + i + ' wg" type="hidden" value="' + weight + '" name="cr_weight[]">\
                  </tr>';

          $('.item_table tbody').append(tbody)
          $('#det_name, #det_weight, #det_type').val('')

        }
      })



      $('.ads').click(function() {
        let name = $('#sname').val()
        let score = $('#sscore').val()
        let i = $('.stable tr').length + 1;

        if (name == "" || score == "") {
          alert('Please fill form item')

        } else if (score > 100) {

          alert("Max score is 100")

        } else {

          ext = checkRowVal(score)

          if (ext) {
            alert("Can't add same score");

          } else {

            tbody = '<tr class="rowsc" data-row=' + i + '>\
                      <td><center>\
                        <i class="ed fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;\
                        <i class="del fa fa-trash-o"></i>&nbsp;&nbsp;&nbsp;\
                      <center></td>\
                      <input class="sid' + i + '" type="hidden" value="" name="sid[]">\
                      <td>' + name + '</td>\
                      <input class="sname_' + i + '" type="hidden" value="' + name + '" name="sname[]">\
                      <td class="sc text-center">' + score + '</td>\
                      <input class="sscore_' + i + '" type="hidden" value="' + score + '" name="sscore[]">\
                    </tr>';

            $('.stable tbody').append(tbody)
            $('#sname, #sscore').val('')

          }
        }
      })
    })


    function checkRowVal(tv) {

      let ret = false

      $('.stable tr').each(function(a, b) {
        let value = $('.sc', b).text();
        console.log(value)

        if (value == tv) {
          ret = true
        }
      });

      return ret
    }


    $(document).on('click', '.remove, .del', function() {
      if (confirm("Are you sure delete this item?")) {
        $(this).parent().parent().parent().remove();
      }
    })


    $("#eval_form").submit(function(e) {

      if ($('.item_table tr').length == 1) {
        alert("Item can't be empty")
        e.preventDefault();
      }

      percent = 0;
      $('.wg').each(function(i, obj) {
        wg = parseInt($(this).val())
        percent += wg;
      });

      if (percent != 100) {
        alert("Total criteria weight must be 100");
        e.preventDefault();
      }

    })


    $(document).on('click', '.edit', function() {

      rowid = $(this).parent().parent().parent().data('row');
      ecid = $('.ec_id_' + rowid).val();
      ecname = $('.ec_name_' + rowid).val();
      ectype = $('.ec_type_' + rowid).val();
      ecweight = $('.ec_weight_' + rowid).val();

      $('#det_name').val(ecname)
      $('#det_weight').val(ecweight)
      $('#det_type').val(ectype).trigger('change')
      $('#ecid').val(ecid)

      $(this).parent().parent().parent().remove();
    })



    $(document).on('click', '.ed', function() {

      rowid = $(this).parent().parent().parent().data('row');
      sid = $('.sid_' + rowid).val();
      sname = $('.sname_' + rowid).val();
      sscore = $('.sscore_' + rowid).val();

      $('#sname').val(sname)
      $('#sscore').val(sscore)
      $('#sid').val(sid)

      $(this).parent().parent().parent().remove();
    })



    $(document).on('click', '.sub', function() {

      let ec = $(this).data("ec")
      $('#ecc').val(ec)
      let de = ""
      $('.stable tbody').html("")

      $.get({
        url: "<?= site_url('procurement/load_score/')  ?>" + ec,
        type: "GET",
        success: function(data) {
          de = JSON.parse(data)

          $.each(de, function(index, value) {
            i = index + 1
            tbody = '<tr class="rowsc" data-row=' + i + '>\
                      <td><center>\
                        <i class="ed fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;\
                        <i class="del fa fa-trash-o"></i>&nbsp;&nbsp;&nbsp;\
                      <center></td>\
                      <input class="sid' + i + '" type="hidden" value="' + value.eci_id + '" name="sid[]">\
                      <td>' + value.eci_name + '</td>\
                      <input class="sname_' + i + '" type="hidden" value="' + value.eci_name + '" name="sname[]">\
                      <td class="sc text-center">' + value.eci_val + '</td>\
                      <input class="sscore_' + i + '" type="hidden" value="' + value.eci_val + '" name="sscore[]">\
                    </tr>';

            $('.stable tbody').append(tbody)
            $('#sname, #sscore').val('')
          })

        }
      })

    })

    $(document).on('click', '.wink', function() {
      $('.rfq').toggle("slide", 200); //y elemenya ada di result data ajax
    })

    $('#modal_max').on('hidden.bs.modal', function(e) {
      $('#modal_max').modal('hide');
      $('#view_response').empty();
    })


    $('.scr').click(function(e) {
      e.preventDefault()
      $.ajax({
        url: '<?= site_url('procurement/submit_eval_score') ?>',
        type: "POST",
        data: $("#formsc").serialize(),
        cache: false,
        asynce: false,
        success: (function(data) {
          de = JSON.parse(data)
          if (de.status == "success") {
            alert("Success")
            location.reload();
          } else {
            alert("Failed")
          }
        })
      });
    })
  </script>