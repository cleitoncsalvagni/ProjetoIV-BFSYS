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
				<a href='<?php echo base_url('produtos/novo') ?>' title='Cadastrar novo produto' class='btn btn-success rounded-pill btn-sm float-right'><i class="fas fa-plus"></i>&nbsp; Novo
					produto</a>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Código</th>
								<th>Descrição</th>
								<th>Marca</th>
								<th>Categoria</th>
								<th class="text-center pr-2">Estoque mínimo</th>
								<th class="text-center pr-2">Estoque atual</th>
								<th class='text-center'>Ativo</th>
								<th class='text-center no-sort pr-2'>Ações</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($produtos as $produto) : ?>

								<tr>
									<td><?php echo $produto->produto_codigo ?></td>
									<td><?php echo $produto->produto_descricao ?></td>
									<td><?php echo $produto->marca ?></td>
									<td><?php echo $produto->categoria ?></td>
									<td class="text-center"><?php echo '<span class="badge badge-secondary btn-sm">' . $produto->produto_estoque_minimo . '</span>' ?></td>
									<td class="text-center"><?php echo ($produto->produto_estoque_minimo >= $produto->produto_qtde_estoque ? '<span class="badge badge-warning btn-sm">' . $produto->produto_qtde_estoque . '</span>' : '<span class="badge badge-info btn-sm">' . $produto->produto_qtde_estoque . '</span>') ?></td>
									<td class='text-center pr-4'><?php echo ($produto->produto_ativo ? '<span class="badge badge-success btn-sm">Sim</span>' : '<span class="badge badge-danger btn-sm">Não</span>') ?></td>
									<td class='text-center'>
										<a title="Editar" href="<?php echo base_url('produtos/edit/' . $produto->produto_id) ?>" class="btn btn-outline-primary rounded btn-sm"><i class="fas fa-user-edit"></i></a>
										<a title="Excluir" href="javascript(void)" data-toggle="modal" data-target="#user-<?php echo $produto->produto_id ?>" class="btn btn-outline-danger rounded btn-sm"><i class="fas fa-user-times"></i></i></a>
									</td>
								</tr>

								<div class="modal fade" id="user-<?php echo $produto->produto_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Deletar produto</h5>
												<button class="close" type="button" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">×</span>
												</button>
											</div>
											<div class="modal-body">Deseja mesmo <strong>deletar</strong> o produto? Esta
												ação não pode ser desfeita!
											</div>
											<div class="modal-footer">
												<button class="btn btn-primary btn-sm" type="button" data-dismiss="modal">
													Cancelar
												</button>
												<a class="btn btn-danger btn-sm" href="<?php echo base_url('produtos/del/' . $produto->produto_id) ?>">Deletar</a>
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