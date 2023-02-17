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
            <div class="card-body">
                <form method="POST" name="form_edit">

                    <fieldset class='mt-4 border p-3 mb-3'>
                        <legend class='small'><i class="fas fa-building"></i>&nbsp; Empresa</legend>
                        <div class="form-group row mb-4">
                            <div class="col-md-4">
                                <label>Razão Social</label>
                                <input type="text" class="form-control" name="sistema_razao_social" placeholder="Razão social" value="<?php echo $sistema->sistema_razao_social; ?>">
                                <?php echo form_error('sistema_razao_social', '<small class="form-text text-danger">', '</small>') ?>

                            </div>

                            <div class="col-md-3">
                                <label>Nome Fantasia</label>
                                <input type="text" class="form-control" name="sistema_nome_fantasia" placeholder="Nome fantasia" value="<?php echo $sistema->sistema_nome_fantasia; ?>">
                                <?php echo form_error('sistema_nome_fantasia', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                            <div class="col-md-3">
                                <label>CNPJ</label>
                                <input type="text" class="form-control cnpj" name="sistema_cnpj" placeholder="CNPJ" value="<?php echo $sistema->sistema_cnpj; ?>">
                                <?php echo form_error('sistema_cnpj', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                            <div class="col-md-2">
                                <label>Inscrição Estadual</label>
                                <input type="text" class="form-control" name="sistema_ie" placeholder="Inscrição estadual" value="<?php echo $sistema->sistema_ie; ?>">
                                <?php echo form_error('sistema_ie', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class='mt-4 border p-3 mb-3'>
                        <legend class='small'><i class="fas fa-phone"></i>&nbsp; Contato</legend>

                        <div class="form-group row mb-4">

                            <div class="col-md-3">
                                <label>Celular</label>
                                <input type="text" class="form-control sp_celphones" name="sistema_telefone_movel" placeholder="Celular" value="<?php echo $sistema->sistema_telefone_movel; ?>">
                                <?php echo form_error('sistema_telefone_movel', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                            <div class="col-md-3">
                                <label>Telefone Fixo</label>
                                <input type="text" class="form-control" name="sistema_telefone_fixo" placeholder="Telefone fixo" value="<?php echo $sistema->sistema_telefone_fixo; ?>">
                                <?php echo form_error('sistema_telefone_fixo', '<small class="form-text text-danger">', '</small>') ?>

                            </div>

                            <div class="col-md-3">
                                <label>Email</label>
                                <input type="text" class="form-control" name="sistema_email" placeholder="Email de contato" value="<?php echo $sistema->sistema_email; ?>">
                                <?php echo form_error('sistema_email', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                            <div class="col-md-3">
                                <label>Site</label>
                                <input type="text" class="form-control" name="sistema_site_url" placeholder="URL do Site" value="<?php echo $sistema->sistema_site_url ?>">
                                <?php echo form_error('sistema_site_url', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class='mt-4 border p-3 mb-3'>
                        <legend class='small'><i class="fas fa-map-marker-alt"></i>&nbsp; Endereço</legend>

                        <div class="form-group row mb-4">
                            <div class="col-md-4">
                                <label>Endereço</label>
                                <input type="text" class="form-control" name="sistema_endereco" placeholder="Endereço" value="<?php echo $sistema->sistema_endereco; ?>">
                                <?php echo form_error('sistema_endereco', '<small class="form-text text-danger">', '</small>') ?>

                            </div>

                            <div class="col-md-2">
                                <label>Número</label>
                                <input type="text" class="form-control" name="sistema_numero" placeholder="Número" value="<?php echo $sistema->sistema_numero; ?>">
                                <?php echo form_error('sistema_numero', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                            <div class="col-md-2">
                                <label>CEP</label>
                                <input type="text" class="form-control cep" name="sistema_cep" placeholder="CEP" value="<?php echo $sistema->sistema_cep; ?>">
                                <?php echo form_error('sistema_cep', '<small class="form-text text-danger">', '</small>') ?>
                            </div>


                            <div class="col-md-2">
                                <label>Cidade</label>
                                <input type="text" class="form-control" name="sistema_cidade" placeholder="Cidade" value="<?php echo $sistema->sistema_cidade; ?>">
                                <?php echo form_error('sistema_cidade', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                            <div class="col-md-2">
                                <label>UF</label>
                                <input type="text" class="form-control uf" name="sistema_estado" placeholder="UF" value="<?php echo $sistema->sistema_estado; ?>">
                                <?php echo form_error('sistema_estado', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>
                    </fieldset>


                    <div class="form-group row mb-3">
                        <div class="col-md-12">
                            <label>Texto da ordem de serviço e venda</label>
                            <textarea name=' sistema_txt_ordem_servico' class="form-control" placeholder="Ex: Obrigado por adquirir nossos serviços!"><?php echo $sistema->sistema_txt_ordem_servico; ?></textarea>
                            <?php echo form_error('sistema_txt_ordem_servico', '<small class="form-text text-danger">', '</small>') ?>

                        </div>
                    </div>





                    <button type="submit" class="btn btn-success btn-sm text-center">Salvar</button>
                    <a href='<?php echo base_url('/') ?>' title='Voltar' class='btn btn-primary btn-sm ml-2'>Voltar</a>

                </form>
            </div>
        </div>
    </div>
</div>