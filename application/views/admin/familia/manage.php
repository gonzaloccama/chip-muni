<?php $this->load->view('header'); ?>

<!--  BO :heading -->

<div class="row wrapper border-bottom white-bg page-heading">

	<div class="col-lg-10">

		<h2>Familia</h2>

		<ol class="breadcrumb">

			<li>

				<a href="<?php echo base_url() . 'chip-muni/admin/' ?>">Panel de administración</a>

			</li>

			<li class="active">

				<strong>Familia</strong>

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

				<a href="<?php echo base_url(); ?>admin/familia/add" class="btn btn-success"> <i
							class="fas fa-plus-circle"></i> NUEVO</a>

				<div class="form-group pull-right">

					<!--					<a href="--><?php //echo $csvlink; ?><!--" class="btn btn-info">CSV</a>-->

					<form action="<?php echo base_url() . "admin/PrintPDF/index" ?>" method="POST" target="_blank"
						  class="form-group form-inline pull-right">
						<select class="form-control select1" name="printpdf" id="">

							<option value="" selected disabled>Selecciona para imprimir</option>
							<option value="entrega_familia">Entregado por familias</option>
							<option value="familia_institucion">Familia por institución</option>
							<option value="entrega_estudiante">Entregado por estudiante</option>
							<option value="contacto_familia">Información para ubicar familia</option>
							<option value="sin_estudiante_familia">Familia sin estudiantes</option>
							<option value="sin_familia_estudiantes">Estudiantes sin familia</option>
							<option value="observados">Lista de observados</option>

						</select>

						<input type="submit" class="btn btn-success" value="PDF">
					</form>

					<!--					<a href="-->
					<?php //echo base_url() . "admin/printlistaobservado/index/observado" ?><!--" class="btn btn-success" target="_blank">OBSERVADOS</a>-->
					<!--					<a href="-->
					<?php //echo base_url() . "admin/printlistafamilia/index/familias" ?><!--" class="btn btn-success" target="_blank">PDF</a>-->

				</div>

				<form method="GET" action="<?php echo base_url() . 'admin/familia/index'; ?>"
					  class="form-inline ibox-content">

					<div class="form-group">

						<select name="searchBy" class="form-control">

							<option value="dni" <?php echo $searchBy == "dni" ? 'selected="selected"' : ""; ?>>DNI
							</option>
							<option
									value="nombres" <?php echo $searchBy == "nombres" ? 'selected="selected"' : ""; ?>>
								Nombres
							</option>
							<option
									value="ape_pat" <?php echo $searchBy == "ape_pat" ? 'selected="selected"' : ""; ?>>
								Apellido Paterno
							</option>
							<option
									value="ape_mat" <?php echo $searchBy == "ape_mat" ? 'selected="selected"' : ""; ?>>
								Apellido Materno
							</option>
							<option
									value="direccion" <?php echo $searchBy == "direccion" ? 'selected="selected"' : ""; ?>>
								Direccion
							</option>
							<option
									value="barrio.barrio" <?php echo $searchBy == "barrio.barrio" ? 'selected="selected"' : ""; ?>>
								Barrio
							</option>
							<option
									value="celular" <?php echo $searchBy == "celular" ? 'selected="selected"' : ""; ?>>
								Celular
							</option>
							<option
									value="fecha_entrega" <?php echo $searchBy == "fecha_entrega" ? 'selected="selected"' : ""; ?>>
								Fecha Entrega
							</option>
							<option
									value="observations" <?php echo $searchBy == "observations" ? 'selected="selected"' : ""; ?>>
								Observaciones
							</option>
							<option
									value="fecha_registro" <?php echo $searchBy == "fecha_registro" ? 'selected="selected"' : ""; ?>>
								Fecha Registro
							</option>

						</select>

					</div>

					<div class="form-group">

						<input type="text" name="searchValue" id="searchValue" class="form-control"
							   value="<?php echo $searchValue; ?>">

					</div>

					<input type="submit" name="search" value="Buscar" class="btn btn-primary">

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

							<option value="124" <?php echo $per_page == "124" ? 'selected="selected"' : ""; ?>>124
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

							<!--							<th><input onclick="toggle(this,'cbgroup1')" id="foo[]" name="foo[]" type="checkbox"-->
							<!--									   value=""/></th>-->

							<th> N°</th>

							<?php $sortSym = isset($_GET["order"]) && $_GET["order"] == "asc" ? "up" : "down"; ?>

							<?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "dni" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>

							<th><a href="<?php echo $fields_links["dni"]; ?>" class="link_css">
									DNI </a></th>


							<?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "nombres" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>

							<th><a href="<?php echo $fields_links["nombres"]; ?>" class="link_css">
									Nombres </a></th>


							<?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "ape_pat" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>

							<th><a href="<?php echo $fields_links["ape_pat"]; ?>" class="link_css">
									Apellido_Paterno </a></th>


							<?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "ape_mat" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>

							<th><a href="<?php echo $fields_links["ape_mat"]; ?>" class="link_css">
									Apellido_Materno </a></th>


							<?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "direccion" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>

							<th><a href="<?php echo $fields_links["direccion"]; ?>" class="link_css">
									Direccion </a></th>


							<?php

							$symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "barrio.barrio" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>


							<th><a href="<?php echo $fields_links["barrio.barrio"]; ?>" class="link_css">
									Barrio </a></th>


							<?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "celular" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>

							<th><a href="<?php echo $fields_links["celular"]; ?>" class="link_css">
									Celular </a></th>


							<?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "fecha_entrega" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>

							<th><a href="<?php echo $fields_links["fecha_entrega"]; ?>" class="link_css">
									Fecha_entrega </a></th>


							<?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "observations" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>

							<!--							<th><a href="-->
							<?php //echo $fields_links["observations"]; ?><!--" class="link_css">-->
							<!--									Observaciones </a></th>-->


							<?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "fecha_registro" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>

							<!--							<th><a href="-->
							<?php //echo $fields_links["fecha_registro"]; ?><!--" class="link_css">-->
							<!--									Fecha_registro </a></th>-->

							<th class="action-width">Estud.</th>

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

								<tr id="hide<?php echo $value->dni; ?>">

									<!--									<th><input name='input' id='del' onclick="callme('show')" type='checkbox'-->
									<!--											   class='del' value='-->
									<?php //echo $value->dni; ?><!--'/></th>-->


									<th><?php if (!empty($value->dni)) {
											echo $count;
											$count++;
										} ?></th>
									<th><?php if (!empty($value->dni)) {
											echo $value->dni;
										} ?></th>

									<th><?php if (!empty($value->nombres)) {
											echo $value->nombres;
										} ?></th>

									<th><?php if (!empty($value->ape_pat)) {
											echo $value->ape_pat;
										} ?></th>

									<th><?php if (!empty($value->ape_mat)) {
											echo $value->ape_mat;
										} ?></th>

									<th><?php if (!empty($value->direccion)) {
											echo $value->direccion;
										} ?></th>

									<th><?php if (!empty($value->barrio)) {
											echo $value->barrio;
										} ?></th>

									<th><?php if (!empty($value->celular)) {
											echo $value->celular;
										} ?></th>

									<th>
										<?php
										if ($value->fecha_entrega != 0000) {
											echo $value->fecha_entrega;
										}
										?>
									</th>

									<!--									<th>-->
									<?php //if (!empty($value->observations)) {
									//											echo $value->observations;
									//										} ?><!--</th>-->

									<!--									<th>-->
									<?php //if (!empty($value->fecha_registro)) {
									//											echo $value->fecha_registro;
									//										} ?><!--</th>-->

									<th class="action-width">

										<a href="<?php echo base_url() ?>admin/estudiante/index/dni_familia/<?php echo $value->dni; ?>/1"
										   title="Ver">

											<span class="btn btn-primary ">

												Estudiantes

											</span>

										</a>

									</th>
									<th class="action-width">

										<a href="<?php echo base_url() ?>admin/familia/view/<?php echo $value->dni; ?>"
										   title="Ver">

											<span class="btn btn-success "><i class="fa fa-eye"></i></span>

										</a>

										<a href="<?php echo base_url() ?>admin/familia/edit/<?php echo $value->dni; ?>"
										   title="Editar">

											<span class="btn btn-success "><i class="fa fa-edit"></i></span>

										</a>

										<a title="Eliminar" data-toggle="modal" data-target="#commonDelete"
										   onclick="set_common_delete('<?php echo $value->dni; ?>','familia');">

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

				url: '<?php echo base_url() . "admin/familia/deleteAll"; ?>',

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
