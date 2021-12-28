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

	<div class="col-lg-12 row wrapper ">

		<div class="ibox ">

			<div class="ibox-title">

				<h5>Ver <small></small></h5>

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

						<div class="box-body">

							<?php if ($this->session->flashdata('message')): ?>

								<div class="alert alert-success">

									<button type="button" class="close" data-close="alert"></button>

									<?php echo $this->session->flashdata('message'); ?>

								</div>

							<?php endif; ?>


							<table class='table table-bordered' style='width:70%;' align='center'>

								<tr>

									<td>

										<label for="codigo" class="col-sm-3 control-label"> Codigo </label>

									</td>

									<td>

										<?php echo set_value("codigo", html_entity_decode($estu_observado->codigo)); ?>

									</td>

								</tr>


								<tr>

									<td>

										<label for="dni_f" class="col-sm-3 control-label"> Dni_f </label>

									</td>

									<td>

										<?php echo set_value("dni_f", html_entity_decode($estu_observado->dni_f)); ?>

									</td>

								</tr>


								<tr>

									<td>

										<label for="nombres_f" class="col-sm-3 control-label"> Nombres_f </label>

									</td>

									<td>

										<?php echo set_value("nombres_f", html_entity_decode($estu_observado->nombres_f)); ?>

									</td>

								</tr>


								<tr>

									<td>

										<label for="dni_e" class="col-sm-3 control-label"> Dni_e </label>

									</td>

									<td>

										<?php echo set_value("dni_e", html_entity_decode($estu_observado->dni_e)); ?>

									</td>

								</tr>


								<tr>

									<td>

										<label for="nombres_e" class="col-sm-3 control-label"> Nombres_e </label>

									</td>

									<td>

										<?php echo set_value("nombres_e", html_entity_decode($estu_observado->nombres_e)); ?>

									</td>

								</tr>


								<!-- Institucion Start -->

								<tr>

									<td>

										<label class="control-label col-md-3"> Institucion </label>

									</td>

									<td>

										<?php

										if (isset($institucion) && !empty($institucion)):


											foreach ($institucion as $key => $value):

												if ($value->id_institucion == $estu_observado->institucion)

													echo $value->institucion;


											endforeach;

										endif; ?>

									</td>

								</tr>

								<!-- Institucion End -->


								<!-- Nivel Start -->

								<tr>

									<td>

										<label class="control-label col-md-3"> Nivel </label>

									</td>

									<td>

										<?php

										if (isset($nivel) && !empty($nivel)):


											foreach ($nivel as $key => $value):

												if ($value->id_nivel == $estu_observado->nivel)

													echo $value->nivel;


											endforeach;

										endif; ?>

									</td>

								</tr>

								<!-- Nivel End -->


								<tr>

									<td>

										<label for="observations" class="col-sm-3 control-label"> Observations </label>

									</td>

									<td>

										<?php echo set_value("observations", html_entity_decode($estu_observado->observations)); ?>

									</td>

								</tr>

								<tr>
									<td colspan="2"><a type="reset" class="btn btn-primary pull-right"
													   onclick="history.back()">Regresar</a></td>
								</tr>
							</table>

							<div class="form-group">

								<div class="col-sm-3">

								</div>

								<div class="col-sm-6">

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
