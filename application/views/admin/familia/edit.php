<?php $this->load->view('header'); ?>

<!--  BO :heading -->

<div class="row wrapper border-bottom white-bg page-heading">

	<div class="col-sm-4">

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

	<div class="col-sm-8">

		<div class="title-action">

		</div>

	</div>

</div>

<!--  EO :heading -->

<div class="row">

	<div class="wrapper wrapper-content animated fadeInRight">

		<div class="ibox ">

			<div class="ibox-title">

				<h5> ACTUALIZAR <small></small></h5>

				<div class="ibox-tools">

				</div>

			</div>

			<!-- ............................................................. -->

			<!-- BO : content  -->

			<div class="col-sm-12 white-bg ">

				<div class="box box-info">

					<div class="box-header with-border">

						<h3 class="box-title"></h3>

					</div>

					<!-- /.box-header -->

					<!-- form start -->

					<form action="" id="" class="form-horizontal " method="post" enctype="multipart/form-data">

						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
							   value="<?php echo $this->security->get_csrf_hash(); ?>">

						<div class="box-body">

							<?php if ($this->session->flashdata('message')): ?>

								<div class="alert alert-success">

									<button type="button" class="close" data-close="alert"></button>

									<?php echo $this->session->flashdata('message'); ?>

								</div>

							<?php endif; ?>


							<!-- Dni Start -->

							<div class="form-group">

								<label for="dni" class="col-sm-3 control-label"> DNI </label>
								<input type="hidden" class="form-control" id="dni" name="dni" autocomplete="off"


									   value="<?php echo set_value("dni", html_entity_decode($familia->dni)); ?>"

								>

								<div class="col-sm-4">

									<input type="text" class="form-control" id="dni" name="dni"


										   value="<?php echo set_value("dni", html_entity_decode($familia->dni)); ?>" disabled

									>

								</div>

								<div class="col-sm-5">


									<?php echo form_error("dni", "<span class='label label-danger'>", "</span>") ?>

								</div>

							</div>

							<!-- Dni End -->


							<!-- Nombres Start -->

							<div class="form-group">

								<label for="nombres" class="col-sm-3 control-label"> NOMBRES </label>

								<input type="hidden" class="form-control" id="nombres" name="nombres" autocomplete="off"


									   value="<?php echo set_value("nombres", html_entity_decode($familia->nombres)); ?>"

								>


								<div class="col-sm-4">

									<input type="text" class="form-control" id="nombres" name="nombres"


										   value="<?php echo set_value("nombres", html_entity_decode($familia->nombres)); ?>" disabled

									>

								</div>

								<div class="col-sm-5">


									<?php echo form_error("nombres", "<span class='label label-danger'>", "</span>") ?>

								</div>

							</div>

							<!-- Nombres End -->


							<!-- Ape_pat Start -->

							<div class="form-group">

								<label for="ape_pat" class="col-sm-3 control-label"> APELLIDO_PATERNO </label>
								<input type="hidden" class="form-control" id="ape_pat" name="ape_pat" autocomplete="off"


									   value="<?php echo set_value("ape_pat", html_entity_decode($familia->ape_pat)); ?>"

								>

								<div class="col-sm-4">

									<input type="text" class="form-control" id="ape_pat" name="ape_pat"


										   value="<?php echo set_value("ape_pat", html_entity_decode($familia->ape_pat)); ?>" disabled

									>

								</div>

								<div class="col-sm-5">


									<?php echo form_error("ape_pat", "<span class='label label-danger'>", "</span>") ?>

								</div>

							</div>

							<!-- Ape_pat End -->


							<!-- Ape_mat Start -->

							<div class="form-group">

								<label for="ape_mat" class="col-sm-3 control-label"> APELLIDO_MATERNO </label>

								<input type="hidden" class="form-control" id="ape_mat" name="ape_mat"  autocomplete="off"


									   value="<?php echo set_value("ape_mat", html_entity_decode($familia->ape_mat)); ?>"

								>

								<div class="col-sm-4">

									<input type="text" class="form-control" id="ape_mat" name="ape_mat"


										   value="<?php echo set_value("ape_mat", html_entity_decode($familia->ape_mat)); ?>" disabled

									>

								</div>

								<div class="col-sm-5">


									<?php echo form_error("ape_mat", "<span class='label label-danger'>", "</span>") ?>

								</div>

							</div>

							<!-- Ape_mat End -->


							<!-- Direccion Start -->

							<div class="form-group">

								<label for="direccion" class="col-sm-3 control-label"> DIRECCIÓN </label>

								<div class="col-sm-4">

									<input type="text" class="form-control" id="direccion" name="direccion"


										   value="<?php echo set_value("direccion", html_entity_decode($familia->direccion)); ?>"

									>

								</div>

								<div class="col-sm-5">


									<?php echo form_error("direccion", "<span class='label label-danger'>", "</span>") ?>

								</div>

							</div>

							<!-- Direccion End -->


							<!-- Barrio Start -->

							<div class="form-group">

								<label class="control-label col-md-3"> BARRIO </label>

								<div class="col-md-4">

									<select class="form-control select2" name="barrio" id="barrio">

										<option value="">Select Barrio</option>

										<?php

										if (isset($barrio) && !empty($barrio)):

											foreach ($barrio as $key => $value): ?>

												<option
													value="<?php echo $value->id_barrio; ?>" <?php echo $value->id_barrio == $familia->barrio ? 'selected="selected"' : ""; ?>>

													<?php echo $value->barrio; ?>

												</option>

											<?php endforeach; ?>

										<?php endif; ?>

									</select>

								</div>

							</div>

							<!-- Barrio End -->


							<!-- Celular Start -->

							<div class="form-group">

								<label for="celular" class="col-sm-3 control-label"> CELULAR </label>

								<div class="col-sm-4">

									<input type="text" class="form-control" id="celular" name="celular"


										   value="<?php echo set_value("celular", html_entity_decode($familia->celular)); ?>"

									>

								</div>

								<div class="col-sm-5">


									<?php echo form_error("celular", "<span class='label label-danger'>", "</span>") ?>

								</div>

							</div>

							<!-- Celular End -->


							<!-- Fecha_entrega Start -->

