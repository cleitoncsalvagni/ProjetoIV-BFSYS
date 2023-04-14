<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url("public/img/apple-touch-icon.png") ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url("public/img/favicon-32x32.png") ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url("public/img/favicon-16x16.png") ?>">

  <?php echo (isset($pageTitle) ? '<title>BFSYS | ' . $pageTitle . '</title>' : '<title>BFSYS</title>') ?>

  <link href="<?php echo base_url("public/vendor/fontawesome-free/css/all.min.css") ?>" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link href="<?php echo base_url("public/css/sb-admin-2.min.css"); ?>" rel="stylesheet">

  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.js.map"></script>

  <script>
    toastr.options = {
      closeButton: true,
      debug: false,
      newestOnTop: false,
      progressBar: true,
      positionClass: 'toast-top-right',
      preventDuplicates: true,
      onclick: null,
      showDuration: 300,
      hideDuration: 1000,
      timeOut: 3000,
      extendedTimeOut: 1000,
      showEasing: 'swing',
      hideEasing: 'linear',
      showMethod: 'fadeIn',
      hideMethod: 'fadeOut',
    }
  </script>


  <?php if (isset($styles)) : ?>

    <?php foreach ($styles as $style) : ?>

      <link href="<?php echo base_url("public/" . $style); ?>" rel="stylesheet">

    <?php endforeach; ?>

  <?php endif; ?>

</head>

<body id="page-top">

  <div id="wrapper">