<?php 

  include_once 'header.php';

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
          		   
                  <div class="content-panel">
                    <div class="col-md-12">
                      <a href="add_form.php" class="btn btn-info" type="button" id="btn-add-data"><span class="glyphicon glyphicon-pencil"></span> &nbsp; Add Barang</a>
                      <a class="btn btn-info" type="button" id="btn-view-data"><span class="glyphicon glyphicon-eye-open"></span> &nbsp; View Barang</a>
                    <hr>
                    </div>
                    
                    <table class="table table-striped table-advance table-hover">
                      <hr>
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
                          require_once 'dbconfig.php';

                          $query = "SELECT * FROM barang ORDER BY id_barang";
                          $crud_barang->dataview($query);
                         ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /content-panel -->
              
              </div>
          	</div>
		      </section><!--/wrapper -->
        </section><!-- /MAIN CONTENT -->
      <!--main content end-->

<?php include_once 'footer.php'; ?>