<!--							<div class="form-group">-->
<!---->
<!--								<label for="fecha_entrega" class="col-sm-3 control-label"> FECHA_ENTREGA </label>-->
<!---->
<!--								<div class="col-sm-4">-->

									<input type="hidden" class="form-control datetimepicker" name="fecha_entrega"
										   id="fecha_entrega"
										   value="<?php echo set_value("fecha_entrega", $familia->fecha_entrega); ?>"/>

<!--								</div>-->
<!---->
<!--								<div class="col-sm-5">-->
<!---->
<!--									--><?php //echo form_error("fecha_entrega", "<span class='label label-danger'>", "</span>") ?>
<!---->
<!--								</div>-->
<!---->
<!--							</div>-->

							<!-- Fecha_entrega End -->


							<!-- Observations Start -->


							<div class="form-group">

								<label for="observations" class="col-sm-3 control-label"> OBSERVACIONES </label>

								<div class="col-sm-4">

									<textarea class="form-control" id="observations"
											  name="observations"><?php echo set_value("observations", html_entity_decode($familia->observations)); ?></textarea>

								</div>

								<div class="col-sm-5">


									<?php echo form_error("observations", "<span class='label label-danger'>", "</span>") ?>

								</div>

							</div>


							<!-- Observations End -->


							<!-- Fecha_registro Start -->

<!--							<div class="form-group">-->
<!---->
<!--								<label for="fecha_registro" class="col-sm-3 control-label"> FECHA_REGISTRO </label>-->
<!---->
<!--								<div class="col-sm-4">-->

									<input type="hidden" class="form-control datetimepicker" name="fecha_registro"
										   id="fecha_registro"
										   value="<?php echo set_value("fecha_registro", $familia->fecha_registro); ?>"/>

<!--								</div>-->
<!---->
<!--								<div class="col-sm-5">-->
<!---->
<!--									--><?php //echo form_error("fecha_registro", "<span class='label label-danger'>", "</span>") ?>
<!---->
<!--								</div>-->
<!---->
<!--							</div>-->

							<!-- Fecha_registro End -->


							<div class="form-group">

								<div class="col-sm-3">

								</div>

								<div class="col-sm-6">

									<button type="reset" class="btn btn-warning" onclick="history.back()"><i class="fas fa-arrow-circle-left"></i></button>

									<button type="reset" class="btn btn-warning ">LIMPIAR</button>

									<button type="submit" class="btn btn-success ">GUARDAR</button>

								</div>

								<div class="col-sm-3">

								</div>

							</div>

						</div>

						<!-- /.box-body -->

						<div class="box-footer">

						</div>

						<!-- /.box-footer -->

					</form>

				</div>

				<!-- /.box -->

				<br><br><br><br>

			</div>

			<!-- EO : content  -->

			<!-- ...................................................................... -->

		</div>

	</div>

</div>

<?php $this->load->view('footer'); 
