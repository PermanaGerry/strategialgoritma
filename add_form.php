<?php 
	
	include_once 'header.php';

	include_once 'dbconfig.php';

	if(isset($_POST['btn-save'])) {
		$deskripsi = $_POST['deskripsi'];
		$id = date("ymdhis")."_".rand(0,100);
		$tanggal = $_POST['tanggal'];
		$value = $_POST['value'];
		$weight = $_POST['weight'];

		if($crud_barang->input_barang($id,$deskripsi,$tanggal,$value,$weight)) {
			header("Location: add_form.php?inserted");
		} else {
			header("Location: add_form.php?failure");
		}
	}

 ?>

	<!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
        <section id="main-content">
          	<section class="wrapper site-min-height">
          		<h3><i class="fa fa-angle-right"></i> Data barang </h3>
          	
	            <div class="row mt">
	          		<div class="col-lg-12">
	          		   
						<div class="conten-panel">
						 	<div class="col-md-12">	
								<a href="add_form.php" class="btn btn-info" type="button" id="btn-add-data"><span class="glyphicon glyphicon-pencil"></span> &nbsp; Add Barang</a>
			                    <a href="index.php" class="btn btn-info" type="button" id="btn-view-data"><span class="glyphicon glyphicon-eye-open"></span> &nbsp; View Barang</a>
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
							                <label class="col-sm-2 col-sm-2 control-label">Deskripsi</label>
							                <div class="col-sm-10">
							                    <input type="text" name="deskripsi" class="form-control" placeholder="tidak boleh kosong" required>
							                </div>
						            	</div>
										<div class="form-group">
							                <label class="col-sm-2 col-sm-2 control-label">Tanggal</label>
							                <div class="col-sm-10">
							                    <input type="date" name="tanggal" class="form-control" placeholder="tidak boleh kosong" required>
							                </div>
						            	</div>
										<div class="form-group">
							                <label class="col-sm-2 col-sm-2 control-label">Value</label>
							                <div class="col-sm-10">
							                    <input type="text" name="value" class="form-control" placeholder="tidak boleh kosong" required>
							                </div>
						            	</div>
										<div class="form-group">
							                <label class="col-sm-2 col-sm-2 control-label">Weight</label>
							                <div class="col-sm-10">
							                    <input type="text" name="weight" class="form-control" placeholder="tidak boleh kosong" required>
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
