<?php $this->load->view('header'); ?>

<!--  BO :heading -->
<?php
require_once('application/models/admin/Query_1.php');
require_once('application/models/admin/Query_select_chip.php');
require_once('application/models/admin/Query_select_cse.php');

//require_once ('application/models/admin/Query_update_1.php');
?>
<div class="row wrapper border-bottom white-bg page-heading">

	<div class="col-lg-10">

		<h2>Estudiantes</h2>

		<ol class="breadcrumb">

			<li>

				<a href="<?php echo base_url() . 'chip-muni/admin/' ?>">Panel de administración</a>
				<span for=""> / </span>
				<a href="<?php echo base_url() . "admin/familia/index" ?>"><strong for="">Administrar
						familia</strong></a>

			</li>

			<li class="active">

				<strong><?php echo $rel_id; ?></strong>

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

				<a href="<?php echo base_url(); ?>admin/estudiante/add/<?php echo $rel_field; ?>/<?php echo $rel_id; ?>"
				   class="btn btn-success"><i class="fas fa-plus-circle"></i> NUEVO</a>

				<a href="<?php echo base_url() ?>admin/familia/edit/<?php echo $rel_id; ?>"
				   title="Actualizar dirección y número de celular aqui">

					<span class="btn btn-success "><i class="fa fa-edit"></i> EDITAR</span>

				</a>


				<?php
				if ($row_familia['fecha_entrega'] != 0000) {
				?>
				<form class="form-group form-inline pull-right"
					  action="<?php echo base_url() . "admin/regnen/index/" . "$rel_field" . "/" . "$rel_id"; ?>">
					<input type="hidden" class="form-control" id="chip" name="chip" placeholder="Escribe para entregar"
						   value="">
					<input type="hidden" class="form-control" id="plan" name="plan" placeholder="Plan" value="">
					<input type="submit" class="btn btn-danger" value="ANULAR ENTREGAR">
					<?php
					}else {
					?>
					<form class="form-group form-inline pull-right"
						  action="<?php echo base_url() . "admin/regen/index/" . "$rel_field" . "/" . "$rel_id"; ?>">
						<select class="form-control select1" name="plan" id="plan">
							<option value="" disabled selected>Plan</option>
							<option value="2">2</option>
							<option value="5">5</option>
						</select>

						<input type="text" class="form-control" id="chip" name="chip" placeholder="Número de chip"
							   minlength="9" maxlength="9" required>

						<input type="submit" class="btn btn-success" value="ENTREGAR">
						<?php
						}
						?>
						<a href="<?php echo base_url() . "admin/printestudiantes/index/" . "$rel_field" . "/" . "$rel_id"; ?>"
						   class="btn btn-success" target="_blank">PDF</a>
						<br clear="all">
					</form>

					<hr>

					<div class="row">
						<div class="group-option">
							<label class="col-md-5" style="font-family: 'Calibri Light'; font-size: 16px;">ESTADO DE
								CHIP:
								<?php
								if ($row_familia['fecha_entrega'] != 0000) {
									?>
									<label style="font-family: 'Calibri Light'; font-size: 16px; color: #72ad59">
										CHIP ENTREGADO
									</label>
									<?php
								} else {
									?>
									<label style="font-family: 'Calibri Light'; font-size: 16px; color: #ad1113">
										AÚN NO REGISTRA ENTREGA
									</label>
									<?php
								}
								?>
							</label>

							<label class="col-md-4" style="font-family: 'Calibri Light'; font-size: 16px;">FECHA DE
								ENTREGA:
								<label style="font-family: 'Calibri Light'; font-size: 16px; color: #1C84C6"> <?php echo $row_familia['fecha_entrega']; ?> </label>
							</label>

							<label class="col-md-3" style="font-family: 'Calibri Light'; font-size: 16px;">RESPONSABLE:
								<label style="font-family: 'Calibri Light'; font-size: 16px; color: #1C84C6"> <?php echo $row_familia['dni']; ?> </label>
							</label>


						</div>
					</div>


					<!--				<form method="GET"-->
					<!--					  action="--><?php //echo base_url() . 'admin/estudiante/index'; ?><!--/-->
					<?php //echo $rel_field; ?><!--/--><?php //echo $rel_id; ?><!--"-->
					<!--					  class="form-inline ibox-content">-->
					<!---->
					<!--					<div class="form-group">-->
					<!---->
					<!--						<select name="searchBy" class="form-control">-->
					<!---->
					<!--							<option value="dni" --><?php //echo $searchBy == "dni" ? 'selected="selected"' : ""; ?>
					<!--							</option>-->
					<!--							<option-->
					<!--								value="nombres" --><?php //echo $searchBy == "nombres" ? 'selected="selected"' : ""; ?>
					<!--								Nombres-->
					<!--							</option>-->
					<!--							<option-->
					<!--								value="ape_pat" --><?php //echo $searchBy == "ape_pat" ? 'selected="selected"' : ""; ?>
					<!--								Apellido Paterno-->
					<!--							</option>-->
					<!--							<option-->
					<!--								value="ape_mat" --><?php //echo $searchBy == "ape_mat" ? 'selected="selected"' : ""; ?>
					<!--								Apellido Materno-->
					<!--							</option>-->
					<!--							<option-->
					<!--								value="institucion.institucion" --><?php //echo $searchBy == "institucion.institucion" ? 'selected="selected"' : ""; ?>
					<!--								Institución-->
					<!--							</option>-->
					<!--							<option-->
					<!--								value="nivel.nivel" --><?php //echo $searchBy == "nivel.nivel" ? 'selected="selected"' : ""; ?>
					<!--								Nivel-->
					<!--							</option>-->
					<!--							<option-->
					<!--								value="fecha_registro" --><?php //echo $searchBy == "fecha_registro" ? 'selected="selected"' : ""; ?>
					<!--								Fecha Registro-->
					<!--							</option>-->
					<!--							<option-->
					<!--								value="familia.dni" --><?php //echo $searchBy == "familia.dni" ? 'selected="selected"' : ""; ?>
					<!--								DNI Familia-->
					<!--							</option>-->
					<!---->
					<!--						</select>-->
					<!---->
					<!--					</div>-->
					<!---->
					<!--					<div class="form-group">-->
					<!---->
					<!--						<input type="text" name="searchValue" id="searchValue" class="form-control"-->
					<!--							   value="--><?php //echo $searchValue; ?><!--">-->
					<!---->
					<!--					</div>-->
					<!---->
					<!--					<input type="submit" name="search" value="Buscar" class="btn btn-primary">-->
					<!---->
					<!--					<div class="form-group pull-right">-->
					<!---->
					<!--						<select name="per_page" class="form-control" onchange="this.form.submit()">-->
					<!---->
					<!--							<option value="8" --><?php //echo $per_page == "8" ? 'selected="selected"' : ""; ?>
					<!--							</option>-->
					<!---->
					<!--							<option value="16" --><?php //echo $per_page == "16" ? 'selected="selected"' : ""; ?>
					<!--							</option>-->
					<!---->
					<!--							<option value="32" --><?php //echo $per_page == "32" ? 'selected="selected"' : ""; ?>
					<!--							</option>-->
					<!---->
					<!--							<option value="64" --><?php //echo $per_page == "64" ? 'selected="selected"' : ""; ?>
					<!--							</option>-->
					<!---->
					<!--							<option value="124" --><?php //echo $per_page == "124" ? 'selected="selected"' : ""; ?>
					<!--							</option>-->
					<!---->
					<!--						</select>-->
					<!---->
					<!--					</div>-->
					<!---->
					<!--				</form>-->

			</div>

			<div class="ibox-content">

				<div class="table table-responsive">

					<table class="table table-striped table-bordered table-hover Tax" id="example1"
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


							<?php

							$symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "institucion.institucion" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>


							<th><a href="<?php echo $fields_links["institucion.institucion"]; ?>" class="link_css">
									Institución </a></th>


							<?php

							$symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "nivel.nivel" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>


							<th><a href="<?php echo $fields_links["nivel.nivel"]; ?>" class="link_css">
									Nivel </a></th>


							<?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "fecha_registro" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>

							<th><a href="<?php echo $fields_links["fecha_registro"]; ?>" class="link_css">
									Observaciones </a></th>


							<?php

							$symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "familia.dni" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>


							<th><a href="<?php echo $fields_links["familia.dni"]; ?>" class="link_css">
									DNI_Familia </a></th>


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

									<th><?php if (!empty($value->institucion)) {
											echo $value->institucion;
										} ?></th>

									<th><?php if (!empty($value->nivel)) {
											echo $value->nivel;
										} ?></th>

									<th><?php if (!empty($value->observations)) {
											?>
											<button type="button" class="btn btn-sm btn-default" data-container="body"
													data-toggle="popover" data-placement="top" title="Observaciones"
													data-content="<?php echo $value->observations; ?>">
												Observación
											</button>
											<?php
										} ?>
									</th>

									<th><?php if (!empty($value->dni_familia)) {
											echo $value->dni_familia;
										} ?></th>

									<th class="action-width">

										<a href="<?php echo base_url() ?>admin/estudiante/view/<?php echo $value->dni; ?>/<?php echo $rel_field; ?>/<?php echo $rel_id; ?>"
										   title="Ver">

											<span class="btn btn-success "><i class="fa fa-eye"></i></span>

										</a>

										<a href="<?php echo base_url() ?>admin/estudiante/edit/<?php echo $value->dni; ?>/<?php echo $rel_field; ?>/<?php echo $rel_id; ?>"
										   title="Editar">

											<span class="btn btn-success "><i class="fa fa-edit"></i></span>

										</a>

										<a title="Eliminar" data-toggle="modal" data-target="#commonDelete"
										   onclick="set_common_delete('<?php echo $value->dni; ?>','estudiante');">

											<span class="btn btn-danger "><i class="fa fa-trash "></i></span>

										</a>

									</th>

								</tr>

								<?php

							}


						} else {

							echo '<tr><td colspan="100"><h3 align="center" class="text-danger">¡Ningún estudiante fue encontrado!</center</td></tr>';

						} ?>

						</tbody>

					</table>

				</div>

				<!--				--><?php //echo $links; ?>

			</div>
			<br>
			<div class="row">
				<div class="col-md-4">
					<div class="ibox-title ">
						<h3>CLASIFICACIÓN SOCIO ECONÓMICO</h3>
					</div>
					<div class="ibox-content">
						<div class="group-option">

							<label class="col-md-5"
								   style="font-family: 'Calibri Light'; font-size: 16px;">CSE-SISFOH:</label>
							<p class="col-md-7"
							   style="font-family: 'Calibri Light'; font-size: 16px; color: #1C84C6; font-weight: bold">
								<?php echo $row_familia_cse['cse'] == "" ? "Sin verificar" : $row_familia_cse['cse']; ?>
							</p>

						</div>

						<br clear="all">
					</div>

				</div>

				<div class="col-md-8">
					<div class="ibox-title ">
						<h3>DESCRIPCION DEL CHIP</h3>
					</div>
					<div class="ibox-content">
						<div class="group-option">

							<label class="col-md-5" style="font-family: 'Calibri Light'; font-size: 16px;">NUMERO DE
								CHIP ENTREGADO:</label>
							<p class="col-md-3"
							   style="font-family: 'Calibri Light'; font-size: 16px; color: #1C84C6; font-weight: bold">
								<?php echo $row_service_chip['numero_chip'] == 0 ? "Chip sin entregar" : $row_service_chip['numero_chip']; ?>
							</p>
							<div class="col-md-2"></div>
							<label class="col-md-1" style="font-family: 'Calibri Light'; font-size: 16px;">PLAN:</label>
							<p class="col-md-1"
							   style="font-family: 'Calibri Light'; font-size: 16px; color: #1C84C6; font-weight: bold"> <?php echo $row_service_chip['plan'] == 0 ? "_" : $row_service_chip['plan']; ?> </p>

						</div>

						<br clear="all">
					</div>

				</div>

			</div>


			<br>

			<div class="row">
				<div class="col-md-12">
					<div class="ibox-title ">
						<h3>INFORMACIÓN DEL RESPONSABLE</h3>
					</div>
					<div class="ibox-content">


						<div class="panel panel-default col-sm-6">
							<br>
							<div class="group-option">

								<label class="col-md-3"
									   style="font-family: 'Calibri Light'; font-size: 14px;">DNI:</label>
								<p class="col-md-9"
								   style="font-family: 'Calibri Light'; font-size: 14px; color: #1C84C6; font-weight: bold"> <?php echo $row_familia['dni'] == "" ? "No registra " : $row_familia['dni']; ?> </p>

								<label class="col-md-3"
									   style="font-family: 'Calibri Light'; font-size: 14px;">NOMBRES:</label>
								<p class="col-md-9"
								   style="font-family: 'Calibri Light'; font-size: 14px; color: #1C84C6; font-weight: bold">
									<?php echo $row_familia['nombres'] . " " . $row_familia['ape_pat'] . " " . $row_familia['ape_mat']; ?>
								</p>

								<label class="col-md-3"
									   style="font-family: 'Calibri Light'; font-size: 14px;">CELULAR:</label>
								<p class="col-md-9"
								   style="font-family: 'Calibri Light'; font-size: 14px; color: #1C84C6; font-weight: bold">
									<?php echo $row_familia['celular'] == 0 ? "No registra" : $row_familia['celular']; ?>
								</p>

							</div>
							&nbsp;
						</div>

						<div class="col-sm-1"></div>

						<div class="panel panel-default col-sm-5">

							<br>
							<div class="group-option">
								<label class="col-md-4" style="font-family: 'Calibri Light'; font-size: 14px;">DIRECCIÓN:</label>
								<p class="col-md-8"
								   style="font-family: 'Calibri Light'; font-size: 14px; color: #1C84C6; font-weight: bold"> <?php echo $row_familia['direccion'] == "" ? "No registra" : $row_familia['direccion']; ?> </p>

								<label class="col-md-4"
									   style="font-family: 'Calibri Light'; font-size: 14px;">BARRIO:</label>
								<p class="col-md-8"
								   style="font-family: 'Calibri Light'; font-size: 14px; color: #1C84C6; font-weight: bold">
									<?php echo $row_barrio['barrio'] == "" ? "No registra" : $row_barrio['barrio']; ?>
								</p>

								<label class="col-md-4" style="font-family: 'Calibri Light'; font-size: 14px;">FECHA
									REGISTRO:</label>
								<p class="col-md-8"
								   style="font-family: 'Calibri Light'; font-size: 14px; color: #1C84C6; font-weight: bold">
									<?php echo $row_familia['fecha_registro'] == 0000 ? "No registra" : $row_familia['fecha_registro']; ?>
								</p>

							</div>

							&nbsp;

						</div>

						<br clear="all">
					</div>

				</div>
			</div>
			<br>
			<div class="row">

				<div class="col-md-12">
					<div class="ibox-title ">
						<h3>OBSERVACIONES</h3>
					</div>
					<div class="ibox-content">


						<div class="panel panel-default col-sm-12">

							<br>
							<div class="group-option">
								<p style="font-family: 'Calibri Light'; font-size: 15px; color: #1C84C6; font-weight: bold">
									<?php echo $row_familia['observations']; ?>
								</p>

							</div>

							&nbsp;

						</div>
						<br clear="all">
					</div>
					<div class="ibox-footer"></div>
				</div>


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

				url: '<?php echo base_url() . "admin/estudiante/deleteAll"; ?>',

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
