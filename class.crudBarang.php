<?php 
	
	class crud_barang
	{
		private $db;

		function __construct($DB_con)
		{
			$this->db = $DB_con;
		}

		public function input_barang($id,$deskripsi,$tanggal,$value,$weight) {
			
			try
			{
				$stmt = $this->db->prepare("INSERT INTO barang(id_barang,deskripsi,tanggal,value,weight) VALUES(:id, :deskripsi, :tanggal, :value, :weight)");
				$stmt->bindparam(":id",$id);
				$stmt->bindparam(":deskripsi",$deskripsi);
				$stmt->bindparam(":tanggal",$tanggal);
				$stmt->bindparam(":value",$value);
				$stmt->bindparam(":weight",$weight);
				
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
	                  	    <td>'.$row['id_barang'].'</td>
		                    <td>'.$row['deskripsi'].'</td>
		                    <td>'.$row['tanggal'].'</td>
		                    <td>'.$row['value'].'</td>
		                    <td>'.$row['weight'].'</td>
		                    <td>
		                        <a href="edit_barang.php?id='.$row['id_barang'].'" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
		                        <a href="delete_barang.php?id='.$row['id_barang'].'" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
		                    </td>
	                      </tr>';
				}
			}
		}

		public function get_id($id)
		{
			$stmt = $this->db->prepare("SELECT * FROM barang WHERE id_barang = :id");
			$stmt->bindparam(":id", $id);
			$stmt->execute();
			$editRow = $stmt->fetch(PDO::FETCH_ASSOC);
			return $editRow;
		}

		public function update_barang($id,$deskripsi,$tanggal,$value,$weight)
		{
			try {
				
				$stmt = $this->db->prepare("UPDATE barang SET deskripsi = :deskripsi,
															tanggal = :tanggal,
															value = :value,
															weight = :weight
															 WHERE id_barang = :id ");

				$stmt->bindparam(":deskripsi", $deskripsi);
				$stmt->bindparam(":tanggal", $tanggal);
				$stmt->bindparam(":value", $value);
				$stmt->bindparam(":weight", $weight);
				$stmt->bindparam(":id", $id);
				$stmt->execute();

				return true;

			} catch (Exception $e) {
				echo $e->getMessage();
				return false;
			}
		}

		public function delete_barang($id)
		{
			$stmt = $this->db->prepare("DELETE FROM barang WHERE id_barang = :id");
			$stmt->bindparam(":id",$id);
			$stmt->execute();
			return true;
		}
	}

 ?>