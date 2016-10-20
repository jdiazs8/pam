<?php
	session_start();
	require_once("includes/connection.php");
	
	if(isset($_SESSION["dni_vet"])) {
		if(isset($_POST["rec_med_pet"])) {
			
			$rec_pet = $_POST['rec_pet'];
			$id_veterinary = $_POST['id_veterinary'];
			$date_rec = $_POST['date_rec'];
			$id_pet = $_POST['id_pet'];
			
			$sql = "INSERT INTO tb_historics_pets(id_historics_pet, date_historics_pet, description_historics_pet, id_pet, id_vet, id_veterinary) VALUES(NULL, '$date_rec', '$rec_pet', $id_pet, ".$_SESSION['id_vet'].", $id_veterinary)";
			
			$rs = mysql_query($sql);
			
			header("Location: records_medical_pet.php?id_pet=".$id_pet."");
			
		}
	}
	
?>