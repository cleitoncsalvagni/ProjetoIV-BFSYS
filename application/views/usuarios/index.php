<?php $this->load->view("layout/sidebar"); ?>
<div id="content">
    <?php $this->load->view("layout/navbar") ?>
    <div class="container-fluid">


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Início</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $pageTitle ?></li>
            </ol>
        </nav>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href='<?php echo base_url('usuarios/novo') ?>' title='Cadastrar novo usuário' class='btn btn-success rounded btn-sm '><i class="fas fa-user-plus"></i>&nbsp; Novo usuário</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <!-- <th>ID</th> -->
                                <th>Usuário</th>
                                <th>Login</th>
                                <th>Perfil</th>
                                <th class='text-center'>Ativo</th>
                                <th class='text-center no-sort'>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $user) : ?>

                                <tr>
                                    <!-- <td><?php echo $user->id ?></td> -->
                                    <td><?php echo $user->username ?></td>
                                    <td><?php echo $user->email ?></td>
                                    <td><?php echo ($this->ion_auth->is_admin($user->id) ? 'Administrador' : 'Vendedor') ?></td>
                                    <td class='text-center pr-4'><?php echo ($user->active ? '<span class="badge badge-success btn-sm">Sim</span>' : '<span class="badge badge-danger btn-sm">Não</span>') ?></td>
                                    <td class='text-center'>
                                        <a title="Editar" href="<?php echo base_url('usuarios/edit/' . $user->id) ?>" class="btn btn-outline-primary rounded btn-sm"><i class="fas fa-pen"></i></a>
                                        <a title="Excluir" href="javascript(void)" data-toggle="modal" data-target="#user-<?php echo $user->id ?>" class="btn btn-outline-danger rounded btn-sm"><i class="fas fa-trash"></i></i></a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="user-<?php echo $user->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Deletar Usuário</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Deseja mesmo <strong>deletar</strong> o usuário? Esta ação não pode ser desfeita!</div>
                                            <div class="modal-footer">
                                                <button class="btn btn-primary btn-sm" type="button" data-dismiss="modal">Cancelar</button>
                                                <a class="btn btn-danger btn-sm" href="<?php echo base_url('usuarios/del/' . $user->id) ?>">Deletar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
            if ($message = $this->session->flashdata('error')) {
                echo "<script>toastr.error('" . $message . "');</script>";
            }

            if ($message = $this->session->flashdata('success')) {
                echo "<script>toastr.success('" . $message . "');</script>";
            }
            ?>
        </div>
    </div>
</div>