<?php 

  include_once 'header.php';

  // knapSolveFast2($w4, $v4, sizeof($v4) -1, $bobot_maksimal ,$m,$pickedItems)
  function knapSolveFast2($w, $v, $i, $aW, &$m, &$pickedItems) {
  
    // Return memo if we have one
    if (isset($m[$i][$aW])) {

      return array( $m[$i][$aW], $m['picked'][$i][$aW] );
    
    } else {
   
      // At end of decision branch
      if ($i == 0) {
        if ($w[$i] <= $aW) { // Will this item fit?
          $m[$i][$aW] = $v[$i]; // Memo this item
          $m['picked'][$i][$aW] = array($i); // and the picked item
          return array($v[$i],array($i)); // Return the value of this item and add it to the picked list
   
        } else {
          // Won't fit
          $m[$i][$aW] = 0; // Memo zero
          $m['picked'][$i][$aW] = array(); // and a blank array entry...
          return array(0,array()); // Return nothing
        }
      }
   
      // Not at end of decision branch..
      // Get the result of the next branch (without this one)
      list ($without_i,$without_PI) = knapSolveFast2($w, $v, $i-1, $aW,$m,$pickedItems);

      if ($w[$i] > $aW) { // Does it return too many?
   
        $m[$i][$aW] = $without_i; // Memo without including this one
        $m['picked'][$i][$aW] = array(); // and a blank array entry...
        return array($without_i,array()); // and return it
   
      } else {
   
        // Get the result of the next branch (WITH this one picked, so available weight is reduced)
        list ($with_i,$with_PI) = knapSolveFast2($w, $v, ($i-1), ($aW - $w[$i]),$m,$pickedItems);
        $with_i += $v[$i];  // ..and add the value of this one..
   
        // Get the greater of WITH or WITHOUT
        if ($with_i > $without_i) {
          $res = $with_i;
          $picked = $with_PI;
          array_push($picked,$i);
        } else {
          $res = $without_i;
          $picked = $without_PI;
        }
   
        $m[$i][$aW] = $res; // Store it in the memo
        $m['picked'][$i][$aW] = $picked; // and store the picked item
        return array ($res,$picked); // and then return it
      } 
    }
  }

 ?>
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
        <section id="main-content">
          <section class="wrapper site-min-height">
          	<h3><i class="fa fa-angle-right"></i> Rekomendasi Barang </h3>
          	
            <div class="row mt">
          		<div class="col-lg-12">
          		   
                  <div class="content-panel">
                    <div class="col-md-12">
                    	<form class="form-horizontal style-form" method="POST">
                    		<div class="form-group">
				                <label class="col-sm-2 col-sm-2 control-label">No Plat Kendaraan</label>
  				                <div class="col-sm-10">
                            <select name="no_plat" class="form-control">
                            <?php 
                                require_once 'dbconfig.php';
                                
                                // order to database kendaraan
                                $query = "SELECT * FROM kendaraan ORDER BY no_plat DESC";
                                $greedy->kendaraan($query);
                             ?>  
                            </select>
  				                </div>
			            	    </div>
			            	    <div class="form-group">
          								<div class="col-sm-10">
          									<button type="submit" class="btn btn-primary" name="btn-rekomendasi">Rekomendasi Angkut</button>
          								</div>
      							   </div>
                      </form>
                      <hr>
                    </div>
                  <?php 
                    if (isset($_POST['btn-rekomendasi'])) {
                      $no_plat = $_POST['no_plat'];
                      extract($greedy->get_id($no_plat));
                   ?>
                    <div class="col-sm-10">
                      <p> No Kendaraan     : <?php echo $no_plat; ?></p><br>
                      <p> Merek Kendaraan  : <?php echo $merek_kendaraan; ?></p><br>
                      <p> Bobot Makssimal  : <?php echo $bobot_maksimal; ?></p><br>
                      <h4><i class="fa fa-angle-right"></i>List Barang</h4>
                    </div>
                    <table class="table table-striped table-advance table-hover"> 
                        <thead>
                        <tr>
                            <th>No</th>
                            <th><i class="fa fa-bullhorn"></i> No Resi</th>
                            <th><i class="fa fa-question-circle"></i> Descrition</th>
                            <th><i class="fa fa-bookmark"></i> Tanggal</th>
                            <th>Value</th>
                            <th>Weight</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                                
                                $stmt = $DB_con->prepare("SELECT * FROM barang ORDER BY weight DESC");
                                $stmt->execute();

                                $i=0;
                                while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                                {
                                  $id_barang[$i]  = $row['id_barang'];
                                  $items4[$i]     = $row['deskripsi'];
                                  $tanggal[$i]    = $row['tanggal'];
                                  $w4[$i]         = $row['weight'];
                                  $v4[$i]         = $row['value'];

                                  $i++;
                                }

                                ## Initialize
                                $m = array(); $pickedItems = array();

                                $coba = knapSolveFast2($w4, $v4, sizeof($v4) -1, $bobot_maksimal ,$m,$pickedItems);
                                print_r($coba);

                                ## Solve
                                list ($m4,$pickedItems) = knapSolveFast2($w4, $v4, sizeof($v4) -1, $bobot_maksimal ,$m,$pickedItems);

                                # Display Result 
                                $totalVal = $totalWt = 0;
                                $no = 1;
                                foreach($pickedItems as $key) {
                                  $totalVal += $v4[$key];
                                  $totalWt += $w4[$key];
                                  echo "<tr><td>".$no++."</td><td>".$id_barang[$key]."</td><td>".$items4[$key]."</td><td>".$tanggal[$key]."</td><td>".$v4[$key]."</td><td>".$w4[$key]."</td></tr>";
                                }

                                echo "<br>";
                                  echo "<tr>
                                        <td colspan='4' style='text-align: center;'><b>Total</b></td>
                                        <td>".$totalVal."</td>
                                        <td>".$totalWt."</td>
                                      </tr>";
                              } else {
                                ?>

                      </tbody>
                    </table>
                    <div class="col-sm-10">
                      <p> No Kendaraan     : </p><br>
                      <p> Merek Kendaraan  : </p><br>
                      <p> Bobot Makssimal  : </p><br>
                      <h4><i class="fa fa-angle-right"></i>List Barang</h4>
                    </div>
                    <table class="table table-striped table-advance table-hover"> 
                        <thead>
                        <tr>
                            <th>No</th>
                            <th><i class="fa fa-bullhorn"></i> No Resi</th>
                            <th><i class="fa fa-question-circle"></i> Descrition</th>
                            <th>Value</th>
                            <th>Weight</th>
                        </tr>
                        </thead>
                        <tbody>
                                <?php
                                echo "<tr>
                                      <td></td>
                                      <td></td>
                                      <td>Silahkan Pilih Kendaraan</td>
                                      <td></td>
                                      </tr>";
                              }
                               
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