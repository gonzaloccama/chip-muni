<div class="footer">
    <div class="pull-right">
    </div>
    <div>
        <strong>Copyright ©</strong> MUNICIPALIDAD PROVINCIAL DE CARABAYA <strong><span>by: </span><a target="_blank" href="http://www.onelcn.com">ONELCN</a></strong>
    </div>
</div>
</div>
</div>
<!-- Mainly scripts -->
<script src="<?php echo $this->config->item('accet_url') ?>js/bootstrap.min.js"></script>
<script src="<?php echo $this->config->item('accet_url') ?>js/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo $this->config->item('accet_url') ?>/js/plugins/cropper/cropper.min.js"></script>
<script src="<?php echo $this->config->item('accet_url') ?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo $this->config->item('accet_url') ?>js/plugins/jeditable/jquery.jeditable.js"></script>
<script src="<?php echo $this->config->item('accet_url') ?>js/plugins/dataTables/datatables.min.js"></script>
<!-- Custom and plugin javascript -->

<script type="text/javascript">
	$(document).ready(function() {
		$('#example').DataTable( {
			"language": {
				"sProcessing":     "Procesando...",
				"sLengthMenu":     "Mostrar _MENU_ registros",
				"sZeroRecords":    "No se encontraron resultados",
				"sEmptyTable":     "Ningún dato disponible en esta tabla",
				"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
				"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix":    "",
				"sSearch":         "<Buscar:",
				"sUrl":            "",
				"sInfoThousands":  ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst":    "Primero",
					"sLast":     "Último",
					"sNext":     "Siguiente",
					"sPrevious": "Anterior"
				},
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			},
			"searching": false,
			"lengthChange": false,
			"paging": false,
			stateSave: true

		} );
	} );
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#example2').DataTable( {
			"language": {
				"sProcessing":     "Procesando...",
				"sLengthMenu":     "Mostrar _MENU_ registros",
				"sZeroRecords":    "No se encontraron resultados",
				"sEmptyTable":     "Ningún dato disponible en esta tabla",
				"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
				"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix":    "",
				"sSearch":         "Buscar:",
				"sUrl":            "",
				"sInfoThousands":  ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst":    "Primero",
					"sLast":     "Último",
					"sNext":     "Siguiente",
					"sPrevious": "Anterior"
				},
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			},
			stateSave: true,
			//"paging": false,
		} );
	} );
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#example1').DataTable( {
			"language": {
				"sProcessing":     "Procesando...",
				"sLengthMenu":     "<strong>Mostrar</strong> _MENU_ <strong>registros</strong>",
				"sZeroRecords":    "No se encontraron resultados",
				"sEmptyTable":     "Ningún dato disponible en esta tabla",
				"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
				"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix":    "",
				"sSearch":         "<strong>Buscar:</strong>",
				"sUrl":            "",
				"sInfoThousands":  ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst":    "Primero",
					"sLast":     "Último",
					"sNext":     "Siguiente",
					"sPrevious": "Anterior"
				},
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			},
			stateSave: true,
			//"paging": false,
			"lengthMenu": [ [8, 16, 32, 64, -1], [8, 16, 32, 64, "All"] ],

			//'processing': true,
			//'serverSide': true,
			//'serverMethod': 'post',
			//'ajax': {
			//	'url':"<?php //echo base_url()?>// admin/estudiantelist/studentslist"
			//
			//
			//},
			//'columns': [
			//	{ data: 'dni' },
			//	{ data: 'nombres' },
			//	{ data: 'ape_pat' },
			//	{ data: 'ape_mat' },
			//	{ data: 'institucion' },
			//	{ data: 'nivel' },
			//	{ data: 'dni_familia' }
			//]
		} );
	} );
</script>

<script type="text/javascript">
    $(function () {
        var navMain = $("#nav-main");
        navMain.on("click", "a", null, function () {
            navMain.collapse('hide');
        });
    });
</script>
<script src="<?php echo $this->config->item('accet_url') ?>js/plugins/chosen/chosen.jquery.js"></script>
<script type="text/javascript">
    $(".chosen-select").chosen();

</script>
<script src="<?php echo $this->config->item('accet_url') ?>js/plugins/select2/select2.full.min.js"></script>
<script type="text/javascript">
    $(".select2").select2();

</script>
<script type="text/javascript">
    $(function () {
        window.prettyPrint && prettyPrint();
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
    });
</script>
<script src="<?php echo $this->config->item('accet_url') ?>js/plugins/clockpicker/clockpicker.js"></script>
<script type="text/javascript">
    $('.clockpicker').clockpicker();
</script>
<script src="<?php echo $this->config->item('accet_url') ?>css/plugins/moment-develop/min/moment-with-locales.js"></script>
<script src="<?php echo $this->config->item('accet_url') ?>js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">
    $(function () {
        $(".datetimepicker").datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
    });
</script>
</body>
</html>
