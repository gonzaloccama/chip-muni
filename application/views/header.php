<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> CHIP MUNI </title>
	<link href="<?php echo $this->config->item('accet_url') ?>css/plugins/select2/select2.min.css" rel="stylesheet">
	<script src="<?php echo $this->config->item('accet_url') ?>js/jquery-2.1.1.min.js"></script>
	<script src="<?php echo $this->config->item('accet_url') ?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo $this->config->item('accet_url') ?>js/app.js"></script>
	<script src="<?php echo $this->config->item('accet_url') ?>js/plugins/pace/pace.min.js"></script>
	<link href="<?php echo $this->config->item('accet_url') ?>css/plugins/chosen/chosen.css" rel="stylesheet">
	<link href="<?php echo $this->config->item('accet_url') ?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo $this->config->item('accet_url') ?>font-awesome/css/all.css" rel="stylesheet">
	<!-- Toastr style -->
	<link href="<?php echo $this->config->item('accet_url') ?>css/plugins/toastr/toastr.min.css" rel="stylesheet">
	<!-- Gritter -->
	<link href="<?php echo $this->config->item('accet_url') ?>js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
	<link href="<?php echo $this->config->item('accet_url') ?>css/animate.css" rel="stylesheet">
	<link href="<?php echo $this->config->item('accet_url') ?>css/style.css" rel="stylesheet">
	<link href="<?php echo $this->config->item('accet_url') ?>css/plugins/dataTables/datatables.min.css"
		  rel="stylesheet">
	<!-- Date Picker-->
	<link href="<?php echo base_url() ?>accets/datepicker/datepicker.css" rel="stylesheet">
	<script src="<?php echo base_url() ?>accets/datepicker/bootstrap-datepicker.js"></script>
	<link href="<?php echo $this->config->item('accet_url') ?>css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
	<script src="<?php echo $this->config->item('accet_url') ?>js/recordDel.js"></script>
	<link href="<?php echo $this->config->item('accet_url') ?>css/bootstrap-datetimepicker.css" rel="stylesheet">
