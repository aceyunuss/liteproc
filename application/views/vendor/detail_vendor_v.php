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

    <div class="card">
      <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
        <h5 class="font-weight-semibold mb-0"><?= $header['vendor_name']; ?></h5>
      </div>
      <div class="card-body">

        <div class="row">
          <div class="col-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

              <a class="nav-link active" data-toggle="pill" href="#tab-main" role="tab" aria-controls="tab-main" aria-selected="true">Main Data</a>

              <a class="nav-link" data-toggle="pill" href="#tab-legal" role="tab" aria-controls="tab-legal" aria-selected="false">Legal Data</a>

              <a class="nav-link" data-toggle="pill" href="#tab-board" role="tab" aria-controls="tab-board" aria-selected="false">Management Board</a>

              <a class="nav-link" data-toggle="pill" href="#tab-finance" role="tab" aria-controls="tab-finance" aria-selected="false">Finanace Data</a>

              <a class="nav-link" data-toggle="pill" href="#tab-com" role="tab" aria-controls="tab-com" aria-selected="false">Commodity</a>

              <a class="nav-link" data-toggle="pill" href="#tab-rsc" role="tab" aria-controls="tab-rsc" aria-selected="false">Human Resource</a>

              <a class="nav-link" data-toggle="pill" href="#tab-cert" role="tab" aria-controls="tab-cert" aria-selected="false">Certification</a>

              <a class="nav-link" data-toggle="pill" href="#tab-fct" role="tab" aria-controls="tab-fct" aria-selected="false">Facilities</a>

              <a class="nav-link" data-toggle="pill" href="#tab-project" role="tab" aria-controls="tab-project" aria-selected="false">Projects</a>

              <a class="nav-link" data-toggle="pill" href="#tab-add" role="tab" aria-controls="tab-add" aria-selected="false">Additional Data</a>

              <a class="nav-link" data-toggle="pill" href="#tab-doc" role="tab" aria-controls="tab-doc" aria-selected="false">Document</a>

            </div>
          </div>
          <div class="col-9">
            <div class="tab-content" id="v-pills-tabContent">

              <div class="tab-pane fade  blockquote show active" id="tab-main" role="tabpanel">
                <h5>Company Name</h5>
                <table class="table">
                  <tr>
                    <td>Prefix</td>
                    <td><?php echo $header['prefix']; ?></td>
                  </tr>
                  <tr>
                    <td>Otder Prefix</td>
                    <td><?php echo $header['prefix_other']; ?></td>
                  </tr>
                  <tr>
                    <td>Company Name</td>
                    <td><?php echo $header['vendor_name']; ?></td>
                  </tr>
                  <tr>
                    <td>Suffix</td>
                    <td><?php echo $header['suffix']; ?></td>
                  </tr>
                  <tr>
                    <td>Otder Suffix</td>
                    <td><?php echo $header['suffix_other']; ?></td>
                  </tr>
                  <tr>
                    <td>Company Type</td>
                    <td>
                      <ol>
                        <?php foreach ($tipe as $row) {
                          echo "<li>" . $row['company_type'] . "</li>" ?>
                        <?php } ?>
                      </ol>
                    </td>
                  </tr>
                  <tr>
                    <td>Registered Email</td>
                    <td><?php echo $header['email_address']; ?></td>
                  </tr>
                </table>
                <br>

                <h5>Company Contact</h5>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover dataTables-example">
                    <tdead>
                      <tr>
                        <td>No</td>
                        <td>Type</td>
                        <td>Address</td>
                        <td>City</td>
                        <td>Country</td>
                        <td>Company Phone-1</td>
                        <td>Company Phone-2</td>
                        <td>Fax</td>
                        <td>Website</td>
                      </tr>
                    </tdead>
                    <tbody>
                      <?php
                      $i = 1;
                      if (!empty($alamat)) {
                        foreach ($alamat as $row) { ?>
                          <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row["type"] ?></td>
                            <td><?php echo $row["address"] ?></td>
                            <td><?php echo $row["city"] ?></td>
                            <td><?php echo $row["country"] ?></td>
                            <td><?php echo $row["telephone1_no"] ?></td>
                            <td><?php echo $row["telephone2_no"] ?></td>
                            <td><?php echo $row["fax"] ?></td>
                            <td><?php echo $row["website"] ?></td>
                          </tr>
                      <?php
                          $i++;
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>

                <br>
                <h5>Contact Person</h5>
                <table class="table">
                  <tr>
                    <td>Name</td>
                    <td><?php echo $header['contact_name']; ?></td>
                  </tr>
                  <tr>
                    <td>Position</td>
                    <td><?php echo $header['contact_pos']; ?></td>
                  </tr>
                  <tr>
                    <td>Phone</td>
                    <td><?php echo $header['contact_phone_no']; ?></td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td><?php echo $header['contact_email']; ?></td>
                  </tr>
                </table>
              </div>

              <div class="tab-pane fade blockquote" id="tab-legal" role="tabpanel" aria-labelledby="tab-legal">
                <h5>Deed of Establishment</h5>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover dataTables-example">
                    <tdead>
                      <tr>
                        <td>Number</td>
                        <td>Type</td>
                        <td>Created Date</td>
                        <td>Notary</td>
                        <td>Address</td>
                        <td>Judicial Approval</td>
                        <td>Official Gazette</td>
                      </tr>
                    </tdead>
                    <tbody>
                      <?php
                      $i = 1;
                      if (!empty($akta)) {
                        foreach ($akta as $row) { ?>
                          <tr>
                            <td><?php echo $row["akta_no"] ?></td>
                            <td><?php echo $row["akta_type"] ?></td>
                            <td><?php echo !empty($row["date_creation"]) ? substr($row["date_creation"], 0, 10) : ""; ?></td>
                            <td><?php echo $row["notaris_name"] ?></td>
                            <td><?php echo $row["notaris_address"] ?></td>
                            <td><?php echo !empty($row["pengesahan_hakim"]) ? substr($row["pengesahan_hakim"], 0, 10) : ""; ?></td>
                            <td><?php echo !empty($row["berita_acara_ngr"]) ? substr($row["berita_acara_ngr"], 0, 10) : ""; ?></td>
                          </tr>
                      <?php
                          $i++;
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <br>

                <h5>Domicile</h5>
                <div class="table-responsive">
                  <table class="table">
                    <tr>
                      <td>Number</td>
                      <td><?php echo $header['address_domisili_no']; ?></td>
                    </tr>
                    <tr>
                      <td>Domicile Date</td>
                      <td>
                        <?php echo !empty($header['address_domisili_date']) ? substr($header['address_domisili_date'], 0, 10) : ""; ?></td>
                    </tr>
                    <tr>
                      <td>Expired</td>
                      <td><?php echo !empty($header['address_domisili_exp_date']) ? substr($header['address_domisili_exp_date'], 0, 10) : ""; ?></td>
                    </tr>
                    <tr>
                      <td>Address Street</td>
                      <td><?php echo $header['address_street']; ?></td>
                    </tr>
                    <tr>
                      <td>City</td>
                      <td><?php echo $header['address_city']; ?></td>
                    </tr>
                    <tr>
                      <td>Province</td>
                      <td><?php echo $header['addres_prop']; ?></td>
                    </tr>
                    <tr>
                      <td>Postal Code</td>
                      <td><?php echo $header['address_postcode']; ?></td>
                    </tr>
                    <tr>
                      <td>Country</td>
                      <td><?php echo $header['address_country']; ?></td>
                    </tr>
                    <tr>
                      <td>Phone Number</td>
                      <td><?php echo $header['address_phone_no']; ?></td>
                    </tr>
                  </table>
                </div>
                <br>

                <h5>Taxpayer Identification Number / NPWP</h5>
                <div class="table-responsive">
                  <table class="table">
                    <tr>
                      <td>Number</td>
                      <td><?php echo $header['npwp_no']; ?></td>
                    </tr>
                    <tr>
                      <td>Address (NPWP)</td>
                      <td><?php echo $header['npwp_address']; ?></td>
                    </tr>
                    <tr>
                      <td>City</td>
                      <td><?php echo $header['npwp_city']; ?></td>
                    </tr>
                    <tr>
                      <td>Province</td>
                      <td><?php echo $header['npwp_prop']; ?></td>
                    </tr>
                    <tr>
                      <td>Postal Code</td>
                      <td><?php echo $header['npwp_postcode']; ?></td>
                    </tr>
                    <tr>
                      <td>VAT enterprise(s)</td>
                      <td><?php echo $header['npwp_pkp']; ?></td>
                    </tr>
                    <tr>
                      <td>VAT enterprise(s) Number</td>
                      <td><?php echo $header['npwp_pkp_no']; ?></td>
                    </tr>
                  </table>
                </div>
                <br>

                <h5>Vendor Type</h5>
                <div style="padding: 15px;">
                  <table class="table">
                    <tr>
                      <td>Vendor</td>
                      <td><?php echo $header['vendor_type']; ?></td>
                    </tr>
                  </table>
                </div>
                <br>

                <h5>Commercial Business Lisence / SIUP
                </h5>
                <table class="table">
                  <tr>
                    <td>Issued By</td>
                    <td><?php echo $header['siup_issued_by']; ?></td>
                  </tr>
                  <tr>
                    <td>Number</td>
                    <td><?php echo $header['siup_no']; ?></td>
                  </tr>
                  <tr>
                    <td>Type</td>
                    <td><?php echo $header['siup_type']; ?></td>
                  </tr>
                  <tr>
                    <td>Valid From</td>
                    <td><?php echo !empty($header['siup_from']) ? substr($header['siup_from'], 0, 10) : "" ?></td>
                  </tr>
                  <tr>
                    <td>Valid Until</td>
                    <td><?php echo !empty($header['siup_to']) ? substr($header['siup_to'], 0, 10) : "" ?></td>
                  </tr>
                </table>
                <br>

                <h5>Others</h5>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover dataTables-example">
                    <tdead>
                      <tr>
                        <td>No</td>
                        <td>Type</td>
                        <td>Issued By</td>
                        <td>Number</td>
                        <td>Valid From</td>
                        <td>Valid Unil</td>
                      </tr>
                    </tdead>
                    <tbody>
                      <?php
                      $i = 1;
                      if (!empty($izin_lain)) {
                        foreach ($izin_lain as $row) { ?>
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row["type"] ?></td>
                            <td><?php echo $row["issued_by"] ?></td>
                            <td><?php echo $row["no"] ?></td>
                            <td><?php echo !empty($row['start_date']) ? substr($row['start_date'], 0, 10) : "" ?></td>
                            <td><?php echo !empty($row['start_date']) ? substr($row['end_date'], 0, 10) : "" ?></td>
                          </tr>
                      <?php
                          $i++;
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <br>

                <h5>Company Registration / TDP</h5>
                <table class="table">

                  <tr>
                    <td>Issued By</td>
                    <td><?php echo $header['tdp_issued_by']; ?></td>
                  </tr>
                  <tr>
                    <td>Number</td>
                    <td><?php echo $header['tdp_no']; ?></td>
                  </tr>
                  <tr>
                    <td>Valid From</td>
                    <td><?php echo !empty($header['tdp_from']) ? substr($header['tdp_from'], 0, 10) : "" ?></td>
                  </tr>
                  <tr>
                    <td>Valid Until</td>
                    <td><?php echo !empty($header['tdp_to']) ? substr($header['tdp_to'], 0, 10) : "" ?></td>
                  </tr>
                </table>
                <br>

                <h5>Distributorship</h5>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover dataTables-example">
                    <tdead>
                      <tr>
                        <td>No</td>
                        <td>Issued By</td>
                        <td>Number</td>
                        <td>Valid From</td>
                        <td>Valid Until</td>
                      </tr>
                    </tdead>
                    <tbody>
                      <?php
                      $i = 1;
                      if (!empty($agent_importir)) {
                        foreach ($agent_importir as $row) {
                          if ($row["type"] == "AGENT") { ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $row["issued_by"] ?></td>
                              <td><?php echo $row["no"] ?></td>
                              <td><?php echo date("d-m-Y", $row["created_date"] / 1000) ?></td>
                              <td><?php echo date("d-m-Y", $row["expired_date"] / 1000) ?></td>
                            </tr>
                      <?php
                            $i++;
                          }
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <br>

                <h5>Importir</h5>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover dataTables-example">
                    <tdead>
                      <tr>
                        <td>No</td>
                        <td>Issued By</td>
                        <td>Number</td>
                        <td>Valid From</td>
                        <td>Valid Until</td>
                      </tr>
                    </tdead>
                    <tbody>
                      <?php
                      $i = 1;
                      if (!empty($agent_importir)) {
                        foreach ($agent_importir as $row) {
                          if ($row["type"] == "IMPORTIR") { ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $row["issued_by"] ?></td>
                              <td><?php echo $row["no"] ?></td>
                              <td><?php echo date("d-m-Y", $row["created_date"] / 1000) ?></td>
                              <td><?php echo date("d-m-Y", $row["expired_date"] / 1000) ?></td>
                            </tr>
                      <?php
                            $i++;
                          }
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="tab-pane fade blockquote" id="tab-board" role="tabpanel" aria-labelledby="tab-board">
                <h5>Management Board</h5>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover dataTables-example">
                    <tdead>
                      <tr>
                        <td>No</td>
                        <td>Name</td>
                        <td>Position</td>
                        <td>Phone</td>
                        <td>Email</td>
                        <td>ID</td>
                        <td>ID Attachment</td>
                        <td>NPWP</td>
                      </tr>
                    </tdead>
                    <tbody>
                      <?php
                      $i = 1;
                      if (!empty($board)) {
                        foreach ($board as $row) {
                          $ktp = !empty($row["board_personal_att"]) ? explode("/", $row["board_personal_att"]) : [];
                          $ktp_att = !empty($ktp) ? $ktp[3] : "";
                      ?>
                          <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row["name"] ?></td>
                            <td><?php echo $row["pos"]; ?></td>
                            <td><?php echo $row["telephone_no"] ?></td>
                            <td><?php echo $row["email_address"] ?></td>
                            <td><?php echo $row["ktp"] ?></td>
                            <td><a target="_blank" href="<?php echo $url_doc . '/' . $ktp_att; ?>"><?php echo $ktp_att ?></a> </td>
                            <td><?php echo $row["npwp_no"] ?></td>
                          </tr>
                      <?php
                          $i++;
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="tab-pane fade blockquote" id="tab-finance" role="tabpanel" aria-labelledby="tab-finance">
                <h5>Bank Account</h5>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover dataTables-example">
                    <tdead>
                      <tr>
                        <td>No</td>
                        <td>Account Number</td>
                        <td>Acoount Holder</td>
                        <td>Bank Name</td>
                        <td>Bank Branch</td>
                        <td>Address</td>
                        <td>Currency</td>
                      </tr>
                    </tdead>
                    <tbody>
                      <?php
                      $i = 1;
                      if (!empty($bank)) {
                        foreach ($bank as $row) { ?>
                          <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row["account_no"] ?></td>
                            <td><?php echo $row["account_name"]; ?></td>
                            <td><?php echo $row["bank_name"] ?></td>
                            <td><?php echo $row["bank_branch"] ?></td>
                            <td><?php echo $row["address"] ?></td>
                            <td><?php echo $row["currency"] ?></td>
                          </tr>
                      <?php
                          $i++;
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <br>

                <h5>Capital</h5>
                <table class="table">
                  <tr>
                    <td>Initial Capital</td>
                    <td><?php echo ($header['fin_akta_mdl_dsr_curr']); ?> <?php echo number_format($header['fin_akta_mdl_dsr'], 2, ",", "."); ?></td>
                  </tr>
                  <tr>
                    <td>Paid Capital</td>
                    <td><?php echo ($header['fin_akta_mdl_str_curr']); ?> <?php echo number_format($header['fin_akta_mdl_str'], 2, ",", "."); ?></td>
                  </tr>
                </table>
                <br>

                <h5>Clasification</h5>
                <table class="table">
                  <tr>
                    <td>Company Clasification</td>
                    <td><?php if ($header['fin_class'] == "3") {
                          echo "BIG";
                        } else if ($header['fin_class'] == "2") {
                          echo "MEDIUM";
                        } else if ($header['fin_class'] == "1") {
                          echo "SMALL";
                        } ?></td>
                  </tr>
                </table>
              </div>

              <div class="tab-pane fade blockquote" id="tab-com" role="tabpanel" aria-labelledby="tab-com">
                <h5>Commodities</h5>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover dataTables-example">
                    <tdead>
                      <tr>
                        <td>No</td>
                        <td>Code</td>
                        <td>Name</td>
                        <td>Brand</td>
                        <td>Reference</td>
                        <td>Type</td>
                      </tr>
                    </tdead>
                    <tbody>
                      <?php
                      $i = 1;
                      if (!empty($barang)) {
                        foreach ($barang as $row) { ?>
                          <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row["product_code"]; ?></td>
                            <td><?php echo $row["product_description"]; ?></td>
                            <td><?php echo $row["brand"] ?></td>
                            <td><?php echo $row["source"] ?></td>
                            <td><?php echo $row["catalog_type"] ?></td>
                          </tr>
                      <?php
                          $i++;
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="tab-pane fade blockquote" id="tab-rsc" role="tabpanel" aria-labelledby="tab-rsc">
                <h5>
                  Human Resource
                </h5>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover dataTables-example">
                    <tdead>
                      <tr>
                        <td>No</td>
                        <td>Name</td>
                        <td>Last Education</td>
                        <td>Experience</td>
                        <td>Status</td>
                        <td>Nationality</td>
                      </tr>
                    </tdead>
                    <tbody>
                      <?php
                      $i = 1;
                      if (!empty($sdm)) {
                        foreach ($sdm as $row) { ?>
                          <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row["name"]; ?></td>
                            <td><?php echo $row["last_education"] ?></td>
                            <td><?php echo $row["year_exp"] ?></td>
                            <td><?php echo $row["emp_status"] ?></td>
                            <td><?php echo $row["emp_type"] ?></td>
                          </tr>
                      <?php
                          $i++;
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="tab-pane fade blockquote" id="tab-cert" role="tabpanel" aria-labelledby="tab-cert">
                <h5>
                  Certification
                </h5>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover dataTables-example">
                    <tdead>
                      <tr>
                        <td>No</td>
                        <td>Type</td>
                        <td>Name</td>
                        <td>Number</td>
                        <td>Issued By</td>
                        <td>Valid From</td>
                        <td>Valid Until</td>
                      </tr>
                    </tdead>
                    <tbody>
                      <?php
                      $i = 1;
                      if (!empty($sertifikasi)) {
                        foreach ($sertifikasi as $row) { ?>
                          <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row["type"]; ?></td>
                            <td><?php echo $row["cert_name"] ?></td>
                            <td><?php echo $row["cert_no"] ?></td>
                            <td><?php echo $row["issued_by"] ?></td>
                            <td><?php echo !empty($row['valid_from']) ? substr($row['valid_from'], 0, 10) : "" ?></td>
                            <td><?php echo !empty($row['valid_to']) ? substr($row['valid_to'], 0, 10) : "" ?></td>
                          </tr>
                      <?php
                          $i++;
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="tab-pane fade blockquote" id="tab-fct" role="tabpanel" aria-labelledby="tab-fct">
                <h5>Facilities</h5>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover dataTables-example">
                    <tdead>
                      <tr>
                        <td>No</td>
                        <td>Category</td>
                        <td>Name</td>
                        <td>Specification</td>
                        <td>Quantity</td>
                        <td>Created</td>
                      </tr>
                    </tdead>
                    <tbody>
                      <?php
                      $i = 1;
                      if (!empty($fasilitas)) {
                        foreach ($fasilitas as $row) { ?>
                          <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row["category"]; ?></td>
                            <td><?php echo $row["equip_name"] ?></td>
                            <td><?php echo $row["spec"] ?></td>
                            <td><?php echo $row["quantity"] ?></td>
                            <td><?php echo $row["year_made"] ?></td>
                          </tr>
                      <?php
                          $i++;
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="tab-pane fade blockquote" id="tab-project" role="tabpanel" aria-labelledby="tab-project">
                <h5>Projects</h5>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover dataTables-example">
                    <tdead>
                      <tr>
                        <td>No</td>
                        <td>Client </td>
                        <td>Project Name</td>
                        <td>Project Description</td>
                        <td>Value</td>
                        <td>Contract Number</td>
                        <td>Start Date</td>
                        <td>End Date</td>
                        <td>Contact Person</td>
                        <td>Contact Phone</td>
                      </tr>
                    </tdead>
                    <tbody>
                      <?php
                      $i = 1;
                      if (!empty($pengalaman)) {
                        foreach ($pengalaman as $row) { ?>
                          <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row["client_name"]; ?></td>
                            <td><?php echo $row["project_name"] ?></td>
                            <td><?php echo $row["description"] ?></td>
                            <td><?php echo ($row["currency"]) ?> <?php echo number_format($row["amount"], 2, ",", "."); ?></td>
                            <td><?php echo $row["contract_no"] ?></td>
                            <td><?php echo !empty($row["start_date"]) ? substr($row["start_date"], 0, 10) : "" ?></td>
                            <td><?php echo !empty($row["end_date"]) ? substr($row["end_date"], 0, 10) : "" ?></td>
                            <td><?php echo $row["contact_person"] ?></td>
                            <td><?php echo $row["contact_no"] ?></td>
                          </tr>
                      <?php
                          $i++;
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="tab-pane fade blockquote" id="tab-add" role="tabpanel" aria-labelledby="tab-add">
                <h5>Additional</h5>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover dataTables-example">
                    <tdead>
                      <tr>
                        <td>No</td>
                        <td>Name</td>
                        <td>Address</td>
                        <td>City</td>
                        <td>Country</td>
                        <td>Postal Code</td>
                        <td>Qualification</td>
                        <td>Relationship</td>
                      </tr>
                    </tdead>
                    <tbody>
                      <?php
                      $i = 1;
                      if (!empty($tambahan)) {
                        foreach ($tambahan as $row) { ?>
                          <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row["name"]; ?></td>
                            <td><?php echo $row["address"] ?></td>
                            <td><?php echo $row["city"] ?></td>
                            <td><?php echo $row["country"] ?></td>
                            <td><?php echo $row["post_code"] ?></td>
                            <td><?php echo $row["qualification"] ?></td>
                            <td><?php echo $row["relationship"] ?></td>
                          </tr>
                      <?php
                          $i++;
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="tab-pane fade blockquote" id="tab-doc" role="tabpanel" aria-labelledby="tab-doc">
                <h5>Document</h5>

                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover dataTables-example">
                    <tdead>
                      <tr>
                        <td>No</td>
                        <td>Name</td>
                        <td>File</td>
                      </tr>
                    </tdead>
                    <tbody>
                      <?php
                      $i = 1;
                      if (!empty($dokumen)) {
                        foreach ($dokumen as $row) { ?>
                          <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row["vnd_suppdoc_desc"]; ?></td>
                            <td><a href="<?php echo $url_doc . "/" . $row["vnd_suppdoc_filename"] ?>" target="_blank"><?php echo $row["vnd_suppdoc_filename"] ?></a></td>
                          </tr>
                      <?php
                          $i++;
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>

            </div>
          </div>
        </div>
        <center>
          <a class="btn btn-outline-success btn-sm" href="<?= site_url('commodity') ?>">Back</a>
        </center>
      </div>
    </div>
  </div>

  <style>
    td {
      word-wrap: break-word;
    }
  </style>