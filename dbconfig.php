<?php

	$DB_host = "localhost";
	$DB_user = "root";
	$DB_pass = "mysql";
	$DB_name = "uas_sa";

	try
	{
		$DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
		$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}

	include_once 'class.crudBarang.php';
	include_once 'class.crudKendaraan.php';
	include_once 'rekomendasi.php';

	$crud_barang	= new crud_barang($DB_con);
	$crud_kendaraan = new crud_kendaraan($DB_con);
	$greedy			= new greedy($DB_con);

?>