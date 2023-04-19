<div class="container">
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5" style="margin-top: 5rem !important">
                <div class="card-body p-0">
                    <div class="row">
                        <!-- <img src="<?php echo base_url("/public/img/bfsys_logo.png") ?>" class="col-lg-6 d-none d-lg-block img-fluid rounded" alt="..."> -->
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h2 class="h4 text-gray-900">Entrar</h2>
                                    <h7 class="h7 text-gray-500">Onde a eficiência encontra a praticidade!</h7>
                                </div>
                                <form class="user" name="form_index" method="POST" action="<?php echo base_url('login/auth') ?>">
                                    <div class="form-group mt-5">
                                        <input type="email" class="form-control form-control-user" name="email" placeholder="Insira seu email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password" placeholder="Insira sua senha">
                                    </div>
                                    <button type='submit' class="btn btn-primary btn-user btn-block">
                                        Entrar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if ($message = $this->session->flashdata('error')) {
            echo "<script>toastr.error('" . $message . "');</script>";
        }
        if ($message = $this->session->flashdata('info')) {
            echo "<script>toastr.info('" . $message . "');</script>";
        }
        ?>
    </div>
</div>