<?php $this->load->view('header'); ?>

<!--  BO :heading -->

<div class="row wrapper border-bottom white-bg page-heading">

	<div class="col-sm-4">

		<h2>Estudiante</h2>

		<ol class="breadcrumb">

			<li>

				<a href="<?php echo base_url() . 'admin/' ?>">Panel de administración</a>

			</li>

			<li class="active">

				<strong>Estudiante</strong>

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

				<h5>Agregar <small></small></h5>

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

								<div class="col-sm-4">

									<input type="text" class="form-control" id="dni" name="dni"


										   value="<?php echo set_value("dni"); ?>"

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

								<div class="col-sm-4">

									<input type="text" class="form-control" id="nombres" name="nombres"


										   value="<?php echo set_value("nombres"); ?>"

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

								<div class="col-sm-4">

									<input type="text" class="form-control" id="ape_pat" name="ape_pat"


										   value="<?php echo set_value("ape_pat"); ?>"

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

								<div class="col-sm-4">

									<input type="text" class="form-control" id="ape_mat" name="ape_mat"


										   value="<?php echo set_value("ape_mat"); ?>"

									>

								</div>

								<div class="col-sm-5">


									<?php echo form_error("ape_mat", "<span class='label label-danger'>", "</span>") ?>

								</div>

							</div>

							<!-- Ape_mat End -->


							<!-- Institucion Start -->

							<div class="form-group">

								<label class="control-label col-md-3"> INSTITUCIÓN </label>

								<div class="col-md-4">

									<select class="form-control select2" name="institucion" id="institucion">

										<option value="">Seleccionar Institución</option>

										<?php

										if (isset($institucion) && !empty($institucion)):

											foreach ($institucion as $key => $value): ?>

												<option value="<?php echo $value->id_institucion; ?>">

													<?php echo $value->institucion; ?>

												</option>

											<?php endforeach; ?>

										<?php endif; ?>

									</select>

								</div>

							</div>

							<!-- Institucion End -->


							<!-- Nivel Start -->

							<input type="hidden" class="form-control" id="nivel" name="nivel" autocomplete="off"


								   value="<?php echo set_value("nivel"); ?>"

							>

<!--							<div class="form-group">-->
<!---->
<!--								<label class="control-label col-md-3 pull-left"> NIVEL </label>-->
<!---->
<!--								<div class="col-md-4">-->
<!---->
<!--									<select class="form-control select2" name="nivel" id="nivel">-->
<!---->
<!--										<option value="">Seleccionar Nivel</option>-->
<!---->
<!--										--><?php
//
//										if (isset($nivel) && !empty($nivel)):
//
//											foreach ($nivel as $key => $value): ?>
<!---->
<!--												<option value="--><?php //echo $value->id_nivel; ?><!--">-->
<!---->
<!--													--><?php //echo $value->nivel; ?>
<!---->
<!--												</option>-->
<!---->
<!--											--><?php //endforeach; ?>
<!---->
<!--										--><?php //endif; ?>
<!---->
<!--									</select>-->
<!---->
<!--								</div>-->
<!---->
<!--							</div>-->

							<!-- Nivel End -->


							<!-- Observations Start -->

							<div class="form-group">

								<label for="observations" class="col-sm-3 control-label"> OBSERVACIONES </label>

								<div class="col-sm-4">

									<textarea class="form-control" id="observations"
											  name="observations"><?php echo set_value("observations"); ?></textarea>

								</div>

								<div class="col-sm-5">


									<?php echo form_error("observations", "<span class='label label-danger'>", "</span>") ?>

								</div>

							</div>

							<!-- Observations End -->


							<!-- Fecha_registro Start -->

							<?php
								date_default_timezone_set('America/Lima');

								$date_current = date('Y-m-d H:i:s');
								//echo $date_current;
							?>

							<!--							<div class="form-group">-->

							<!--								<label for="fecha_registro" class="col-sm-3 control-label"> Fecha de registro </label>-->

							<!--								<div class="col-sm-4">-->

							<input type="hidden" class="form-control span2 datepicker" id="fecha_registro"
								   name="fecha_registro"
								   value="<?php echo set_value("fecha_registro", $date_current); ?>">

							<!--								</div>-->

							<!--								<div class="col-sm-5">-->

							<!--									--><?php //echo form_error("fecha_registro", "<span class='label label-danger'>", "</span>") ?>

							<!--								</div>-->

							<!--							</div>-->



<!--							<div class="form-group">-->
<!---->
<!--								<label for="fecha_registro" class="col-sm-3 control-label"> FECHA_REGISTRO </label>-->
<!---->
<!--								<div class="col-sm-4">-->
<!---->
<!--									<input type="hidden" class="form-control datetimepicker" id="fecha_registro"-->
<!--										   name="fecha_registro"/>-->
<!---->
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


							<!-- Dni_familia Start -->

							<div class="form-group">

								<label class="control-label col-md-3"> DNI_FAMILIA </label>

								<div class="col-md-4">

									<select class="form-control select2" name="dni_familia" id="dni_familia">

										<option value="">Seleccionar DNI_familia</option>

										<?php

										if (isset($familia) && !empty($familia)):

											foreach ($familia as $key => $value): ?>

												<option value="<?php echo $value->dni; ?>">

													<?php echo $value->dni; ?>

												</option>

											<?php endforeach; ?>

										<?php endif; ?>

									</select>

								</div>

							</div>

							<!-- Dni_familia End -->


							<div class="form-group">

								<div class="col-sm-3">

								</div>

								<div class="col-sm-6">
									<button type="reset" class="btn btn-warning"
									   onclick="history.back()"><i class="fas fa-arrow-circle-left"></i></button>
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

<?php $this->load->view('footer'); ?>
