<?php 

	class greedy
	{
		private $db;

		function __construct($DB_con)
		{
			$this->db = $DB_con;
		}

		public function kendaraan($query)
		{
			$stmt = $this->db->prepare($query);
			$stmt->execute();

			if ($stmt->rowCount() > 0) {
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					echo '<option value="'.$row['no_plat'].'">'.$row['no_plat'].'</option>';
				}
			}
		}

		public function get_id($no_plat)
		{
			$stmt = $this->db->prepare("SELECT * FROM kendaraan WHERE no_plat = :id");
			$stmt->bindparam(":id", $no_plat);
			$stmt->execute();
			$editRow = $stmt->fetch(PDO::FETCH_ASSOC);
			return $editRow;			
		}

	}

 ?>