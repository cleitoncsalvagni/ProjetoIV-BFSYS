<?php $this->load->view("layout/sidebar"); ?>
<div id="content">
  <?php $this->load->view("layout/navbar") ?>
  <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Home</h1>
  </div>
  <?php

  if ($message = $this->session->flashdata('welcome')) {
    echo "<script>toastr.info('" . $message . "');</script>";
  }

  if ($message = $this->session->flashdata('success')) {
    echo "<script>toastr.success('" . $message . "');</script>";
  }
  if ($message = $this->session->flashdata('error')) {
    echo "<script>toastr.error('" . $message . "');</script>";
  }

  ?>
</div>