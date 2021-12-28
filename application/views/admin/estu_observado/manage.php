<?php $this->load->view('header'); ?>

<!--  BO :heading -->

<div class="row wrapper border-bottom white-bg page-heading">

	<div class="col-lg-10">

		<h2>Estudiantes Observados</h2>

		<ol class="breadcrumb">

			<li>

				<a href="<?php echo base_url() . 'admin/' ?>">Panel de administración</a>

			</li>

			<li class="active">

				<strong>Estudiantes Observados</strong>

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
				<!---->
				<!--            <a href="-->
				<?php //echo base_url(); ?><!--admin/estu_observado/add" class="btn btn-success">ADD NEW</a>-->
				<!---->
				<div class="form-group pull-right">

					<!--               <a href="--><?php //echo $csvlink; ?><!--" class="btn btn-info">CSV</a>-->

					<!--               <a href="--><?php //echo $pdflink; ?><!--" class="btn btn-info">PDF</a>-->
					<a href="<?php echo base_url() . "admin/printlistaobservado/index/observado" ?>"
					   class="btn btn-success" target="_blank">OBSERVADOS</a>
				</div>

				<form method="GET" action="<?php echo base_url() . 'admin/estu_observado/index'; ?>"
					  class="form-inline ibox-content">

					<div class="form-group">

						<select name="searchBy" class="form-control">

							<option value="codigo" <?php echo $searchBy == "codigo" ? 'selected="selected"' : ""; ?>>
								Codigo
							</option>
							<option value="dni_f" <?php echo $searchBy == "dni_f" ? 'selected="selected"' : ""; ?>>
								Dni_f
							</option>
							<option value="nombres_f" <?php echo $searchBy == "nombres_f" ? 'selected="selected"' : ""; ?>>
								Nombres_f
							</option>
							<option value="dni_e" <?php echo $searchBy == "dni_e" ? 'selected="selected"' : ""; ?>>
								Dni_e
							</option>
							<option value="nombres_e" <?php echo $searchBy == "nombres_e" ? 'selected="selected"' : ""; ?>>
								Nombres_e
							</option>
							<option value="institucion.institucion" <?php echo $searchBy == "institucion.institucion" ? 'selected="selected"' : ""; ?>>
								Institucion
							</option>
							<option value="nivel.nivel" <?php echo $searchBy == "nivel.nivel" ? 'selected="selected"' : ""; ?>>
								Nivel
							</option>
							<option value="observations" <?php echo $searchBy == "observations" ? 'selected="selected"' : ""; ?>>
								Observations
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

							<option value="8" <?php echo $per_page == "8" ? 'selected="selected"' : ""; ?>>8</option>

							<option value="16" <?php echo $per_page == "16" ? 'selected="selected"' : ""; ?>>16</option>

							<option value="32" <?php echo $per_page == "32" ? 'selected="selected"' : ""; ?>>32</option>

							<option value="64" <?php echo $per_page == "64" ? 'selected="selected"' : ""; ?>>64</option>

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

							<th> Sr No.</th>

							<?php $sortSym = isset($_GET["order"]) && $_GET["order"] == "asc" ? "up" : "down"; ?>

							<?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "codigo" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>

							<th><a href="<?php echo $fields_links["codigo"]; ?>" class="link_css">
									Codigo <?php echo $symbol ?></a></th>


							<?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "dni_f" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>

							<th><a href="<?php echo $fields_links["dni_f"]; ?>" class="link_css">
									Dni_f <?php echo $symbol ?></a></th>


							<?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "nombres_f" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>

							<th><a href="<?php echo $fields_links["nombres_f"]; ?>" class="link_css">
									Nombres_f <?php echo $symbol ?></a></th>


							<?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "dni_e" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>

							<th><a href="<?php echo $fields_links["dni_e"]; ?>" class="link_css">
									Dni_e <?php echo $symbol ?></a></th>


							<?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "nombres_e" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>

							<th><a href="<?php echo $fields_links["nombres_e"]; ?>" class="link_css">
									Nombres_e <?php echo $symbol ?></a></th>


							<?php

							$symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "institucion.institucion" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>


							<th><a href="<?php echo $fields_links["institucion.institucion"]; ?>" class="link_css">
									Institucion <?php echo $symbol ?></a></th>


							<?php

							$symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "nivel.nivel" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>


							<th><a href="<?php echo $fields_links["nivel.nivel"]; ?>" class="link_css">
									Nivel <?php echo $symbol ?></a></th>


							<?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "observations" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>

							<th><a href="<?php echo $fields_links["observations"]; ?>" class="link_css">
									Observations <?php echo $symbol ?></a></th>


							<th> Action</th>

						</tr>

						</thead>

						<tbody>

						<?php if (isset($results) and !empty($results)) {


							$count = 1;


							?>

							<?php

							foreach ($results as $key => $value) {


								?>

								<tr id="hide<?php echo $value->codigo; ?>">

									<!--                  <th><input name='input' id='del' onclick="callme('show')"  type='checkbox' class='del' value='-->
									<?php //echo $value->codigo; ?><!--'/></th>-->


									<th><?php if (!empty($value->codigo)) {
											echo $count;
											$count++;
										} ?></th>
									<th><?php if (!empty($value->codigo)) {
											echo $value->codigo;
										} ?></th>

									<th><?php if (!empty($value->dni_f)) {
											echo $value->dni_f;
										} ?></th>

									<th><?php if (!empty($value->nombres_f)) {
											echo $value->nombres_f;
										} ?></th>

									<th><?php if (!empty($value->dni_e)) {
											echo $value->dni_e;
										} ?></th>

									<th><?php if (!empty($value->nombres_e)) {
											echo $value->nombres_e;
										} ?></th>

									<th><?php if (!empty($value->institucion)) {
											echo $value->institucion;
										} ?></th>

									<th><?php if (!empty($value->nivel)) {
											echo $value->nivel;
										} ?></th>

									<th><?php if (!empty($value->observations)) {
											echo $value->observations;
										} ?></th>

									<th class="action-width">

										<a href="<?php echo base_url() ?>admin/estu_observado/view/<?php echo $value->codigo; ?>"
										   title="VER">

											<span class="btn btn-success "><i class="fa fa-eye"></i></span>

										</a>

										<a href="<?php echo base_url() ?>admin/estu_observado/edit/<?php echo $value->codigo; ?>"
										   title="EDITAR">

											<span class="btn btn-success "><i class="fa fa-edit"></i></span>

										</a>

										<a title="Eliminar" data-toggle="modal" data-target="#commonDelete"
										   onclick="set_common_delete('<?php echo $value->codigo; ?>','estu_observado');">

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

				url: '<?php echo base_url() . "admin/estu_observado/deleteAll"; ?>',

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
