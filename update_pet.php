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
	
	if(isset($_POST["update_pet"])) {
		if(!empty($_POST['id_vet'])) {
			if($_POST['control'] == 1) {
				$rs9 = mysql_query("UPDATE tb_veterinarys_aso SET id_vet=".$_POST['id_vet']." WHERE id_pet=".$_POST['id_petp']."");
				
				if($rs9){
					$message = "Veterinario cambiado";
				}else {
					$message = "Error al tratar de guardar";
				}
				
			}else if($_POST['control'] == 0) {
				$rs9 = mysql_query("INSERT INTO tb_veterinarys_aso(id_veterinary_aso, id_pet, id_vet) VALUES(NULL, ".$_POST['id_petp'].", ".$_POST['id_vet'].")");
				
				if($rs9){
					$message = "Veterinario actualizado";
				}else {
					$message = "Error al tratar de guardar";
				}
			}
		}else {
			$message = "Debe seleccionar un veterinario";
		}
	}

	echo "<div class='contenedor'>";
	
	if (!empty($message)) {
		echo "<p class=\"error\">" . "Mensaje: ". $message . "</p>";
	}
	
	$rs = mysql_query("SELECT id_pet, name_pet, breed_pet, birthdate_pet, path_pic_pet FROM tb_pets WHERE id_pet = ".$_POST['selected_pet']."");
	
	$numrows = mysql_num_rows($rs);
	
	if($numrows == 0) {
		echo "<h5>No tiene mascotas registradas.</h5>";
	}else {
		echo "<form action='update_pet.php' method='post'>";
			echo "<h2>Seleccionar Veterinario</h2>";
				while($pets = mysql_fetch_row($rs)){
					$edad = date("Y-m-d") - $pets[3];
					echo "<h5>Nombre: $pets[1].</h5>";
					echo "<h5>Edad: $edad años.</h5>";
					echo "<h5>Raza: $pets[2].</h5>";
					$rs2 = mysql_query("SELECT id_veterinary_aso, id_pet, id_vet FROM tb_veterinarys_aso WHERE id_pet = ".$pets[0]."");
					
					$numrows2 = mysql_num_rows($rs2);
					
					if($numrows2  == 0) {
						$nom_vet = "No tiene veterinario asociado";
						$control = 0;
					}else if($numrows2  == 1){
						while($vets = mysql_fetch_row($rs2)){
							
							$rs3 = mysql_query("SELECT name_vet FROM tb_vets WHERE id_vet = ".$vets[2]."");
							$numrows3 = mysql_num_rows($rs3);
			
							while($noms = mysql_fetch_row($rs3)){
								$nom_vet = $noms[0];
								$control = 1;
							}
						}
					}
					
					echo "<h5>Veterinario: $nom_vet.</h5>";
					echo "<input name='id_petp' type='hidden' value=".$pets[0].">";
					echo "<input name='control' type='hidden' value=".$control.">";
					echo "<center><img src='$pets[4]'></center>";
					echo "<select name='id_vet' required>";
					$rs4 = mysql_query("SELECT id_vet, name_vet FROM tb_vets"); 
					while($vets = mysql_fetch_row($rs4)){
						echo "<option value='$vets[0]'>$vets[1]</option>";
					}
					echo "</select>";
					echo "<input name='selected_pet' type='hidden' value=".$pets[0].">";
				}
				echo "<input type='submit' name = 'update_pet' value='Guardar'>";
				echo "<a href='my_pets.php'>Volver</a>";
			echo "</form>";
	}
	include("includes/footer.php");
?>