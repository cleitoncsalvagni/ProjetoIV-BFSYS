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
            <div class="card-body">
                <form method="POST" name="form_edit">

                    <fieldset class='mt-4 border p-3 mb-3'>
                        <legend class='small'><i class="fas fa-user-shield"></i>&nbsp; Dados Pessoais</legend>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label>Nome <strong class='text-danger'>*</strong></label>
                                <input type="text" class="form-control" name="first_name" placeholder="Informe o nome" value="<?php echo $usuario->first_name; ?>">
                                <?php echo form_error('first_name', '<small class="form-text text-danger">', '</small>') ?>

                            </div>

                            <div class="col-md-4">
                                <label>Sobrenome <strong class='text-danger'>*</strong></label>
                                <input type="text" class="form-control" name="last_name" placeholder="Informe o sobrenome" value="<?php echo $usuario->last_name; ?>">
                                <?php echo form_error('last_name', '<small class="form-text text-danger">', '</small>') ?>
                            </div>


                            <div class="col-md-4">
                                <label>Usuário <strong class='text-danger'>*</strong></label>
                                <input type="text" class="form-control" name="username" placeholder="Informe o usuário" value="<?php echo $usuario->username; ?>">
                                <?php echo form_error('username', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label>Perfil de acesso</label>
                                <select class="form-control" name="perfil_usuario">
                                    <option value="2" <?php echo ($perfil_usuario->id == 2) ? 'selected' : '' ?>>Vendedor</option>
                                    <option value="1" <?php echo ($perfil_usuario->id == 1) ? 'selected' : '' ?>>Administrador</option>
                                </select>
                            </div>
                        </div>

                    </fieldset>

                    <fieldset class='mt-4 border p-3 mb-3'>
                        <legend class='small'><i class="fas fa-user-shield"></i>&nbsp; Acesso</legend>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label>E-mail <strong class='text-danger'>*</strong></label>
                                <input type="text" class="form-control" name="email" placeholder="Informe o email" value="<?php echo $usuario->email; ?>">
                                <?php echo form_error('email', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                            <div class="col-md-4">
                                <label>Senha <strong class='text-danger'>*</strong></label>
                                <input type="password" class="form-control" name="password" placeholder="Informe a senha">
                                <?php echo form_error('password', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                            <div class="col-md-4">
                                <label>Confirmação de senha <strong class='text-danger'>*</strong></label>
                                <input type="password" class="form-control" name="confirm_password" placeholder="Informe novamente a senha">
                                <?php echo form_error('confirm_password', '<small class="form-text text-danger">', '</small>') ?>
                            </div>


                        </div>
                    </fieldset>

                    <fieldset class='mt-4 border p-3 mb-3'>
                        <legend class='small'><i class="fas fa-cogs"></i>&nbsp; Preferências</legend>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label>Ativo</label>
                                <select class="form-control" name="active">
                                    <option value="0" <?php echo ($usuario->active == 0) ? 'selected' : '' ?>>Não</option>
                                    <option value="1" <?php echo ($usuario->active == 1) ? 'selected' : '' ?>>Sim</option>
                                </select>
                            </div>

                            <input type="hidden" name="usuario_id" value="<?php echo $usuario->id; ?>">
                        </div>
                    </fieldset>


                    <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                    <a href='<?php echo base_url('usuarios') ?>' title='Voltar' class='btn btn-primary btn-sm ml-2'>Voltar</a>

                </form>
            </div>
        </div>
    </div>
</div>