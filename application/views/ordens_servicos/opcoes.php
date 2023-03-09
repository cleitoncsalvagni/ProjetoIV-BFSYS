<?php $this->load->view("layout/sidebar"); ?>
<div id="content">
    <?php $this->load->view("layout/navbar") ?>
    <div class="container-fluid">


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('os') ?>">Ordens de serviço</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $pageTitle ?></li>
            </ol>
        </nav>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class='row text-center'>
                    <div class='col-md-4'>
                        <a href="<?php echo base_url('os/pdf') ?>" class="btn btn-dark btn-icon-split btn-md">
                            <span class="icon text-white-50">
                                <i class="fas fa-print"></i>
                            </span>
                            <span class="text">Imprimir ordem de serviço</span>
                        </a>
                    </div>
                    <div class='col-md-4'>
                        <a href="<?php echo base_url('os/novo') ?>" class="btn btn-success btn-icon-split btn-md">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Cadastrar ordem de serviço</span>
                        </a>
                    </div>
                    <div class='col-md-4'>
                        <a href="<?php echo base_url('os') ?>" class="btn btn-info btn-icon-split btn-md">
                            <span class="icon text-white-50">
                                <i class="fas fa-file-invoice-dollar"></i>
                            </span>
                            <span class="text">Listar ordens de serviço</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php

        if ($message = $this->session->flashdata('error')) {
            echo "<script>
            toastr.error('" . $message . "');
        </script>";
        }

        if ($message = $this->session->flashdata('success')) {
            echo "<script>
            toastr.success('" . $message . "');
        </script>";
        }

        ?>

    </div>
</div>