</head>
<body>
<div id="wrapper">
	<nav class="navbar-default navbar-static-side" role="navigation">
		<div class="sidebar-collapse">
			<ul class="nav metismenu" id="side-menu">
				<img class="center-block" style="padding-bottom: 10px;padding-top: 10px;"
					 src="<?php echo $this->config->item('accet_url') ?>img/Escudo_de_Macusani.png" alt="" width="50px">
				<li class="nav-header">
					<div class="dropdown profile-element">
                                <span>
                                    <center>
                                        <h2>
                                            <b>
        <script language="JavaScript1.2">
            var message = "INTERNET CHIP"
			var neonbasecolor = "white"
			var neontextcolor = "green"
			var flashspeed = 150  //in milliseconds
			///No need to edit below this line/////
			var n = 0
			if (document.all || document.getElementById) {
				document.write('<font color="' + neonbasecolor + '">')
				for (m = 0; m < message.length; m++)
					document.write('<span id="neonlight' + m + '">' + message.charAt(m) + '</span>')
				document.write('</font>')
			} else
				document.write(message)

			function crossrefaa(number) {
				var crossobj = document.all ? eval("document.all.neonlight" + number) : document.getElementById("neonlight" + number)
				return crossobj
			}

			function neonaa() {
				//Change all letters to base color
				if (n == 0) {
					for (m = 0; m < message.length; m++)
							//eval("document.all.neonlight"+m).style.color=neonbasecolor
						crossrefaa(m).style.color = neonbasecolor
				}
				//cycle through and change individual letters to neon color
				crossrefaa(n).style.color = neontextcolor
				if (n < message.length - 1)
					n++
				else {
					n = 0
					clearInterval(flashing)
					setTimeout("beginneonaa();", 1500)
					return
				}
			}

			function beginneonaa() {
				if (document.all || document.getElementById)
					flashing = setInterval("neonaa();", flashspeed)
			}

			beginneonaa();
        </script>
        <script>
            function set_common_delete(id, table_name) {
				$("#set_commondel_id").val(id);
				$("#table_name").val(table_name);
			}

			function delete_return() {
				del_id = $("#set_commondel_id").val();
				table_name = $("#table_name").val();
				$.ajax({
					url: "<?php echo base_url(); ?>admin/" + table_name + "/delete/" + del_id,
					data: "id=" + del_id + "&table_name=" + table_name + "&<?php echo $this->security->get_csrf_token_name(); ?>=" + '<?php echo $this->security->get_csrf_hash(); ?>',
					type: "post",
					success: function (result) {
						if (result.trim() == "success") {
							$('#commonDelete').modal('toggle');
							$("#hide" + del_id).hide();
						}
					},
					error: function (output) {
					}
				});
			}
        </script>
                                            </b>
                                        </h2>
                                    </center>
                                </span>
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span class="clear"> 
                                        <span class="block m-t-xs">
                                            <strong class="font-bold">
                                                <!-- TRADE TEAMS --> 
                                            </strong>
                                        </span>
						</a>
					</div>
					<div class="logo-element">
						CI
					</div>
				</li>
				<!-- BO : left nav  -->
				<?php
				$contr = $this->uri->segment(2);
				$action = $this->uri->segment(3);
				$actionNext = $this->uri->segment(4);
				if (!empty($action)) {
					$module = $contr . '/' . $action;
					if (!empty($actionNext)) {
						$module = $contr . '/' . $action . '/' . $actionNext;
					}
				} else {
					$module = $contr;
				}
				$contrnew = $contr . '/' . $action;
				?>
				<!-- BO : dashboard -->
				<li <?php if ($contr == '') { ?>class="active "<?php } ?>>
					<a href="<?php echo base_url() . 'admin' ?>"><i class="fa fa-home"></i><span class="title">Panel de administración</span>
						<?php if ($module == '') { ?><span class="selected"></span><?php } ?>
					</a>
				</li>
				<!-- EO : dashboard -->

				<!--                 BO : Modules-->
				<!--                <li  --><?php //if ($contr == 'module') { ?><!--class="active "-->
				<?php //} ?><!--  >-->
				<!--                    <a href="-->
				<?php //echo base_url() ?><!--admin/module/add"><i class="fa fa-users"></i><span class="title">Generate Module</span>-->
				<!--                        -->
				<?php //if ($contr == 'module') { ?><!--<span class="selected"></span>--><?php //} ?>
				<!--                        <span class="arrow --><?php //if ($contr == 'module') { ?><!--open-->
				<?php //} ?><!--"></span>-->
				<!--                    </a>-->
				<!--                </li>-->
				<!--  EO : Modules -->


				<!-- BO : Estudiante -->

				<li <?php if ($contr == 'estudiante'){ ?>class="active "<?php } ?> >

					<a href="javascript:;"><i class="fas fa-graduation-cap"></i><span class="title">Estudiante</span>

						<?php if ($contr == 'estudiante') { ?><span class="selected"></span><?php } ?>

						<span class="arrow <?php if ($contr == 'estudiante') { ?>open<?php } ?>"></span>

					</a>

					<ul class="nav nav-second-level">

						<li <?php if ($contrnew == 'estudiantelist/add'){ ?>class="active "<?php } ?>>

							<a href="<?php echo base_url() ?>admin/estudiantelist/add"><i
										class="fa fa-angle-double-right">

								</i>Agregar</a>

						</li>

						<li <?php if ($contrnew == 'estudiantelist/'){ ?>class="active"<?php } ?>>

							<a href="<?php echo base_url() ?>admin/estudiantelist/index"><i
										class="fas fa-toolbox"></i></i>Administrar</a>

						</li>

					</ul>

				</li>

				<!--  EO : Estudiante -->


				<!-- BO : Familia -->

				<li <?php if ($contr == 'familia'){ ?>class="active "<?php } ?> >

					<a href="javascript:;"><i class="fas fa-street-view"></i></i><span class="title">Familia</span>

						<?php if ($contr == 'familia') { ?><span class="selected"></span><?php } ?>

						<span class="arrow <?php if ($contr == 'familia') { ?>open<?php } ?>"></span>

					</a>

					<ul class="nav nav-second-level">

						<li <?php if ($contrnew == 'familia/add'){ ?>class="active "<?php } ?>>

							<a href="<?php echo base_url() ?>admin/familia/add"><i class="fa fa-angle-double-right">

								</i>Agregar</a>

						</li>

						<li <?php if ($contrnew == 'familia/'){ ?>class="active"<?php } ?>>

							<a href="<?php echo base_url() ?>admin/familia/index"><i class="fas fa-toolbox"></i></i>
								Administrar</a>

						</li>

					</ul>

				</li>

				<!--  EO : Familia -->


				<!-- BO : Barrio -->

				<li <?php if ($contr == 'barrio'){ ?>class="active "<?php } ?> >

					<a href="javascript:;"><i class="fas fa-city"></i><span class="title">Barrio</span>

						<?php if ($contr == 'barrio') { ?><span class="selected"></span><?php } ?>

						<span class="arrow <?php if ($contr == 'barrio') { ?>open<?php } ?>"></span>

					</a>

					<ul class="nav nav-second-level">

						<li <?php if ($contrnew == 'barrio/add'){ ?>class="active "<?php } ?>>

							<a href="<?php echo base_url() ?>admin/barrio/add"><i class="fa fa-angle-double-right">

								</i>Agregar</a>

						</li>

						<li <?php if ($contrnew == 'barrio/'){ ?>class="active"<?php } ?>>

							<a href="<?php echo base_url() ?>admin/barrio/index"><i class="fas fa-toolbox"></i></i>
								Administrar</a>

						</li>

					</ul>

				</li>

				<!--  EO : Barrio -->


				<!-- BO : Institucion -->

				<li <?php if ($contr == 'institucion'){ ?>class="active "<?php } ?> >

					<a href="javascript:;"><i class="fas fa-school"></i></i></i><span class="title">Institucion</span>

						<?php if ($contr == 'institucion') { ?><span class="selected"></span><?php } ?>

						<span class="arrow <?php if ($contr == 'institucion') { ?>open<?php } ?>"></span>

					</a>

					<ul class="nav nav-second-level">

						<li <?php if ($contrnew == 'institucion/add'){ ?>class="active "<?php } ?>>

							<a href="<?php echo base_url() ?>admin/institucion/add"><i class="fa fa-angle-double-right">

								</i>Agregar</a>

						</li>

						<li <?php if ($contrnew == 'institucion/'){ ?>class="active"<?php } ?>>

							<a href="<?php echo base_url() ?>admin/institucion/index"><i class="fas fa-toolbox"></i></i>
								Administrar</a>

						</li>

					</ul>

				</li>

				<!--  EO : Institucion -->


				<!-- BO : Nivel -->

				<!--                <li --><?php //if($contr == 'nivel'){?><!--class="active "--><?php //} ?><!--  >-->
				<!---->
				<!--                    <a href="javascript:;"><i class="fa fa-users"></i><span class="title">Nivel</span>-->
				<!---->
				<!--                        -->
				<?php //if($contr == 'nivel'){?><!--<span class="selected"></span>--><?php //} ?>
				<!---->
				<!--                      <span class="arrow --><?php //if($contr == 'nivel'){?><!--open-->
				<?php //} ?><!--"></span>-->
				<!---->
				<!--                    </a>-->
				<!---->
				<!--                    <ul class="nav nav-second-level">-->
				<!---->
				<!--                      <li --><?php //if($contrnew == 'nivel/add'){?><!--class="active "--><?php //} ?>
				<!---->
				<!--                        <a href="-->
				<?php //echo base_url()?><!--admin/nivel/add"><i class="fa fa-angle-double-right">-->
				<!---->
				<!--                            </i>Add Nivel</a>-->
				<!---->
				<!--                      </li>-->
				<!---->
				<!--                      <li --><?php //if($contrnew == 'nivel/'){?><!--class="active"--><?php //} ?>
				<!---->
				<!--                        <a href="-->
				<?php //echo base_url()?><!--admin/nivel/index"><i class="fa fa-gear"></i>Manage Nivel</a>-->
				<!---->
				<!--                      </li>                       -->
				<!---->
				<!--                    </ul>-->
				<!---->
				<!--                </li>-->

				<!--  EO : Nivel -->


				<!-- BO : Estu_observado -->

				<li <?php if ($contr == 'estu_observado'){ ?>class="active "<?php } ?> >

					<a href="javascript:;"><i class="fa fa-users"></i><span class="title">Observados</span>

						<?php if ($contr == 'estu_observado') { ?><span class="selected"></span><?php } ?>

						<span class="arrow <?php if ($contr == 'estu_observado') { ?>open<?php } ?>"></span>

					</a>

					<ul class="nav nav-second-level">

						<!--                      <li -->
						<?php //if($contrnew == 'estu_observado/add'){?><!--class="active "--><?php //} ?><!---->
						<!---->
						<!--                        <a href="-->
						<?php //echo base_url()?><!--admin/estu_observado/add"><i class="fa fa-angle-double-right">-->
						<!---->
						<!--                            </i>Add Estu_observado</a>-->
						<!---->
						<!--                      </li>-->

						<li <?php if ($contrnew == 'estu_observado/'){ ?>class="active"<?php } ?>>

							<a href="<?php echo base_url() ?>admin/estu_observado/index"><i
										class="fas fa-toolbox"></i></i>Administrar</a>
							</a>

						</li>

					</ul>

				</li>

				<!--  EO : Estu_observado -->


				<!--  @@@@@#####@@@@@ -->


				<!--                <li><a href="-->
				<?php //echo $this->config->item('left_url') ?><!--password"><i class="fa fa-users"></i><span class="title">Cambiar contraseña</span></a></li>-->
				<li><a href="<?php echo $this->config->item('left_url') ?>auth/logout"><i
								class="fas fa-sign-out-alt"></i><span class="title">Cerrar sesión</span></a></li>
			</ul>
		</div>
	</nav>
	<div id="page-wrapper" class="gray-bg dashbard-1">
		<div class="row border-bottom">
			<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
				<div class="navbar-header">
					<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i>
					</a>
				</div>
				<ul class="nav navbar-top-links navbar-right">
					<li>
                                <span class="m-r-sm text-muted welcome-message">Bienvenido <?php
									if (isset($username) and !empty($username)) {
										echo $username;
									}
									?> </span>
					</li>
					<li class="dropdown">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span class="clear"> 
                                        <span class="text-muted text-xs block">
                                            <img src="<?php echo $this->config->item('accet_url') ?>img/user.png"
												 class="img-circle" alt="User Image" width="20px">
                                        </span> 
                                    </span>
						</a>
						<span>
                                </span>
						<ul class="dropdown-menu animated fadeInRight m-t-xs">
							 <li><a href="<?php echo $this->config->item('left_url') ?>admin/profile/edit">Profile</a></li>
							                                    <li><a href="
							<?php echo $this->config->item('left_url') ?>password">Cambiar contraseña </a></li>
							                                    <li class="divider"></li>
							<li><a href="<?php echo $this->config->item('left_url') ?>auth/logout">Cerrar sesión</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
		</div>
		<!-- Common Delete Popup  -->
		<div class="modal fade" id="commonDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
			 aria-hidden="true">
			<form action="<?php echo base_url() ?>welcome/delete_notification/" method="post">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
					   value="<?php echo $this->security->get_csrf_hash(); ?>">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span
										aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
							<h4 class="modal-title" id="frm_title">Eliminar</h4>
						</div>
						<div class="modal-body" id="frm_body">
							¿Realmente quieres eliminar?
							<input type="hidden" id="set_commondel_id">
							<input type="hidden" id="table_name">
						</div>
						<div class="modal-footer">
							<button style='margin-left:10px;' type="button" class="btn btn-primary col-sm-2 pull-right"
									id="frm_submit" onclick="delete_return();">Si
							</button>
							<button type="button" class="btn btn-danger col-sm-2 pull-right" data-dismiss="modal"
									id="frm_cancel">No
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
		<!-- ./ Common Delete Popup /. -->
