<?php $this->load->view('header'); ?>

<!--  BO :heading -->

<div class="row wrapper border-bottom white-bg page-heading">

	<div class="col-lg-10">

		<h2>Institucion</h2>

		<ol class="breadcrumb">

			<li>

				<a href="<?php echo base_url() . 'chip-muni/admin/' ?>">Panel de administración</a>

			</li>

			<li class="active">

				<strong>Institucion</strong>

			</li>

		</ol>

	</div>

	<div class="col-lg-2">

	</div>

</div>

<div class="row">

	<div class="col-lg-12">

		<div class="ibox ">

			<br>

			<div class="ibox-title">

				<?php if ($this->session->flashdata('message')): ?>

					<div class="alert alert-success">

						<button type="button" class="close" data-close="alert"></button>

						<?php echo $this->session->flashdata('message'); ?>

					</div>

				<?php endif; ?>

				<a href="<?php echo base_url(); ?>admin/institucion/add" class="btn btn-success">NUEVO</a>

				<br>

				<div class="form-group pull-right">

					<!--					<a href="--><?php //echo $csvlink; ?><!--" class="btn btn-info">CSV</a>-->

					<form action="<?php echo base_url() . "admin/PrintPDF/index" ?>" method="POST" target="_blank"
						  class="form-group form-inline pull-right">
						<select class="form-control select1 selectpicker" name="printpdf" id="">

							<option value="" selected disabled>Selecciona para imprimir</option>
							<?php
							foreach ($institucionprint as $item):

							?>

							<option value="familia_institucion/<?= $item->id_institucion ?>?insti=<?= $item->institucion ?>">
								<?= $item->institucion ?>
							</option>


							<?php
							 endforeach;
							?>

						</select>

						<input type="submit" class="btn btn-success" value="PDF">
					</form>

					<!--					<a href="-->
					<?php //echo base_url() . "admin/printlistaobservado/index/observado" ?><!--" class="btn btn-success" target="_blank">OBSERVADOS</a>-->
					<!--					<a href="-->
					<?php //echo base_url() . "admin/printlistafamilia/index/familias" ?><!--" class="btn btn-success" target="_blank">PDF</a>-->

				</div>

				<form method="GET" action="<?php echo base_url() . 'admin/institucion/index'; ?>"
					  class="form-inline ibox-content">

					<div class="form-group">

						<select name="searchBy" class="form-control">

							<option
									value="institucion" <?php echo $searchBy == "institucion" ? 'selected="selected"' : ""; ?>>
								Institucion
							</option>

						</select>

					</div>

					<div class="form-group">

						<input type="text" name="searchValue" id="searchValue" class="form-control"
							   value="<?php echo $searchValue; ?>">

					</div>

					<input type="submit" name="search" value="Buscar" class="btn btn-success">

					<div class="form-group pull-right">

						<select name="per_page" class="form-control" onchange="this.form.submit()">

							<option value="8" <?php echo $per_page == "8" ? 'selected="selected"' : ""; ?>>8
							</option>

							<option value="16" <?php echo $per_page == "16" ? 'selected="selected"' : ""; ?>>16
							</option>

							<option value="32" <?php echo $per_page == "32" ? 'selected="selected"' : ""; ?>>32
							</option>

							<option value="64" <?php echo $per_page == "64" ? 'selected="selected"' : ""; ?>>64
							</option>

							<option value="128" <?php echo $per_page == "128" ? 'selected="selected"' : ""; ?>>128
							</option>

						</select>

					</div>

				</form>

			</div>

			<div class="ibox-content">

				<div class="table table-responsive">

					<table class="table table-striped table-bordered table-hover Tax" id="example"
						   style="font-size: 13px; font-family: Arsenal;">

						<thead>

						<tr>

							<!--                     <th><input onclick="toggle(this,'cbgroup1')" id="foo[]" name="foo[]" type="checkbox" value="" /></th>-->

							<th> ID</th>

							<?php $sortSym = isset($_GET["order"]) && $_GET["order"] == "asc" ? "up" : "down"; ?>

							<?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "institucion" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>

							<th><a href="<?php echo $fields_links["institucion"]; ?>" class="link_css">
									Institucion </a></th>


							<?php

							$symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "nivel.nivel" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>


							<th><a href="<?php //echo $fields_links["nivel.nivel"]; ?>" class="link_css">
									Nivel </a></th>


							<th> Acción</th>

						</tr>

						</thead>

						<tbody>

						<?php if (isset($results) and !empty($results)) {


							$count = 1;


							?>

							<?php

							foreach ($results as $key => $value) {


								?>

								<tr id="hide<?php echo $value->id_institucion; ?>">

									<!--									<th><input name='input' id='del' onclick="callme('show')" type='checkbox'-->
									<!--											   class='del' value='-->
									<?php //echo $value->id_institucion; ?><!--'/></th>-->


									<th><?php if (!empty($value->id_institucion)) {
											//echo $count;
											echo $value->id_institucion;
											$count++;
										} ?></th>
									<th><?php if (!empty($value->institucion)) {
											echo $value->institucion;
										} ?></th>

									<th><?php if (!empty($value->id_nivel)) {
											echo $value->nivel;
										} ?></th>

									<th class="action-width">

										<a href="<?php echo base_url() ?>admin/institucion/view/<?php echo $value->id_institucion; ?>"
										   title="Ver">

											<span class="btn btn-success "><i class="fa fa-eye"></i></span>

										</a>

										<a href="<?php echo base_url() ?>admin/institucion/edit/<?php echo $value->id_institucion; ?>"
										   title="Editar">

											<span class="btn btn-success "><i class="fa fa-edit"></i></span>

										</a>

										<a title="Eliminar" data-toggle="modal" data-target="#commonDelete"
										   onclick="set_common_delete('<?php echo $value->id_institucion; ?>','institucion');">

											<span class="btn btn-danger "><i class="fa fa-trash "></i></span>

										</a>

									</th>

								</tr>

								<?php

							}


						} else {

							echo '<tr><td colspan="100"><h3 align="center" class="text-danger">No Record found!</center</td></tr>';

						} ?>

						</tbody>

					</table>

				</div>

				<?php echo $links; ?>

			</div>

		</div>

		<img onclick="callme('','item','')"
			 src="<?php echo $this->config->item('accet_url') ?>/img/mac-trashcan_full-new.png" id="recycle"
			 style="width:90px;  display:none; position:fixed; bottom: 50px; right: 50px;"/>

	</div>

</div>

<script type="text/javascript">

	function delRow() {

		var confrm = confirm("Are you sure you want to delete?");

		if (confrm) {

			ids = values();

			$.ajax({

				type: "POST",

				url: '<?php echo base_url() . "admin/institucion/deleteAll"; ?>',

				data: {

					allIds: ids,

					'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'

				},

				success: function () {

					location.reload();

				},

			});

		}

	}

</script>

<?php $this->load->view('footer'); ?>
