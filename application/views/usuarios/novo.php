<?php $this->load->view("layout/sidebar"); ?>
<div id="content">
    <?php $this->load->view("layout/navbar") ?>
    <div class="container-fluid">


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('usuarios') ?>">Usuários</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
            </ol>
        </nav>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href='<?php echo base_url('usuarios') ?>' title='Voltar' class='btn btn-outline-dark btn-sm col-md-2'><i class="fas fa-arrow-left"></i>&nbsp; Retornar</a>
            </div>
            <div class="card-body">
                <form method="POST" name="form_novo">

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="first_name" placeholder="Informe o nome" value="<?php echo set_value('first_name') ?>">
                            <?php echo form_error('first_name', '<small class="form-text text-danger">', '</small>') ?>

                        </div>

                        <div class="col-md-4">
                            <label>Sobrenome</label>
                            <input type="text" class="form-control" name="last_name" placeholder="Informe o sobrenome" value="<?php echo set_value('last_name') ?>">
                            <?php echo form_error('last_name', '<small class="form-text text-danger">', '</small>') ?>
                        </div>

                        <div class="col-md-4">
                            <label>E-mail</label>
                            <input type="text" class="form-control" name="email" placeholder="Informe o email" value="<?php echo set_value('email') ?>">
                            <?php echo form_error('email', '<small class="form-text text-danger">', '</small>') ?>
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-md-4">
                            <label>Usuário</label>
                            <input type="text" class="form-control" name="username" placeholder="Informe o usuário" value="<?php echo set_value('username') ?>">
                            <?php echo form_error('username', '<small class="form-text text-danger">', '</small>') ?>
                        </div>

                        <div class="col-md-4">
                            <label>Ativo</label>
                            <select class="form-control" name="active">
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>Perfil de acesso</label>
                            <select class="form-control" name="perfil_usuario">
                                <option value="2">Vendedor</option>
                                <option value="1">Administrador</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Senha</label>
                            <input type="password" class="form-control" name="password" placeholder="Informe a senha">
                            <?php echo form_error('password', '<small class="form-text text-danger">', '</small>') ?>
                        </div>
                        <div class="col-md-6">
                            <label>Confirmação de senha</label>
                            <input type="password" class="form-control" name="confirm_password" placeholder="Informe novamente a senha">
                            <?php echo form_error('confirm_password', '<small class="form-text text-danger">', '</small>') ?>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-success btn-sm col-md-12 mt-3">Salvar</button>

                </form>
            </div>
        </div>
    </div>
</div>