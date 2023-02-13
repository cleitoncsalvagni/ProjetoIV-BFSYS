<?php $this->load->view("layout/sidebar"); ?>
<div id="content">
    <?php $this->load->view("layout/navbar") ?>
    <div class="container-fluid">


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
            </ol>
        </nav>

        <?php if ($message = $this->session->flashdata('error')) : ?>

            <div class='row'>
                <div class='col-md-12'>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="far fa-exclamation-triangle"></i>&nbsp; <?php echo $message; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>

        <?php endif; ?>

        <?php if ($message = $this->session->flashdata('sucesso')) : ?>

            <div class='row'>
                <div class='col-md-12'>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="far fa-smile-wink"></i>&nbsp; <?php echo $message; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>

        <?php endif; ?>


        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href='' title='Cadastrar novo usuário' class='btn btn-success btn-sm float-right'><i class="fas fa-user-plus"></i>&nbsp; Novo</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Usuário</th>
                                <th>Login</th>
                                <th>Ativo</th>
                                <th class='text-right no-sort'>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $user) : ?>

                                <tr>
                                    <td><?php echo $user->id ?></td>
                                    <td><?php echo $user->username ?></td>
                                    <td><?php echo $user->email ?></td>
                                    <td><?php echo $user->active ?></td>
                                    <td class='text-right'>
                                        <a title="Editar" href="<?php echo base_url('usuarios/edit/' . $user->id) ?>" class="btn btn-primary btn-sm"><i class="fas fa-user-edit"></i></a>
                                        <a title="Excluir" href="" class="btn btn-danger btn-sm"><i class="fas fa-user-times"></i></i></a>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>