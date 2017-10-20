<?php 
	
	include_once 'header.php';

	include_once 'dbconfig.php';

	

	if (isset($_POST['btn-del'])) {
		$id = $_POST['id'];

		if ($crud_barang->delete_barang($id)) {
			$msg = "<div class='alert alert-info'>
				<strong> Record was delete successfully ! </strong>
				</div>";

			header("location: delete_barang.php?delete");
		} else {
			$msg = "<div class='alert alert-warning'>
				<strong>Sorry error while delete record !</strong> 
				</div>";
			header("location: delete_barang.php?failure");
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
										if ($_GET['delete']) {
											echo $msg;
										} elseif ($_GET['failure']) {
											echo $msg;
										}
									}
								?>
						 		<div class="form-panel">
						 			<h4 class="mb"><i class="fa fa-angle-right"></i> Form Input</h4>
									<table class="table table-striped table-advance table-hover">
				                        <thead>
				                        <tr>
				                            <th><i class="fa fa-bullhorn"></i> No Resi</th>
				                            <th><i class="fa fa-question-circle"></i> Descrition</th>
				                            <th><i class="fa fa-bookmark"></i> Tanggal</th>
				                            <th>Value</th>
				                            <th>Weight</th>
				                            <th></th>
				                        </tr>
				                        </thead>
				                        <tbody>
				                        <?php

				                        if(isset($_GET['id'])) {
		
											$id = $_GET['id'];
											extract($crud_barang->get_id($id));
										

				                        echo "<td>".$id."</td>
				                        	<td>".$deskripsi."</td>
				                        	<td>".$tanggal."</td>
				                        	<td>".$value."</td>
				                        	<td>".$weight."</td>";

				                        }
				                         ?>
				                      	</tbody>
				                    </table>
				                    <?php
									if(isset($_GET['id']))
									{
										?>
									  	<form method="post">
									    <input type="hidden" name="id" value="<?php echo $id; ?>" />
									    <button class="btn btn-large btn-primary" type="submit" name="btn-del"><i class="glyphicon glyphicon-trash"></i> &nbsp; YES</button>
									    <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; NO</a>
									    </form>  
										<?php
									}
									else
									{
										?>
									    <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
									    <?php
									}
									?>
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
