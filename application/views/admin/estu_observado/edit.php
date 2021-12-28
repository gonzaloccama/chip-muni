<?php $this->load->view('header'); ?>

	<!--  BO :heading -->

	<div class="row wrapper border-bottom white-bg page-heading">

		<div class="col-sm-4">

			<h2>Estudiantes observados</h2>

			<ol class="breadcrumb">

				<li>

					<a href="<?php echo base_url() . 'admin/' ?>">Panel de administración</a>

				</li>

				<li class="active">

					<strong>Estudiantes observados</strong>

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

					<h5> Actualizar <small></small></h5>

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

								<hr>
								<!-- Codigo Start -->


								<input type="hidden" class="form-control" id="codigo" name="codigo" autocomplete="off"

									   value="<?php echo set_value("codigo", html_entity_decode($estu_observado->codigo)); ?>"

								>


								<div class="form-group">

									<label for="codigo" class="col-sm-3 control-label"> Codigo </label>

									<div class="col-sm-4">

										<input type="text" class="form-control" id="codigo" name="codigo" disabled


											   value="<?php echo set_value("codigo", html_entity_decode($estu_observado->codigo)); ?>"

										>

									</div>

									<div class="col-sm-5">


										<?php echo form_error("codigo", "<span class='label label-danger'>", "</span>") ?>

									</div>

								</div>

								<!-- Codigo End -->


								<!-- Dni_f Start -->

								<div class="form-group">

									<label for="dni_f" class="col-sm-3 control-label"> DNI </label>

									<div class="col-sm-4">

										<input type="text" class="form-control" id="dni_f" name="dni_f"


											   value="<?php echo set_value("dni_f", html_entity_decode($estu_observado->dni_f)); ?>"

										>

									</div>

									<div class="col-sm-5">


										<?php echo form_error("dni_f", "<span class='label label-danger'>", "</span>") ?>

									</div>

								</div>

								<!-- Dni_f End -->


								<!-- Nombres_f Start -->


								<input type="hidden" class="form-control" id="nombres_f" name="nombres_f" autocomplete="off"


									   value="<?php echo set_value("nombres_f", html_entity_decode($estu_observado->nombres_f)); ?>"

								>

								<div class="form-group">

									<label for="nombres_f" class="col-sm-3 control-label"> Nombres_por_institución </label>

									<div class="col-sm-4">

										<input type="text" class="form-control" id="nombres_f" name="nombres_f" disabled


											   value="<?php echo set_value("nombres_f", html_entity_decode($estu_observado->nombres_f)); ?>"

										>

									</div>

									<div class="col-sm-5">


										<?php echo form_error("nombres_f", "<span class='label label-danger'>", "</span>") ?>

									</div>

								</div>

								<!-- Nombres_f End -->



								<!-- Nombres Start -->


								<div class="form-group">

									<label for="nombres" class="col-sm-3 control-label"> Nombres </label>

									<div class="col-sm-4">

										<input type="text" class="form-control" id="nombres" name="nombres"


											   value="<?php echo set_value("nombres", html_entity_decode("")); ?>"

										>

									</div>

									<div class="col-sm-5">


										<?php echo form_error("nombres", "<span class='label label-danger'>", "</span>") ?>

									</div>

								</div>

								<!-- Nombres End -->




								<!-- Ape_paterno Start -->


								<div class="form-group">

									<label for="ape_pat" class="col-sm-3 control-label"> Paterno </label>

									<div class="col-sm-4">

										<input type="text" class="form-control" id="ape_pat" name="ape_pat"


											   value="<?php echo set_value("ape_pat", html_entity_decode("")); ?>"

										>

									</div>

									<div class="col-sm-5">


										<?php echo form_error("ape_pat", "<span class='label label-danger'>", "</span>") ?>

									</div>

								</div>

								<!-- Ape_paterno End -->






								<!-- Ape_materno Start -->


								<div class="form-group">

									<label for="ape_mat" class="col-sm-3 control-label"> Materno </label>

									<div class="col-sm-4">

										<input type="text" class="form-control" id="ape_mat" name="ape_mat"


											   value="<?php echo set_value("ape_mat", html_entity_decode("")); ?>"

										>

									</div>

									<div class="col-sm-5">


										<?php echo form_error("ape_mat", "<span class='label label-danger'>", "</span>") ?>

									</div>

								</div>

								<!-- Ape_materno End -->






								<!-- Direccion Start -->


								<div class="form-group">

									<label for="direccion" class="col-sm-3 control-label"> Dirección </label>

									<div class="col-sm-4">

										<input type="text" class="form-control" id="direccion" name="direccion"


											   value="<?php echo set_value("direccion", html_entity_decode("")); ?>"

										>

									</div>

									<div class="col-sm-5">


										<?php echo form_error("direccion", "<span class='label label-danger'>", "</span>") ?>

									</div>

								</div>

								<!-- Direccion End -->



								<!-- Barrio Start -->

								<div class="form-group">

									<label class="control-label col-md-3"> Barrio </label>

									<div class="col-md-4">

										<select class="form-control select1" name="barrio" id="barrio">

											<option value="">Seleccionar Barrio</option>

											<?php

											if (isset($barrio) && !empty($barrio)):

												foreach ($barrio as $key => $value): ?>

													<option value="<?php echo $value->id_barrio; ?>" >

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

									<label for="celular" class="col-sm-3 control-label"> Celular </label>

									<div class="col-sm-4">

										<input type="text" class="form-control" id="celular" name="celular"


											   value="<?php echo set_value("celular", html_entity_decode("")); ?>"

										>

									</div>

									<div class="col-sm-5">


										<?php echo form_error("celular", "<span class='label label-danger'>", "</span>") ?>

									</div>

								</div>

								<!-- Celular End -->




								<hr>
								<!-- Dni_e Start -->

								<input type="hidden" class="form-control" id="dni_e" name="dni_e" autocomplete="off"


									   value="<?php echo set_value("dni_e", html_entity_decode($estu_observado->dni_e)); ?>"

								>


								<div class="form-group">

									<label for="dni_e" class="col-sm-3 control-label"> DNI_Estudiante </label>

									<div class="col-sm-4">

										<input type="text" class="form-control" id="dni_e" name="dni_e" disabled


											   value="<?php echo set_value("dni_e", html_entity_decode($estu_observado->dni_e)); ?>"

										>

									</div>

									<div class="col-sm-5">


										<?php echo form_error("dni_e", "<span class='label label-danger'>", "</span>") ?>

									</div>

								</div>

								<!-- Dni_e End -->


								<!-- Nombres_e Start -->

								<input type="hidden" class="form-control" id="nombres_e" name="nombres_e" autocomplete="off"


									   value="<?php echo set_value("nombres_e", html_entity_decode($estu_observado->nombres_e)); ?>"

								>

								<div class="form-group">

									<label for="nombres_e" class="col-sm-3 control-label"> Nombres_Estudiante </label>

									<div class="col-sm-4">

										<input type="text" class="form-control" id="nombres_e" name="nombres_e" disabled


											   value="<?php echo set_value("nombres_e", html_entity_decode($estu_observado->nombres_e)); ?>"

										>

									</div>

									<div class="col-sm-5">


										<?php echo form_error("nombres_e", "<span class='label label-danger'>", "</span>") ?>

									</div>

								</div>

								<!-- Nombres_e End -->


								<!-- Institucion Start -->

								<div class="form-group">

									<label class="control-label col-md-3"> Institucion </label>

									<div class="col-md-4">

										<select class="form-control select2" name="institucion" id="institucion">

											<option value="">Seleccionar Institucion</option>

											<?php

											if (isset($institucion) && !empty($institucion)):

												foreach ($institucion as $key => $value): ?>

													<option value="<?php echo $value->id_institucion; ?>" <?php echo $value->id_institucion == $estu_observado->institucion ? 'selected="selected"' : ""; ?>>

														<?php echo $value->institucion; ?>

													</option>

												<?php endforeach; ?>

											<?php endif; ?>

										</select>

									</div>

								</div>

								<!-- Institucion End -->


								<!-- Nivel Start -->

								<div class="form-group">

									<label class="control-label col-md-3"> Nivel </label>

									<div class="col-md-4">

										<select class="form-control select2" name="nivel" id="nivel">

											<option value="">Seleccionar Nivel</option>

											<?php

											if (isset($nivel) && !empty($nivel)):

												foreach ($nivel as $key => $value): ?>

													<option value="<?php echo $value->id_nivel; ?>" <?php echo $value->id_nivel == $estu_observado->nivel ? 'selected="selected"' : ""; ?>>

														<?php echo $value->nivel; ?>

													</option>

												<?php endforeach; ?>

											<?php endif; ?>

										</select>

									</div>

								</div>

								<!-- Nivel End -->


								<!-- Observations Start -->

								<input type="hidden" class="form-control" id="observations" name="observations" autocomplete="off"


									   value="<?php echo set_value("observations", html_entity_decode($estu_observado->observations)); ?>"

								>

								<div class="form-group">

									<label for="observations" class="col-sm-3 control-label"> Observaciones </label>

									<div class="col-sm-4">

										<input type="text" class="form-control" id="observations" name="observations" disabled


											   value="<?php echo set_value("observations", html_entity_decode($estu_observado->observations)); ?>"

										>

									</div>

									<div class="col-sm-5">


										<?php echo form_error("observations", "<span class='label label-danger'>", "</span>") ?>

									</div>

								</div>

								<!-- Observations End -->
								<hr>

								<div class="form-group">

									<div class="col-sm-3">

									</div>

									<div class="col-sm-6">
										<a type="reset" class="btn btn-warning" onclick="history.back()">Regresar</a>

										<button type="reset" class="btn btn-primary ">Limpiar</button>

										<button type="submit" class="btn btn-success ">Guardar</button>

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
