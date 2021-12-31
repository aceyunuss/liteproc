<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
        <h4 class="card-title mb-0">Item</h4>
      </div>
      <div class="card-body">

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Item Name</label>
          <div class="col-sm-6">
            <input type="text" maxlength="255" class="form-control" id="item_name">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Quantity</label>
          <div class="col-sm-2">
            <input type="number" min="1" maxlength="255" class="form-control" id="item_qty">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Type</label>
          <div class="col-sm-2">
            <select class="form-control form-control type" id="item_type">
              <option value=""> -- Select -- </option>
              <option value="Goods">Goods</option>
              <option value="Service">Service</option>
            </select>
          </div>
        </div>

        <center>
          <a class="btn btn-inverse-success add">Add Item</a>
        </center>

        <br>
        <center>
          <div class="table-responsive">
            <table class="table table-striped item_table">
              <thead>
                <tr>
                  <th style="text-align:center; width: 10%;"> # </th>
                  <th style="text-align:center"> Item Name </th>
                  <th style="text-align:center; width: 20%;"> Quantity </th>
                  <th style="text-align:center; width: 20%;"> Type </th>
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
<script>
  $(document).ready(function() {

    $('.add').click(function() {
      let counter = $('.item_table tr').length + 1;
      let name = $('#item_name').val()
      let qty = $('#item_qty').val()
      let typ = $('#item_type').val()

      if (name == "" || qty == "" || typ == "") {
        alert('Please fill form item')
      } else {

        tbody = '<tr>\
                  <td><center><i class="remove fa fa-trash-o"></i></center></td>\
                  <td>' + name + '</td>\
                  <input type="hidden" value="' + name + '" name="itm_name[]">\
                  <td>' + qty + '</td>\
                  <input type="hidden" value="' + qty + '" name="itm_qty[]">\
                  <td><center>' + typ + '</center></td>\
                  <input type="hidden" value="' + typ + '" name="itm_typ[]">\
                </tr>';

        $('.item_table tbody').append(tbody)
        $('#item_name, #item_qty, #item_type').val('')
      }
    })
  })


  $(document).on('click', '.remove', function() {
    if (confirm("Are you sure delete this item?")) {
      $(this).parent().parent().parent().remove();
    }
  })


  $(".req_form").submit(function(e) {
    if ($('.item_table tr').length == 1) {
      alert("Item can't be empty")
      e.preventDefault();
    }
  })
</script>