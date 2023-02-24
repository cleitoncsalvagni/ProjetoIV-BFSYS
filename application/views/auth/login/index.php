<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5" style="margin-top: 10rem !important">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image1"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                </div>
                                <form class="user" name="form_index" method="POST" action="<?php echo base_url('login/auth') ?>">
                                    <div class="form-group">
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
        ?>
    </div>
</div>