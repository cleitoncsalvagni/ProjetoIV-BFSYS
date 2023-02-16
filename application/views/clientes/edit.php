<?php $this->load->view("layout/sidebar"); ?>
<div id="content">
    <?php $this->load->view("layout/navbar") ?>
    <div class="container-fluid">


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('clientes') ?>">Clientes</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
            </ol>
        </nav>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href='<?php echo base_url('clientes') ?>' title='Voltar' class='btn btn-outline-dark btn-sm col-md-2'><i class="fas fa-arrow-left"></i>&nbsp; Retornar</a>
            </div>
            <div class="card-body">
                <form method="POST" name="form_edit">

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="cliente_nome" placeholder="Informe o nome" value="<?php echo $cliente->cliente_nome; ?>">
                            <?php echo form_error('cliente_nome', '<small class="form-text text-danger">', '</small>') ?>

                        </div>

                        <div class="col-md-4">
                            <label>Sobrenome</label>
                            <input type="text" class="form-control" name="cliente_sobrenome" placeholder="Informe o sobrenome" value="<?php echo $cliente->cliente_sobrenome; ?>">
                            <?php echo form_error('cliente_sobrenome', '<small class="form-text text-danger">', '</small>') ?>
                        </div>

                        <div class="col-md-2">
                            <label>CPF ou CNPJ</label>
                            <input type="text" class="form-control" name="cliente_cpf_cnpj" placeholder="Informe o CPF ou o CNPJ" value="<?php echo $cliente->cliente_cpf_cnpj; ?>">
                            <?php echo form_error('cliente_cpf_cnpj', '<small class="form-text text-danger">', '</small>') ?>
                        </div>

                        <div class="col-md-2">
                            <label>RG ou IE</label>
                            <input type="text" class="form-control" name="cliente_rg_ie" placeholder="Informe o RG ou a Inscrição Estadual" value="<?php echo $cliente->cliente_rg_ie; ?>">
                            <?php echo form_error('cliente_rg_ie', '<small class="form-text text-danger">', '</small>') ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label>Email</label>
                            <input type="text" class="form-control" name="cliente_email" placeholder="Informe o email" value="<?php echo $cliente->cliente_email; ?>">
                            <?php echo form_error('cliente_email', '<small class="form-text text-danger">', '</small>') ?>

                        </div>

                        <div class="col-md-4">
                            <label>Celular</label>
                            <input type="text" class="form-control" name="cliente_celular" placeholder="Informe o celular" value="<?php echo $cliente->cliente_celular; ?>">
                            <?php echo form_error('cliente_celular', '<small class="form-text text-danger">', '</small>') ?>
                        </div>

                        <div class="col-md-4">
                            <label>Telefone fixo</label>
                            <input type="text" class="form-control" name="cliente_telefone" placeholder="Informe o telefone" value="<?php echo $cliente->cliente_telefone; ?>">
                            <?php echo form_error('cliente_telefone', '<small class="form-text text-danger">', '</small>') ?>
                        </div>

                        <!-- <div class="col-md-2">
                            <label>RG ou IE</label>
                            <input type="text" class="form-control" name="cliente_rg_ie" placeholder="Informe o RG ou a Inscrição Estadual" value="<?php echo $cliente->cliente_rg_ie; ?>">
                            <?php echo form_error('cliente_rg_ie', '<small class="form-text text-danger">', '</small>') ?>
                        </div> -->
                    </div>

                    <button type="submit" class="btn btn-success btn-sm col-md-12 mt-3">Salvar</button>

                </form>
            </div>
        </div>
    </div>
</div>