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
            <div class="card-body">
                <form method="POST" name="form_edit">

                    <p><strong><i class="fas fa-clock"></i>&nbsp;&nbsp;Última alteração:&nbsp;</strong><?php echo formata_data_banco_com_hora($cliente->cliente_data_alteracao) ?></p>

                    <fieldset class='mt-4 border p-3'>
                        <legend class='small'><i class="fas fa-fw fa-user-tie"></i>&nbsp; Dados Pessoais</legend>

                        <div class="form-group row mb-3">
                            <div class="col-md-5">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="cliente_nome" placeholder="Informe o nome" value="<?php echo $cliente->cliente_nome; ?>">
                                <?php echo form_error('cliente_nome', '<small class="form-text text-danger">', '</small>') ?>

                            </div>

                            <div class="col-md-5">
                                <label>Sobrenome</label>
                                <input type="text" class="form-control form-control-user" name="cliente_sobrenome" placeholder="Informe o sobrenome" value="<?php echo $cliente->cliente_sobrenome; ?>">
                                <?php echo form_error('cliente_sobrenome', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                            <div class="col-md-2">
                                <label>Data de nascimento</label>
                                <input type="date" class="form-control" name="cliente_data_nascimento" value="<?php echo $cliente->cliente_data_nascimento; ?>">
                                <?php echo form_error('cliente_data_nascimento', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                        </div>

                        <div class="form-group row mb-3">
                            <div class="col-md-3">
                                <?php if ($cliente->cliente_tipo == 1) : ?>
                                    <label>CPF</label>
                                    <input type="text" class="form-control cpf" name="cliente_cpf" placeholder="Informe o CPF" value="<?php echo $cliente->cliente_cpf_cnpj; ?>">
                                    <?php echo form_error('cliente_cpf', '<small class="form-text text-danger">', '</small>') ?>
                                <?php else : ?>
                                    <label>CNPJ</label>
                                    <input type="text" class="form-control cnpj" name="cliente_cnpj" placeholder="Informe o CNPJ" value="<?php echo $cliente->cliente_cpf_cnpj; ?>">
                                    <?php echo form_error('cliente_cnpj', '<small class="form-text text-danger">', '</small>') ?>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-3">
                                <?php if ($cliente->cliente_tipo == 1) : ?>
                                    <label>RG</label>
                                <?php else : ?>
                                    <label>Inscrição Estadual</label>
                                <?php endif; ?>
                                <input type="text" class="form-control" name="cliente_rg_ie" placeholder="<?php echo $cliente->cliente_tipo == 1 ? 'Informe o RG' : 'Informe a Inscriçaõ Estadual'; ?>" value="<?php echo $cliente->cliente_rg_ie; ?>">
                                <?php echo form_error('cliente_rg_ie', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                            <div class="col-md-6">
                                <label>Email</label>
                                <input type="text" class="form-control" name="cliente_email" placeholder="Informe o email" value="<?php echo $cliente->cliente_email; ?>">
                                <?php echo form_error('cliente_email', '<small class="form-text text-danger">', '</small>') ?>

                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <div class="col-md-3">
                                <label>Celular</label>
                                <input type="text" class="form-control sp_celphones" name="cliente_celular" placeholder="Informe o celular" value="<?php echo $cliente->cliente_celular; ?>">
                                <?php echo form_error('cliente_celular', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                            <div class="col-md-3">
                                <label>Telefone fixo</label>
                                <input type="text" class="form-control phone_with_ddd" name="cliente_telefone" placeholder="Informe o telefone fixo" value="<?php echo $cliente->cliente_telefone; ?>">
                                <?php echo form_error('cliente_telefone', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>

                    </fieldset>

                    <fieldset class='mt-4 border p-3'>
                        <legend class='small'><i class="fas fa-map-marker-alt"></i>&nbsp; Endereço</legend>
                        <div class="form-group row mb-3">
                            <div class="col-md-4">
                                <label>Endereço</label>
                                <input type="text" class="form-control" name="cliente_endereco" placeholder="Informe o endereço" value="<?php echo $cliente->cliente_endereco; ?>">
                                <?php echo form_error('cliente_endereco', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                            <div class="col-md-2">
                                <label>Numero</label>
                                <input type="text" class="form-control" name="cliente_numero_endereco" placeholder="Informe o número" value="<?php echo $cliente->cliente_numero_endereco; ?>">
                                <?php echo form_error('cliente_numero_endereco', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                            <div class="col-md-6">
                                <label>Complemento</label>
                                <input type="text" class="form-control" name="cliente_complemento" placeholder="Informe o complemento" value="<?php echo $cliente->cliente_complemento; ?>">
                                <?php echo form_error('cliente_complemento', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <div class="col-md-2">
                                <label>Bairro</label>
                                <input type="text" class="form-control" name="cliente_bairro" placeholder="Informe o bairro" value="<?php echo $cliente->cliente_bairro; ?>">
                                <?php echo form_error('cliente_bairro', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                            <div class="col-md-2">
                                <label>CEP</label>
                                <input type="text" class="form-control cep" name="cliente_cep" placeholder="Informe o CEP" value="<?php echo $cliente->cliente_cep; ?>">
                                <?php echo form_error('cliente_cep', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                            <div class="col-md-3">
                                <label>Cidade</label>
                                <input type="text" class="form-control" name="cliente_cidade" placeholder="Informe a cidade" value="<?php echo $cliente->cliente_cidade; ?>">
                                <?php echo form_error('cliente_cidade', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                            <div class="col-md-1">
                                <label>UF</label>
                                <input type="text" class="form-control uf" name="cliente_estado" placeholder="UF" value="<?php echo $cliente->cliente_estado; ?>">
                                <?php echo form_error('cliente_estado', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                        </div>
                    </fieldset>

                    <fieldset class='mt-4 border p-3 mb-3'>
                        <legend class='small'><i class="fas fa-user-cog"></i>&nbsp; Preferências</legend>

                        <div class="form-group row mb-3">
                            <div class="col-md-2">
                                <label>Cliente ativo</label>
                                <select name='cliente_ativo' class="form-control">
                                    <option value='1' <?php echo ($cliente->cliente_ativo == 1 ? 'selected' : '') ?>>Sim</option>
                                    <option value='0' <?php echo ($cliente->cliente_ativo == 0 ? 'selected' : '') ?>>Não</option>
                                </select>
                                <?php echo form_error('cliente_bairro', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group row">
                        <div class="col-md-8">
                            <label>Observações</label>
                            <textarea class="form-control" name="cliente_obs" placeholder="Observações"><?php echo $cliente->cliente_obs; ?></textarea>
                            <?php echo form_error('cliente_obs', '<small class="form-text text-danger">', '</small>') ?>
                        </div>
                    </div>

                    <input type='hidden' name='cliente_tipo' value="<?php echo $cliente->cliente_tipo; ?>">
                    <input type='hidden' name='cliente_id' value="<?php echo $cliente->cliente_id; ?>">


                    <button type="submit" class="btn btn-success btn-sm ">Salvar</button>
                    <a href='<?php echo base_url('clientes') ?>' title='Voltar' class='btn btn-primary btn-sm ml-2'>Voltar</a>
                </form>
            </div>
        </div>
    </div>
</div>