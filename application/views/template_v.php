<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>LiteProc</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/assets/vendors/iconfonts/ionicons/dist/css/ionicons.css">
  <link rel="stylesheet" href="<?= base_url() ?>/assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?= base_url() ?>/assets/vendors/css/vendor.bundle.addons.css">
  <link rel="stylesheet" href="<?= base_url() ?>/assets/vendors/iconfonts/font-awesome/css/font-awesome.min.css" />
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/css/shared/style.css">
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/css/demo_1/style.css">
  <!-- End Layout styles -->
  <link rel="shortcut icon" href="<?= base_url() ?>/images/favicon.ico" />
  <script src="<?= base_url() ?>/assets/js/jquery.min.js"></script>

  <link rel="stylesheet" href="<?= base_url() ?>/assets/js/sweetalert/dist/sweetalert2.min.css">


  <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.css">

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.js"></script>
  <!-- <script src="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.js"></script>
  <script src="https://unpkg.com/bootstrap-table@1.19.1/dist/locale/bootstrap-table-zh-US.min.js"></script> -->

</head>

<?php include("components/header_v.php") ?>

<?php include("components/menu_v.php") ?>

<?php include($content . ".php") ?>

<?php include("components/footer_v.php"); ?>

<script src="<?= base_url() ?>/assets/vendors/js/vendor.bundle.base.js"></script>
<script src="<?= base_url() ?>/assets/vendors/js/vendor.bundle.addons.js"></script>
<script src="<?= base_url() ?>/assets/js/core.js"></script>
<script src="<?= base_url() ?>/assets/js/sweetalert/dist/sweetalert2.all.min.js"></script>
<!-- endinject -->
<!-- inject:js -->
<script src="<?= base_url() ?>/assets/js/shared/off-canvas.js"></script>
<script src="<?= base_url() ?>/assets/js/shared/misc.js"></script>

<script src="<?= base_url() ?>/assets/js/shared/jquery.cookie.js" type="text/javascript"></script>