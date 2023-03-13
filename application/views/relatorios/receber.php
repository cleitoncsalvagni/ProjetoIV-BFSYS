<?php $this->load->view('layout/sidebar'); ?>



<div id="content">

	<?php $this->load->view('layout/navbar'); ?>


	<div class="container-fluid">

		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url('/'); ?>">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page"><?php echo $pageTitle; ?></li>
			</ol>
		</nav>

		<div class="card shadow mb-4">


			<div class="card-body">

				<form action="" class="user" name="form_receber" enctype="multipart/form-data" method="post" accept-charset="utf-8">

					<fieldset class="mt-4 border p-2">

						<legend class="small"><i class="fas fa-calendar-alt"></i></i>&nbsp;&nbsp;Escolha uma opção</legend>

						<div class="form-group row pt-3 pl-3">
							<div class="custom-control custom-radio col offset-md-1 mb-2">
								<input type="radio" id="customRadio1" name="contas" value="pagas" class="custom-control-input" checked="">
								<label class="custom-control-label" for="customRadio1">Contas pagas</label>
							</div>
							<div class="custom-control custom-radio ml-auto col mb-2">
								<input type="radio" id="customRadio2" name="contas" value="receber" class="custom-control-input">
								<label class="custom-control-label" for="customRadio2">Contas a receber</label>
							</div>
							<div class="custom-control custom-radio ml-auto col">
								<input type="radio" id="customRadio3" name="contas" value="vencidas" class="custom-control-input">
								<label class="custom-control-label" for="customRadio3">Contas vencidas</label>
							</div>

						</div>

					</fieldset>


					<div class="mt-3">
						<button class="btn btn-success btn-sm mr-2">Gerar relatório</button>
					</div>

				</form>

			</div>
		</div>

	</div>

	<?php
	if ($message = $this->session->flashdata('info')) {
		echo "<script>toastr.info('" . $message . "');</script>";
	}
	?>

</div>