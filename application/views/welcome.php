<?php $this->load->view('header'); ?>

<?php
require_once('application/models/admin/Query_welcome.php');
//require_once ('application/models/admin/Query_print_familia.php');
?>
<!-- content -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-4">
		<h2>Panel de administración</h2>
	</div>
	<div class="col-sm-8">
		<div class="title-action">
			<!-- <a href="" class="btn btn-primary">This is action area</a> -->
		</div>
	</div>
</div>
<br>
<!--<br clear="all">-->
<!--<div class="wrapper wrapper-content">-->
<!--    <div class="row">-->
<!--        <div class="row">-->
<!--            <br clear="all">-->
<!--            <br clear="all">-->
<!--        </div>-->
<!--        close main row -->
<!--    </div>-->
<!--</div>-->
<!-- content -->


<div class="row">

	<div class="col-lg-6">

		<div class="ibox ">
			<div class="ibox-title">
				<h3>ESTADO DE ENTREGA CHIP</h3>
			</div>
			<div class="form-group ibox-content">
				<div class="col-md-6 " style="color: #65994f;">
					<center>
						<div class="panel panel-default col-sm-12">
							<br>
							<h3>ENTREGADO</h3>
							<i class="fas fa-laugh-beam fa-4x"></i>

							<br>
							<br>
							<div class="col-md-12">
								<div class="panel panel-default">
									<h1>
										<?php
										foreach ($familia_entrega as $item) {
											echo $entregado = $item->num_of_time;
										}
										?>
									</h1>
								</div>
							</div>
						</div>
					</center>
				</div>
				<div class="col-md-6" style="color: #8a0202;">
					<center>
						<div class="panel panel-default col-sm-12">
							<br>
							<h3>NO ENTREGADO</h3>
							<i class="fas fa-sad-cry fa-4x"></i>
							<!--							<i class="fas fa-universal-access fa-4x"></i>-->

							<!--							<i class="fas fa-school "></i>-->
							<br>
							<br>
							<div class="col-md-12">
								<div class="panel panel-default">
									<h1>
										<?php

										$familias = 0;

										foreach ($familia as $row) {
											echo $familias = $row->num_of_time - $entregado;
										}
										?>
										<label class="badge badge-success" style="font-size: 10px; color: #ffffff; background-color: #ec6363">+
											<?php
											foreach ($familia_c as $row) {
												echo $row->num_of_time - $entregado - $familias;
											}
											?>
										</label>
									</h1>
								</div>
							</div>
						</div>
					</center>
				</div>
				<br clear="all">
			</div>
		</div>
	</div>

	<div class="col-lg-6">

		<div class="ibox ">
			<div class="ibox-title">
				<h3>NUMEROS DE BENEFICIARIOS</h3>
			</div>
			<div class="form-group ibox-content">
				<div class="col-md-6 " style="color: #364A5C;">
					<center>
						<div class="panel panel-default col-sm-12">
							<br>
							<h3>ESTUDIANTES</h3>
							<i class="fas fa-user-graduate fa-4x"></i>
							<br>
							<br>
							<div class="col-md-12">
								<div class="panel panel-default">
									<h1>
										<?php
										$estudiantes = 0;
										//echo select_from($conn, 'estudiante')->num_rows;
											foreach ($estudiante as $row) {
												echo $estudiantes = $row->num_of_time;
											}
										?>
										<label class="badge badge-success" style="font-size: 10px; color: #ffffff; background-color: #ec6363">+
											<?php
											//echo select_from($conn, 'estudiante')->num_rows;
											foreach ($estudiante_c as $row) {
												echo $row->num_of_time - $estudiantes;
											}
											?>
										</label>
									</h1>

								</div>
							</div>
						</div>
					</center>
				</div>
				<div class="col-md-6" style="color: #364A5C;">
					<center>
						<div class="panel panel-default col-sm-12">
							<br>
							<h3>FAMILIAS</h3>
							<i class="fas fa-universal-access fa-4x"></i>

							<!--							<i class="fas fa-school "></i>-->
							<br>
							<br>
							<div class="col-md-12">
								<div class="panel panel-default">
									<h1>
										<?php
										$familias = 0;
