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
                <a href='<?php echo base_url('usuarios') ?>' title='Voltar' class='btn btn-primary btn-sm float-right'><i class="fas fa-arrow-left"></i>&nbsp; Voltar</a>
            </div>
            <div class="card-body">
                <form method="POST" name="form_edit">

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="first_name" placeholder="Informe o nome" value="<?php echo $usuario->first_name; ?>">
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>

                        <div class="col-md-4">
                            <label>Sobrenome</label>
                            <input type="text" class="form-control" name="last_name" placeholder="Informe o sobrenome" value="<?php echo $usuario->last_name; ?>">
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>

                        <div class="col-md-4">
                            <label>E-mail</label>
                            <input type="text" class="form-control" name="email" placeholder="Informe o email" value="<?php echo $usuario->email; ?>">
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-md-4">
                            <label>Usuário</label>
                            <input type="text" class="form-control" name="username" placeholder="Informe o usuário" value="<?php echo $usuario->username; ?>">
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>

                        <div class="col-md-4">
                            <label>Ativo</label>
                            <select class="form-control" name="active">
                                <option value="0" <?php echo ($usuario->active == 0) ? 'selected' : '' ?>>Não</option>
                                <option value="1" <?php echo ($usuario->active == 1) ? 'selected' : '' ?>>Sim</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>Perfil de acesso</label>
                            <select class="form-control" name="perfil_usuario">
                                <option value="2" <?php echo ($perfil_usuario->id == 2) ? 'selected' : '' ?>>Vendedor</option>
                                <option value="1" <?php echo ($perfil_usuario->id == 1) ? 'selected' : '' ?>>Administrador</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Senha</label>
                            <input type="password" class="form-control" name="password" placeholder="Informe a senha">
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        <div class="col-md-6">
                            <label>Confirmação de senha</label>
                            <input type="password" class="form-control" name="confirm_password" placeholder="Informe novamente a senha">
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>

                        <input type="hidden" name="usuario_id" value="<?php echo $usuario->id; ?>">

                    </div>

                    <button type="submit" class="btn btn-success btn-sm">Salvar</button>

                </form>
            </div>
        </div>
    </div>
</div>