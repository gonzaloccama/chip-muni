<?php $this->load->view('header'); ?>
<!--  BO :heading -->
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-sm-4">
    <h2>Estu_observado</h2>
    <ol class="breadcrumb">
      <li>
        <a href="<?php echo base_url().'admin/'?>">Dashboard</a>
      </li>
      <li class="active">
        <strong>Estu_observado</strong>
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
      <div class="ibox-title" >
        <h5>Add <small></small></h5>
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
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <div class="box-body">
              <?php if($this->session->flashdata('message')): ?>
              <div class="alert alert-success">
                <button type="button" class="close" data-close="alert"></button>
                <?php echo $this->session->flashdata('message'); ?>
              </div>
              <?php endif; ?> 
              





	<!-- Codigo Start -->

	<div class="form-group">

	  <label for="codigo" class="col-sm-3 control-label"> Codigo </label>

	  <div class="col-sm-4">

	    <input type="text" class="form-control" id="codigo" name="codigo" 

	    

	    value="<?php echo set_value("codigo"); ?>"

	    >

	  </div>

	  <div class="col-sm-5" >

	 

	    <?php echo form_error("codigo","<span class='label label-danger'>","</span>")?>

	  </div>

	</div> 

	<!-- Codigo End -->





	





	<!-- Dni_f Start -->

	<div class="form-group">

	  <label for="dni_f" class="col-sm-3 control-label"> Dni_f </label>

	  <div class="col-sm-4">

	    <input type="text" class="form-control" id="dni_f" name="dni_f" 

	    

	    value="<?php echo set_value("dni_f"); ?>"

	    >

	  </div>

	  <div class="col-sm-5" >

	 

	    <?php echo form_error("dni_f","<span class='label label-danger'>","</span>")?>

	  </div>

	</div> 

	<!-- Dni_f End -->





	





	<!-- Nombres_f Start -->

	<div class="form-group">

	  <label for="nombres_f" class="col-sm-3 control-label"> Nombres_f </label>

	  <div class="col-sm-4">

	    <input type="text" class="form-control" id="nombres_f" name="nombres_f" 

	    

	    value="<?php echo set_value("nombres_f"); ?>"

	    >

	  </div>

	  <div class="col-sm-5" >

	 

	    <?php echo form_error("nombres_f","<span class='label label-danger'>","</span>")?>

	  </div>

	</div> 

	<!-- Nombres_f End -->





	





	<!-- Dni_e Start -->

	<div class="form-group">

	  <label for="dni_e" class="col-sm-3 control-label"> Dni_e </label>

	  <div class="col-sm-4">

	    <input type="text" class="form-control" id="dni_e" name="dni_e" 

	    

	    value="<?php echo set_value("dni_e"); ?>"

	    >

	  </div>

	  <div class="col-sm-5" >

	 

	    <?php echo form_error("dni_e","<span class='label label-danger'>","</span>")?>

	  </div>

	</div> 

	<!-- Dni_e End -->





	





	<!-- Nombres_e Start -->

	<div class="form-group">

	  <label for="nombres_e" class="col-sm-3 control-label"> Nombres_e </label>

	  <div class="col-sm-4">

	    <input type="text" class="form-control" id="nombres_e" name="nombres_e" 

	    

	    value="<?php echo set_value("nombres_e"); ?>"

	    >

	  </div>

	  <div class="col-sm-5" >

	 

	    <?php echo form_error("nombres_e","<span class='label label-danger'>","</span>")?>

	  </div>

	</div> 

	<!-- Nombres_e End -->





	



	<!-- Institucion Start -->

	<div class="form-group">

        <label class="control-label col-md-3"> Institucion </label>

          <div class="col-md-4">

              <select class="form-control select2" name="institucion" id="institucion">

              <option value="">Select Institucion</option>

      <?php 

      if(isset($institucion) && !empty($institucion)):

      foreach($institucion as $key => $value): ?>

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

	<div class="form-group">

        <label class="control-label col-md-3"> Nivel </label>

          <div class="col-md-4">

              <select class="form-control select2" name="nivel" id="nivel">

              <option value="">Select Nivel</option>

      <?php 

      if(isset($nivel) && !empty($nivel)):

      foreach($nivel as $key => $value): ?>

          <option value="<?php echo $value->id_nivel; ?>">

            <?php echo $value->nivel; ?>

          </option>

      <?php endforeach; ?>

      <?php endif; ?>

      </select>

        </div>

    </div>

      <!-- Nivel End -->









	<!-- Observations Start -->

	<div class="form-group">

	  <label for="observations" class="col-sm-3 control-label"> Observations </label>

	  <div class="col-sm-4">

	    <input type="text" class="form-control" id="observations" name="observations" 

	    

	    value="<?php echo set_value("observations"); ?>"

	    >

	  </div>

	  <div class="col-sm-5" >

	 

	    <?php echo form_error("observations","<span class='label label-danger'>","</span>")?>

	  </div>

	</div> 

	<!-- Observations End -->





	
              <div class="form-group">
                <div class="col-sm-3" >                       
                </div>
                <div class="col-sm-6">
                  <button type="reset" class="btn btn-default ">Reset</button>
                  <button type="submit" class="btn btn-info ">Submit</button>
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