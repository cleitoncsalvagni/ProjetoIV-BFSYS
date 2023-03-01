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
				<a href='<?php echo base_url('receber/novo') ?>' title='Cadastrar nova conta' class='btn btn-success rounded btn-sm '><i class="fas fa-plus"></i>&nbsp; Nova conta</a>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Cliente</th>
								<th>Valor</th>
								<th class='text-center'>Data do vencimento</th>
								<th>Data de pagamento</th>
								<th class='text-center'>Situação</th>
								<th class='text-center no-sort pr-2'>Ações</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($contas_receber as $conta) : ?>

								<tr>
									<td><?php echo $conta->cliente ?></td>
									<td><?php echo 'R$&nbsp;' . $conta->conta_receber_valor ?></td>
									<td class='text-center'><?php echo formata_data_banco_sem_hora($conta->conta_receber_data_vencimento) ?></td>
									<td><?php echo ($conta->conta_receber_status == 1 ? formata_data_banco_com_hora($conta->conta_receber_data_pagamento) :  'Aguardando pagamento') ?></td>
									<td class='text-center pr-4'>
										<?php
										if ($conta->conta_receber_status == 1) {
											echo '<span class="badge badge-success btn-sm">Paga</span>';
										} else if (strtotime($conta->conta_receber_data_vencimento) > strtotime((date('Y-m-d')))) {
											echo '<span class="badge badge-dark btn-sm">A pagar</span>';
										} else if (strtotime($conta->conta_receber_data_vencimento) == strtotime((date('Y-m-d')))) {
											echo '<span class="badge badge-warning btn-sm">Vence hoje</span>';
										} else {
											echo '<span class="badge badge-danger btn-sm">Vencida</span>';
										}
										?>
									</td>

									<td class='text-center'>
										<a title="Editar" href="<?php echo base_url('receber/edit/' . $conta->conta_receber_id) ?>" class="btn btn-outline-primary rounded btn-sm"><i class="fas fa-user-edit"></i></a>
										<a title="Excluir" href="javascript(void)" data-toggle="modal" data-target="#user-<?php echo $conta->conta_receber_id ?>" class="btn btn-outline-danger rounded btn-sm"><i class="fas fa-user-times"></i></i></a>
									</td>
								</tr>

								<div class="modal fade" id="user-<?php echo $conta->conta_receber_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Deletar produto</h5>
												<button class="close" type="button" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">×</span>
												</button>
											</div>
											<div class="modal-body">Deseja mesmo <strong>deletar</strong> essa conta? Esta
												ação não pode ser desfeita!
											</div>
											<div class="modal-footer">
												<button class="btn btn-primary btn-sm" type="button" data-dismiss="modal">
													Cancelar
												</button>
												<a class="btn btn-danger btn-sm" href="<?php echo base_url('receber/del/' . $conta->conta_receber_id) ?>">Deletar</a>
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