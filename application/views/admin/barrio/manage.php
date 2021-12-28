<?php $this->load->view('header'); ?>

<!--  BO :heading -->

<div class="row wrapper border-bottom white-bg page-heading">

	<div class="col-lg-10">

		<h2>Barrio</h2>

		<ol class="breadcrumb">

			<li>

				<a href="<?php echo base_url() . 'chip-muni/admin/' ?>">Panel de administración</a>

			</li>

			<li class="active">

				<strong>Barrio</strong>

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

				<a href="<?php echo base_url(); ?>admin/barrio/add" class="btn btn-success"><i class="fas fa-plus-circle"></i> NUEVO</a>
				<br>
				<div class="form-group pull-right">

					<!--               <a href="--><?php //echo $csvlink;
					?><!--" class="btn btn-info">CSV</a>-->
					<!---->
					<!--               <a href="--><?php //echo $pdflink;
					?><!--" class="btn btn-info">PDF</a>-->

				</div>

				<form method="GET" action="<?php echo base_url() . 'admin/barrio/index'; ?>"
					  class="form-inline ibox-content">

					<div class="form-group">

						<select name="searchBy" class="form-control">

							<option
								value="barrio" <?php echo $searchBy == "barrio" ? 'selected="selected"' : ""; ?>>
								Barrio
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

							<option value="5" <?php echo $per_page == "5" ? 'selected="selected"' : ""; ?>>5
							</option>

							<option value="10" <?php echo $per_page == "10" ? 'selected="selected"' : ""; ?>>10
							</option>

							<option value="20" <?php echo $per_page == "20" ? 'selected="selected"' : ""; ?>>20
							</option>

							<option value="50" <?php echo $per_page == "50" ? 'selected="selected"' : ""; ?>>50
							</option>

							<option value="100" <?php echo $per_page == "100" ? 'selected="selected"' : ""; ?>>100
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

							<?php $symbol = isset($_GET["sortBy"]) && $_GET["sortBy"] == "barrio" ? "<i class='fa fa-sort-$sortSym' aria-hidden='true'></i>" : "<i class='fa fa-sort' aria-hidden='true'></i>"; ?>

							<th><a href="<?php echo $fields_links["barrio"]; ?>" class="link_css"> Barrio </a></th>


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

								<tr id="hide<?php echo $value->id_barrio; ?>">

<!--									<th><input name='input' id='del' onclick="callme('show')" type='checkbox'-->
<!--											   class='del' value='--><?php //echo $value->id_barrio; ?><!--'/></th>-->


									<th><?php if (!empty($value->id_barrio)) {
											//echo $count;
											echo $value->id_barrio;
											$count++;
										} ?></th>
									<th><?php if (!empty($value->barrio)) {
											echo $value->barrio;
										} ?></th>

									<th class="action-width">

										<a href="<?php echo base_url() ?>admin/barrio/view/<?php echo $value->id_barrio; ?>"
										   title="Ver">

											<span class="btn btn-success "><i class="fa fa-eye"></i></span>

										</a>

										<a href="<?php echo base_url() ?>admin/barrio/edit/<?php echo $value->id_barrio; ?>"
										   title="Editar">

											<span class="btn btn-success "><i class="fa fa-edit"></i></span>

										</a>

										<a title="Eliminar" data-toggle="modal" data-target="#commonDelete"
										   onclick="set_common_delete('<?php echo $value->id_barrio; ?>','barrio');">

											<span class="btn btn-danger "><i class="fa fa-trash "></i></span>

										</a>

									</th>

								</tr>

								<?php

							}


						} else {

							echo '<tr><td colspan="100"><h3 align="center" class="text-danger">No hay nombre de barrios en la lista!</center</td></tr>';

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

				url: '<?php echo base_url() . "admin/barrio/deleteAll"; ?>',

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
