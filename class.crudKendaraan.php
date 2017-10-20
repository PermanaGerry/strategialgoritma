<?php 
	
	class crud_kendaraan
	{
		private $db;

		function __construct($DB_con)
		{
			$this->db = $DB_con;
		}

		public function input_kendaraan($no_plat,$merek_kendaraan,$berat_maksimal) {
			
			try
			{
				$stmt = $this->db->prepare("INSERT INTO kendaraan(no_plat, merek_kendaraan, bobot_maksimal) VALUES(:no_plat, :merek_kendaraan, :berat_maksimal)");
				$stmt->bindparam(":no_plat",$no_plat);
				$stmt->bindparam(":merek_kendaraan",$merek_kendaraan);
				$stmt->bindparam(":berat_maksimal",$berat_maksimal);
				
				if($stmt->execute()) {
					return "Successfully Added";
				} else {
					return "Query Problem";
				}	
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();	
				return false;
			}
			
		}

		public function dataview($query)
		{
			$stmt = $this->db->prepare($query);
			$stmt->execute();

			if ($stmt->rowCount() > 0) {
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					echo '<tr>
	                  	    <td>'.$row['no_plat'].'</td>
		                    <td>'.$row['merek_kendaraan'].' Kg </td>
		                    <td>'.$row['bobot_maksimal'].' Kg </td>
		                    <td>
		                        <a href="edit_kendaraan.php?id='.$row['no_plat'].'" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
		                        <a href="delete_kendaraan.php?id='.$row['no_plat'].'" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
		                    </td>
	                      </tr>';
				}
			}
		}

		public function get_id($id)
		{
			$stmt = $this->db->prepare("SELECT * FROM kendaraan WHERE no_plat = :id");
			$stmt->bindparam(":id", $id);
			$stmt->execute();
			$editRow = $stmt->fetch(PDO::FETCH_ASSOC);
			return $editRow;			
		}

		public function update_kendaraan($no_plat,$merek_kendaraan,$berat_maksimal)
		{
			try {
				
				$stmt = $this->db->prepare("UPDATE kendaraan SET merek_kendaraan = :merek_kendaraan,
															bobot_maksimal = :berat_maksimal
															 WHERE no_plat = :no_plat ");

				$stmt->bindparam(":merek_kendaraan", $merek_kendaraan);
				$stmt->bindparam(":berat_maksimal", $berat_maksimal);
				$stmt->bindparam(":no_plat", $no_plat);
				$stmt->execute();

				return true;

			} catch (Exception $e) {
				echo $e->getMessage();
				return false;
			}
		}

		public function delete_kendaraan($id)
		{
			$stmt = $this->db->prepare("DELETE FROM kendaraan WHERE no_plat = :id");
			$stmt->bindparam(":id",$id);
			$stmt->execute();
			return true;
		}
	}
 ?>