//										echo select_from($conn, 'familia')->num_rows;
										foreach ($familia as $row) {
											echo $familias = $row->num_of_time;
										}
										?>
										<label class="badge badge-success" style="font-size: 10px; color: #ffffff; background-color: #ec6363">+
											<?php
											//echo select_from($conn, 'estudiante')->num_rows;
											foreach ($familia_c as $row) {
												echo $row->num_of_time - $familias;
											}
											?>
										</label>
									</h1>
								</div>
							</div>
						</div>
					</center>
				</div>
				<br clear="all">
			</div>
		</div>
	</div>
</div>


<div class="row">

	<div class="col-lg-12">

		<div class="ibox ">
			<div class="ibox-title">
				<h3>NIVELES</h3>
			</div>
			<div class="form-group ibox-content">

				<?php
				$font_school = array('fa-university', 'fa-school', 'fa-landmark', 'fa-shapes');
				$i_school = 0;
				$nivel = select_from($conn, 'nivel');
				if ($nivel->num_rows > 0) {
					while ($row = $nivel->fetch_assoc()) {
						?>

						<div class="col-md-3 " style="color: #364A5C; text-align: center;">

							<div class="panel panel-default col-sm-12">
								<br>

								<h3><?php echo $row['nivel'] ?></h3>
								<i class="fas <?php echo $font_school[$i_school] ?> fa-4x"></i>
								<br>
								<br>
								<div class="col-md-12">
									<div class="panel panel-default">
										<h2>
											<?php
											echo select_form_where(
													$conn,
													'estudiante',
													'nivel',
													$row['id_nivel'])->num_rows;
											?>
										</h2>
									</div>
								</div>
							</div>

						</div>

						<?php
						$i_school++;
					}
				}
				?>

				<br clear="all">
			</div>
		</div>
	</div>
</div>

<div class="row">

	<div class="col-lg-12">

		<div class="ibox ">
			<div class="ibox-title">
				<h3>INSTITUCIONES</h3>
			</div>
			<div class="form-group ibox-content">

				<?php
				$nivel = select_from($conn, 'nivel');
				if ($nivel->num_rows > 0) {
					while ($row = $nivel->fetch_assoc()) {
						?>

						<div class="col-md-6">

							<div class="panel-group">
								<div class="panel panel-default">
									<div class="panel-heading"
										 style="background-color: #364A5C; color: white; text-align: center;">
										<span class="panel-title">
											<a data-toggle="collapse" href="#collapse<?php echo $row['id_nivel']; ?>">
												<h2><?php echo $row['nivel']; ?></h2></a>
										</span>
									</div>
									<div id="collapse<?php echo $row['id_nivel']; ?>" class="panel-collapse collapse">
										<ul class="list-group">
											<?php
											$student = select_form_where($conn, 'institucion', 'id_nivel', $row['id_nivel']);
											if ($student->num_rows > 0) {
												while ($row_student = $student->fetch_assoc()) {
													?>
													<li class="list-group-item" style="font-size: 12px;">
														<?php
														echo $row_student['institucion'];
														$total = select_form_where(
																$conn,
																'estudiante',
																'institucion',
																$row_student['id_institucion'])->num_rows;

														$entrgado = select_entregado(
																$conn,
																$row_student['id_institucion']
														)->num_rows
														?>

														<label for=""
															   class="pull-right badge badge-success" style="background-color: #ec6363;">
															<?php echo ($total-$entrgado) <= 0 ? $total-$entrgado : '-'.($total-$entrgado); ?>
														</label>

														<label for=""
															   class="pull-right badge badge-success" style="background-color: #364A5C;">
															<?php echo $total; ?>
														</label>
													</li>
													<?php
												}
											}
											?>
											</li>
										</ul>
										<div class="panel-footer"
											 style="background-color: #364A5C; color: white; text-align: center;">
											<h2>
												<?php echo select_form_where(
														$conn,
														'estudiante',
														"nivel",
														$row['id_nivel'])->num_rows;
												?>

											</h2>
										</div>
									</div>
								</div>
							</div>

						</div>

						<?php
					}
				}
				?>

				<br clear="all">
			</div>
		</div>
	</div>
</div>


<?php $this->load->view('footer'); ?>
