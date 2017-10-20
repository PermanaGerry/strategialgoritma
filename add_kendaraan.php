<?php 
	
	include_once 'header.php';

	include_once 'dbconfig.php';

	if(isset($_POST['btn-save'])) {
		$no_plat			= $_POST['no_plat'];
		$merek_kendaraan	= $_POST['merek_kendaraan'];

		if ($merek_kendaraan == 'Truck Box Engkel Hino Dutro 4 Roda') {
			$berat_maksimal = 4000;
		} elseif ($merek_kendaraan == 'Truck Box dan Wings Box Engkel Hino Dutro 6 Roda') {
			$berat_maksimal = 7000;
		}

		if ($crud_kendaraan->input_kendaraan($no_plat,$merek_kendaraan,$berat_maksimal)) {
			header('location: add_kendaraan.php?inserted');
		} else {
			header('location: add_kendaraan.php?failure');
		}

	}

 ?>

	<!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
        <section id="main-content">
          	<section class="wrapper site-min-height">
          		<h3><i class="fa fa-angle-right"></i> Data Kendaraan </h3>
          	
	            <div class="row mt">
	          		<div class="col-lg-12">
	          		   
						<div class="conten-panel">
						 	<div class="col-md-12">	
								<a href="add_kendaraan.php" class="btn btn-info" type="button" id="btn-add-data"><span class="glyphicon glyphicon-pencil"></span> &nbsp; Add Barang</a>
			                    <a href="kendaraan.php" class="btn btn-info" type="button" id="btn-view-data"><span class="glyphicon glyphicon-eye-open"></span> &nbsp; View Barang</a>
			                	<hr>
						 		<div class="form-panel">
						 			<h4 class="mb"><i class="fa fa-angle-right"></i> Form Input</h4>
									<?php
										if(isset($_GET['inserted']))
										{
											?>
										    <div class="container">
											<div class="alert alert-info">
										    <strong>WOW!</strong> Record was inserted successfully !
											</div>
											</div>
										    <?php
										}
										else if(isset($_GET['failure']))
										{
											?>
										    <div class="container">
											<div class="alert alert-warning">
										    <strong>SORRY!</strong> ERROR while inserting record !
											</div>
											</div>
										    <?php
										}
									?>
									<form class="form-horizontal style-form" method="POST">
										<div class="form-group">
							                <label class="col-sm-2 col-sm-2 control-label">No Plat Kendaraan</label>
							                <div class="col-sm-10">
							                    <input type="text" name="no_plat" class="form-control" placeholder="tidak boleh kosong" required>
							                </div>
						            	</div>
										<div class="form-group">
							                <label class="col-sm-2 col-sm-2 control-label">Merek Kendaraan</label>
							                <div class="col-sm-10">
												<select name="merek_kendaraan" class="form-control">
												  <option value="Truck Box Engkel Hino Dutro 4 Roda">Truck Box Engkel Hino Dutro 4 Roda</option>
												  <option value="Truck Box dan Wings Box Engkel Hino Dutro 6 Roda">Truck Box dan Wings Box Engkel Hino Dutro 6 Roda</option>
												</select>
							                </div>
						            	</div>
										<div class="form-group">
											<div class="col-sm-10">
												<button type="submit" class="btn btn-primary" name="btn-save">Save</button>
											</div>
										</div>
						 			</form>
						 		</div>
						 	</div>
						</div><!-- /content-panel -->
	              
	              	</div>
	          	</div>
		    </section><!--/wrapper -->
        </section><!-- /MAIN CONTENT -->
      <!--main content end-->

<?php 
	
	include_once 'footer.php';

 ?>
