<?php $this->load->view('header'); ?>

<!--  BO :heading -->

<div class="row wrapper border-bottom white-bg page-heading">

	<div class="col-lg-10">

		<h2>Estudiante</h2>

		<ol class="breadcrumb">

			<li>

				<a href="<?php echo base_url() . 'admin/' ?>">Panel de administración</a>

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

				<a href="<?php echo base_url(); ?>admin/estudiantelist/add" class="btn btn-success"><i class="fas fa-plus-circle"></i> NUEVO</a>

				<div class="form-group pull-right">

<!--					<a href="--><?php //echo $csvlink; ?><!--" class="btn btn-success">ENTREGAR</a>-->

					<a href="<?php echo base_url() . "admin/printlistaestudiante/index/estudiantes" ?>" class="btn btn-success" target="_blank">PDF</a>

				</div>
				<br clear="all">
<!--				<form method="GET" action="--><?php //echo base_url() . 'admin/estudiantelist/index'; ?><!--"-->
<!--					  class="form-inline ibox-content">-->
<!---->
<!--					<div class="form-group">-->
<!---->
<!--						<select name="searchBy" class="form-control">-->
<!---->
<!--							<option value="dni" --><?php //echo $searchBy == "dni" ? 'selected="selected"' : ""; ?><!--DNI-->
<!--							</option>-->
<!--							<option-->
<!--								value="nombres" --><?php //echo $searchBy == "nombres" ? 'selected="selected"' : ""; ?><!---->
<!--								Nombres-->
<!--							</option>-->
<!--							<option-->
<!--								value="ape_pat" --><?php //echo $searchBy == "ape_pat" ? 'selected="selected"' : ""; ?><!---->
<!--								Apellido Paterno-->
<!--							</option>-->
<!--							<option-->
<!--								value="ape_mat" --><?php //echo $searchBy == "ape_mat" ? 'selected="selected"' : ""; ?><!---->
<!--								Apellido Materno-->
<!--							</option>-->
<!--							<option-->
<!--								value="institucion.institucion" --><?php //echo $searchBy == "institucion.institucion" ? 'selected="selected"' : ""; ?><!---->
<!--								Institución-->
<!--							</option>-->
<!--							<option-->
<!--								value="nivel.nivel" --><?php //echo $searchBy == "nivel.nivel" ? 'selected="selected"' : ""; ?><!---->
<!--								Nivel-->
<!--							</option>-->
<!--							<option-->
<!--								value="observations" --><?php //echo $searchBy == "observations" ? 'selected="selected"' : ""; ?><!---->
<!--								Observaciones-->
<!--							</option>-->
<!--							<option-->
<!--								value="fecha_registro" --><?php //echo $searchBy == "fecha_registro" ? 'selected="selected"' : ""; ?><!---->
<!--								Fecha Registro-->
<!--							</option>-->
<!--							<option-->
<!--								value="familia.dni" --><?php //echo $searchBy == "familia.dni" ? 'selected="selected"' : ""; ?><!---->
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
<!--							<option value="8" --><?php //echo $per_page == "8" ? 'selected="selected"' : ""; ?><!--8-->
<!--							</option>-->
<!---->
<!--							<option value="16" --><?php //echo $per_page == "16" ? 'selected="selected"' : ""; ?><!--16-->
<!--							</option>-->
<!---->
<!--							<option value="32" --><?php //echo $per_page == "32" ? 'selected="selected"' : ""; ?><!--32-->
<!--							</option>-->
<!---->
<!--							<option value="64" --><?php //echo $per_page == "64" ? 'selected="selected"' : ""; ?><!--64-->
<!--							</option>-->
<!---->
<!--							<option value="124" --><?php //echo $per_page == "124" ? 'selected="selected"' : ""; ?><!--124-->
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

							<!--                     <th><input onclick="toggle(this,'cbgroup1')" id="foo[]" name="foo[]" type="checkbox" value="" /></th>-->

							<th> N°</th>

							<?php $sortSym = isset($_GET["order"]) && $_GET["order"] == "asc" ? "up" : "down"; ?>

							<?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "dni" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>

							<th>
								<a href="<?php echo $fields_links["dni"]; ?>" class="link_css"> DNI </a>
							</th>


							<?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "nombres" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>

							<th>
								<a href="<?php echo $fields_links["nombres"]; ?>" class="link_css"> Nombres
								</a>
							</th>


							<?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "ape_pat" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>

							<th><a href="<?php echo $fields_links["ape_pat"]; ?>" class="link_css">
									Apellido_paterno </a></th>


							<?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "ape_mat" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>

							<th><a href="<?php echo $fields_links["ape_mat"]; ?>" class="link_css">
									Apellido_materno </a></th>


							<?php

							$symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "institucion.institucion" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>


							<th><a href="<?php echo $fields_links["institucion.institucion"]; ?>" class="link_css">
									Institucion </a></th>


							<?php

							$symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "nivel.nivel" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>


							<th><a href="<?php echo $fields_links["nivel.nivel"]; ?>" class="link_css"> Nivel </a>
							</th>


							<?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "observations" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>

<!--							<th><a href="--><?php //echo $fields_links["observations"]; ?><!--" class="link_css">-->
<!--									Observaciones </a></th>-->


							<?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "fecha_registro" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>

<!--							<th><a href="--><?php //echo $fields_links["fecha_registro"]; ?><!--" class="link_css">-->
<!--									Fecha_registro </a></th>-->


							<?php

							$symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "familia.dni" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>


							<th><a href="<?php echo $fields_links["familia.dni"]; ?>" class="link_css">
									DNI_familia </a></th>


							<th> Estud.</th>
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

									<!--                  <th><input name='input' id='del' onclick="callme('show')"  type='checkbox' class='del' value='-->
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

									<!--									<th>--><?php //if (!empty($value->observations)) {
									//											echo $value->observations;
									//										} ?><!--</th>-->

									<!--									<th>--><?php //if (!empty($value->fecha_registro)) {
									//											echo $value->fecha_registro;
									//										} ?><!--</th>-->

									<th><?php if (!empty($value->dni_familia)) {
											echo $value->dni_familia;
										} ?></th>

									<th class="action-width">

										<a href="<?php echo base_url() ?>admin/estudiante/index/dni_familia/<?php echo $value->dni_familia; ?>/1"
										   title="Ver">

											<span class="btn btn-primary ">

												Estudiantes

											</span>

										</a>

									</th>

									<th class="action-width">

										<a href="<?php echo base_url() ?>admin/estudiantelist/view/<?php echo $value->dni; ?>"
										   title="Ver">

											<span class="btn btn-success "><i class="fa fa-eye"></i></span>

										</a>

										<a href="<?php echo base_url() ?>admin/estudiantelist/edit/<?php echo $value->dni; ?>"
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

							echo '<tr><td colspan="100"><h3 align="center" class="text-danger">No hay ningun estudiante en la lista!</center</td></tr>';

						} ?>

						</tbody>


					</table>

				</div>

<!--				--><?php //echo $links; ?>

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

				url: '<?php echo base_url() . "admin/estudiantelist/deleteAll"; ?>',

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
