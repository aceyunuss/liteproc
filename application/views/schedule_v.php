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
    <!-- Page Title Header Ends-->
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <center>
              <div class="dropdown-header text-center">
                <h3 class="mb-1 mt-3 font-weight-semibold">
                  <span class="tooltip-r" data-toggle="tooltip" data-placement="left" title="Site Title">
                    <?= $settings['title'] ?> <a type="button" data-toggle="modal" data-target="#mod-sitetitle"><i class="fa fa-pencil-square-o"></i></a>
                  </span>
                </h3>
                <p>
                <h4 class="font-weight-semibold text-muted mb-0">
                  <span class="tooltip-r" data-toggle="tooltip" data-placement="left" title="Site Name">
                    <?= $settings['name'] ?> <a type="button" data-toggle="modal" data-target="#mod-label"><i class="fa fa-pencil-square-o"></i></a>
                  </span>
                </h4>

              </div>
            </center>
          </div>
        </div>
      </div>
    </div>


    <div class="card">
      <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
        <h4 class="card-title mb-0">Schedule list</h4>
      </div>
      <div class="card-body">

        <div class="row">

          <?php foreach ((array)$bg as $val) { ?>

            <div class="col-md-4 d-flex align-items-center">
              <div>
                <img style="max-width: 300px; max-height: 200px;" src="<?= base_url('uploads/background/') . $val['filename'] ?>" alt="Background">
                <center style="padding-top: 5px;">
                  <input type="checkbox" <?= $val['is_active'] == 1 ? "checked" : "" ?> class="opt" name="opt" value="<?= $val['bg_id'] ?>" style="margin-bottom: 25px;" />
                  <button type="button" class="btn btn-inverse-danger btn-xs del-bg" data-bg="<?= $val['bg_id'] ?>">Delete</button>
                </center>
              </div>
            </div>
          <?php } ?>

        </div>
        <br>
        <center>
          <button type="button" class="btn btn-primary activate" data-status="1"> Activate</button>
          <button type="button" class="btn btn-warning activate" data-status="0"> Deactivate</button>
        </center>
      </div>
    </div>
  </div>


  <div class="modal fade" id="mod-bg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Background</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Image Upload</label>
            <div class="col-sm-9">
              <div class="input-group col-xs-12">
                <input type="file" class="form-control file-upload-info file-background" name="file-background" placeholder="Upload Image">
                <span class="input-group-append">
                  <button class="file-upload-browse btn btn-info" type="button">Upload</button>
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success go-post" data-for="background">Save</button>
        </div>
      </div>
    </div>
  </div>


  <style>
    .img-cont {
      position: relative;
    }

    .modal-backdrop {
      opacity: 0.15 !important;
    }

    /* Make the image responsive */
    .img-cont img {
      max-height: 100px;
      height: auto;
      border-radius: 5%;
    }

    /* Style the button and place it in the middle of the img-cont/image */
    .img-cont .img-btn {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      background-color: #19d895;
      color: white;
      font-size: 11px;
      padding: 7px 15px;
      border: none;
      cursor: pointer;
      border-radius: 5px;
      opacity: 0;
    }

    .img-cont .img-btn:hover {
      background-color: #19d895;
      opacity: 0.9;
    }
  </style>



  <script>
    $(document).ready(function() {


    });
  </script>