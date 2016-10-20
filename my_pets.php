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

	echo "<div class='contenedor'>";
	
	if (!empty($message)) {
		echo "<p class=\"error\">" . "Mensaje: ". $message . "</p>";
	}
		
	$rs = mysql_query("SELECT id_pet, name_pet, breed_pet, birthdate_pet, path_pic_pet FROM tb_pets WHERE id_client = ".$id_client."");
			
	$numrows = mysql_num_rows($rs);
	if($numrows == 0) {
		echo "<h5>No tiene mascotas registradas.</h5>";
	}else {
		echo "<form action='update_pet.php' method='post'>";
			echo "<h2>Mis Mascotas</h2>";
				while($pets = mysql_fetch_row($rs)){
					$edad = date("Y-m-d") - $pets[3];
					echo "<h5>Nombre: $pets[1].</h5>";
					echo "<h5>Edad: $edad años.</h5>";
					echo "<h5>Raza: $pets[2].</h5>";
					$rs2 = mysql_query("SELECT id_veterinary_aso, id_pet, id_vet FROM tb_veterinarys_aso WHERE id_pet = ".$pets[0]."");
					
					$numrows2 = mysql_num_rows($rs2);
					
					if(!$numrows2) {
						$nom_vet = "No tiene veterinario asociado";
						$control = 0;
					}else {
						while($vets = mysql_fetch_row($rs2)){
							$id_vet = $vets[0];
							$rs3 = mysql_query("SELECT name_vet FROM tb_vets WHERE id_vet = ".$id_vet."");
							while($noms = mysql_fetch_row($rs3)){
								$nom_vet = $noms[0];
								$control = 1;
							}
						}
					}
					echo "<h5>Veterinario: $nom_vet.</h5>";
					echo "<a href='records_medical_pet.php?id_pet=".$pets[0]."'>Historial Médico</a>";
					
					echo "<input name='id_petp' type='hidden' value=".$pets[0].">";
					echo "<center><img src='$pets[4]'></center>";
					echo "<input name='selected_pet' class='radio' type='radio' value='$pets[0]' required>";

				}
				echo "<input type='submit' name = 'update_pet' value='Seleccionar Veterinario'>";
			echo "</form>";
	}
	include("includes/footer.php");
?>