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

    <form class="forms-sample" id="eval_form" method="POST" action="<?= site_url('procurement/submit_add_eval') ?>">

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
                  <input type="text" maxlength="255" class="form-control" name="name" required>
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
                  <input type="text" maxlength="255" class="form-control" id="det_name">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Criteria</label>
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
                  <input type="number" min="1" max="100" maxlength="255" class="form-control" id="det_weight">
                </div>
              </div>

              <center>
                <a class="btn btn-inverse-success add">Add</a>
              </center>

              <br>
              <center>
                <div class="table-responsive">
                  <table class="table table-striped item_table">
                    <thead>
                      <tr>
                        <th style="text-align:center; width: 10%;"> # </th>
                        <th style="text-align:center; width: 50%"> Criteria </th>
                        <th style="text-align:center; width: 20%"> Type </th>
                        <th style="text-align:center; width: 20%;"> Weight (%) </th>
                      </tr>
                    </thead>
                    <tbody>
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


  <script>
    $(document).ready(function() {

      $('.add').click(function() {
        let counter = $('.item_table tr').length + 1;
        let name = $('#det_name').val()
        let weight = $('#det_weight').val()
        let type = $('#det_type').val()

        if (name == "" || weight == "" || type == "") {
          alert('Please fill form item')

        } else if (weight > 100) {

          alert("Max value is 100")

        } else {

          tbody = '<tr>\
                    <td><center><i class="remove fa fa-trash-o"></i></center></td>\
                    <td>' + name + '</td>\
                    <input type="hidden" value="' + name + '" name="cr_name[]">\
                    <td>' + type + '</td>\
                    <input type="hidden" value="' + type + '" name="cr_type[]">\
                    <td><center>' + weight + '</center></td>\
                    <input class="wg" type="hidden" value="' + weight + '" name="cr_weight[]">\
                  </tr>';

          $('.item_table tbody').append(tbody)
          $('#det_name, #det_weight, #det_type').val('')

        }
      })
    })


    $(document).on('click', '.remove', function() {
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
  </script>