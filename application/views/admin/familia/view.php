<?php $this->load->view('header'); ?>

<!--  BO :heading -->

<div class="row wrapper border-bottom white-bg page-heading">

   <div class="col-sm-4">

      <h2>Familia</h2>

      <ol class="breadcrumb">

         <li>

            <a href="<?php echo base_url().'chip-muni/admin/'?>">Panel de administración</a>

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

   <div class="col-lg-12 row wrapper ">

      <div class="ibox ">

         <div class="ibox-title" >

            <h5>VER <small></small></h5>

            <div class="ibox-tools">                           

            </div>

         </div>

         <!-- ............................................................. -->

         <!-- BO : content  -->

         <div class="col-sm-12 white-bg ">

            <div class="box box-info">

               <div class="box-header with-border">

                  <h3 class="box-title">  </h3>

               </div>

               <!-- /.box-header -->

               <!-- form start -->

               <form action="" id="" class="form-horizontal " method="post" enctype="multipart/form-data">

                  <div class="box-body">

                     <?php if($this->session->flashdata('message')): ?>

                     <div class="alert alert-success">

                        <button type="button" class="close" data-close="alert"></button>

                        <?php echo $this->session->flashdata('message'); ?>

                     </div>

                     <?php endif; ?> 

                     

<table class='table table-bordered' style='width:70%;' align='center'>

	<tr>

	 <td>

	   <label for="dni" class="col-sm-3 control-label"> DNI </label>

	 </td>

	 <td> 

	   <?php echo set_value("dni",html_entity_decode($familia->dni)); ?>

	 </td>

	</tr>

	

	<tr>

	 <td>

	   <label for="nombres" class="col-sm-3 control-label"> NOMBRES </label>

	 </td>

	 <td> 

	   <?php echo set_value("nombres",html_entity_decode($familia->nombres)); ?>

	 </td>

	</tr>

	

	<tr>

	 <td>

	   <label for="ape_pat" class="col-sm-3 control-label"> APELLIDO_PATERNO </label>

	 </td>

	 <td> 

	   <?php echo set_value("ape_pat",html_entity_decode($familia->ape_pat)); ?>

	 </td>

	</tr>

	

	<tr>

	 <td>

	   <label for="ape_mat" class="col-sm-3 control-label"> APELLIDO_MATERNO </label>

	 </td>

	 <td> 

	   <?php echo set_value("ape_mat",html_entity_decode($familia->ape_mat)); ?>

	 </td>

	</tr>

	

	<tr>

	 <td>

	   <label for="direccion" class="col-sm-3 control-label"> DIRECCIÓN </label>

	 </td>

	 <td> 

	   <?php echo set_value("direccion",html_entity_decode($familia->direccion)); ?>

	 </td>

	</tr>

	



    <!-- Barrio Start -->

	<tr>

	 <td>

	  <label class="control-label col-md-3"> BARRIO </label>

	 </td>

	 <td> 

	   <?php 

	      if(isset($barrio) && !empty($barrio)):



	      foreach($barrio as $key => $value): 

	       if($value->id_barrio==$familia->barrio)

	             echo $value->barrio;



	       endforeach; 

	       endif; ?>

	 </td>

	</tr>

    <!-- Barrio End -->



	

	<tr>

	 <td>

	   <label for="celular" class="col-sm-3 control-label"> CELULAR </label>

	 </td>

	 <td> 

	   <?php echo set_value("celular",html_entity_decode($familia->celular)); ?>

	 </td>

	</tr>

	



    <!-- Fecha_entrega Start -->

	<tr>

	 <td>

	  <label for="fecha_entrega" class="col-sm-3 control-label"> FECHA_ENTREGA </label>

	 </td>

	 <td> 

	   <?php echo set_value("fecha_entrega", html_entity_decode($familia->fecha_entrega)); ?>

	 </td>

	</tr>

    <!-- Fecha_entrega End -->



	



    <!-- Observations Start -->

	<tr>

	 <td>

	  <label for="observations" class="col-sm-3 control-label"> OBSERVACIONES </label>

	 </td>

	 <td> 

	   <?php echo set_value("observations",  html_entity_decode($familia->observations)); ?>

	 </td>

	</tr>

    <!-- Observations End -->



	



    <!-- Fecha_registro Start -->

	<tr>

	 <td>

	  <label for="fecha_registro" class="col-sm-3 control-label"> FECHA_REGISTRO </label>

	 </td>

	 <td> 

	   <?php echo set_value("fecha_registro", html_entity_decode($familia->fecha_registro)); ?>

	 </td>

	</tr>

    <!-- Fecha_registro End -->



	<tr><td colspan="2"><a type="reset" class="btn btn-warning pull-right" onclick="history.back()"><i class="fas fa-arrow-circle-left"></i></a></td></tr></table>

                     <div class="form-group">

                        <div class="col-sm-3" >                       

                        </div>

                        <div class="col-sm-6">

                        </div>

                        <div class="col-sm-3" >                       

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
