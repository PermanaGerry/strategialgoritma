<?php 
	
	include_once 'header.php';

	include_once 'dbconfig.php';

	if(isset($_GET['id'])) {
		
		$id = $_GET['id'];
		extract($crud_barang->get_id($id));
	}

	if (isset($_POST['btn-edit'])) {
		$id = $_POST['id'];
		$deskripsi = $_POST['deskripsi'];
		$tanggal = $_POST['tanggal'];
		$value = $_POST['value'];
		$weight = $_POST['weight'];

		if ($crud_barang->update_barang($id,$deskripsi,$tanggal,$value,$weight)) {
			$msg = "<div class='alert alert-info'>
				<strong> Record was updated successfully ! </strong>
				</div>";
		} else {
			$msg = "<div class='alert alert-warning'>
				<strong>Sorry error while updating record !</strong> 
				</div>";
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
			                    <a href="index.php" class="btn btn-info" type="button" id="btn-view-data"><span class="fa fa-arrow-left"></span> &nbsp;</a>
			                	<hr>
								<?php
									if(isset($msg))
									{
										echo $msg;
									}
								?>
						 		<div class="form-panel">
						 			<h4 class="mb"><i class="fa fa-angle-right"></i> Form Input</h4>
									<form class="form-horizontal style-form" method="POST">
					                    <input type="hidden" name="id" class="form-control" placeholder="tidak boleh kosong" value="<?php echo $id; ?>">

										<div class="form-group">
							                <label class="col-sm-2 col-sm-2 control-label">Id Barang</label>
							                <div class="col-sm-10">
							                    <input type="text" name="id" class="form-control" placeholder="tidak boleh kosong" value="<?php echo $_GET['id']; ?>" disabled>
							                </div>
						            	</div>
										<div class="form-group">
							                <label class="col-sm-2 col-sm-2 control-label">Deskripsi</label>
							                <div class="col-sm-10">
							                    <input type="text" name="deskripsi" class="form-control" placeholder="tidak boleh kosong" value="<?php echo $deskripsi; ?>" required>
							                </div>
						            	</div>
										<div class="form-group">
							                <label class="col-sm-2 col-sm-2 control-label">Tanggal</label>
							                <div class="col-sm-10">
							                    <input type="date" name="tanggal" class="form-control" placeholder="tidak boleh kosong" value="<?php echo $tanggal; ?>" required>
							                </div>
						            	</div>
										<div class="form-group">
							                <label class="col-sm-2 col-sm-2 control-label">Value</label>
							                <div class="col-sm-10">
							                    <input type="text" name="value" class="form-control" placeholder="tidak boleh kosong" value="<?php echo $value; ?>" required>
							                </div>
						            	</div>
										<div class="form-group">
							                <label class="col-sm-2 col-sm-2 control-label">Weight</label>
							                <div class="col-sm-10">
							                    <input type="text" name="weight" class="form-control" placeholder="tidak boleh kosong" value="<?php echo $weight; ?>" required>
							                </div>
						            	</div>
										<div class="form-group">
											<div class="col-sm-10">
												<button type="submit" class="btn btn-primary" name="btn-edit">Save</button>
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
