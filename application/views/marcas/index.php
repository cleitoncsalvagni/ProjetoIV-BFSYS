<?php $this->load->view("layout/sidebar"); ?>
<div id="content">
    <?php $this->load->view("layout/navbar") ?>
    <div class="container-fluid">


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Início</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
            </ol>
        </nav>

        <?php if ($message = $this->session->flashdata('error')) : ?>

            <div class='row'>
                <div class='col-md-12'>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle"></i>&nbsp; <?php echo $message; ?>
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
                <a href='<?php echo base_url('marcas/novo') ?>' title='Cadastrar nova marca' class='btn btn-success rounded-pill btn-sm float-right'><i class="fas fa-plus"></i>&nbsp; Nova marca</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th class='text-center'>Ativa</th>
                                <th class='text-center no-sort'>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($marcas as $marca) : ?>

                                <tr>
                                    <!-- <td><?php echo $marca->marca_id ?></td> -->
                                    <td><?php echo $marca->marca_nome ?></td>
                                    <td class='text-center pr-4'><?php echo ($marca->marca_ativa ? '<span class="badge badge-info btn-sm">Sim</span>' : '<span class="badge badge-danger btn-sm">Não</span>') ?></td>
                                    <td class='text-center'>
                                        <a title="Editar" href="<?php echo base_url('marcas/edit/' . $marca->marca_id) ?>" class="btn btn-outline-primary rounded btn-sm"><i class="fas fa-user-edit"></i></a>
                                        <a title="Excluir" href="javascript(void)" data-toggle="modal" data-target="#user-<?php echo $marca->marca_id ?>" class="btn btn-outline-danger rounded btn-sm"><i class="fas fa-user-times"></i></i></a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="user-<?php echo $marca->marca_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Deletar marca</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Deseja mesmo <strong>deletar</strong> a marca? Esta ação não pode ser desfeita!</div>
                                            <div class="modal-footer">
                                                <button class="btn btn-primary btn-sm" type="button" data-dismiss="modal">Cancelar</button>
                                                <a class="btn btn-danger btn-sm" href="<?php echo base_url('marcas/del/' . $marca->marca_id) ?>">Deletar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>