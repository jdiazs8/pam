<?php
	session_start();
	require_once("includes/connection.php");
	if(isset($_SESSION['dni_client'])) {
		include("includes/header_login_client.php");
		$id_client = $_SESSION['id_client'];
	}else if(isset($_SESSION["dni_vet"])) {
		include("includes/header_login_vet.php");
	}else {
		include("includes/header_logout.php");
	}
	
	$message = "";
	
	echo "<div class='contenedor'>";		
		echo "<section class='main'>";
			echo "<form>";
			$rs = mysql_query("SELECT id_pet FROM tb_veterinarys_aso WHERE id_vet = ".$_SESSION['id_vet']."");
			
			$result = mysql_num_rows($rs);
			
			if($result) {
				while($id_pets = mysql_fetch_row($rs)){
					$rs2 = mysql_query("SELECT id_pet, name_pet FROM tb_pets WHERE id_pet = ".$id_pets[0]."");
					while($my_pets = mysql_fetch_row($rs2)){
						echo "<center><a href='records_medical_pet.php?id_pet=".$my_pets[0]."'>$my_pets[1]</a></center><br>";
					}
				}	
			}else {
				$message = "No tiene mascotas asociados.";
			}
			
		echo "</form>"; 
			
		if (!empty($message)) {
			echo "<p class=\"error\">" . "Mensaje: ". $message . "</p>";
		}
	include("includes/footer.php");
?>