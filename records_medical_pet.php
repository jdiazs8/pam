<?php
	session_start();
	require_once("includes/connection.php");
	if(isset($_SESSION['dni_client'])) {
		include("includes/header_login_client.php");
	}else if(isset($_SESSION["dni_vet"])) {
		include("includes/header_login_vet.php");
	}else {
		include("includes/header_logout.php");
	}
	
	$id_pety = $_GET['id_pet'];
	
	if(isset($_SESSION["dni_vet"])) {
		echo "<form action='rec_mec_pet.php' method='post'>";
		echo "<h2>Registro Médico Vet.</h2>";
		echo "<label>Descripción de la consulta(Max 400 Caracteres)</label>";
		echo "<textarea name='rec_pet' maxlength='350' required></textarea>";
		echo "<label>Veterinaria</label>";
		echo "<select name='id_veterinary' required>";
			$rs = mysql_query("SELECT id_veterinary, name_veterinary FROM tb_veterinarys WHERE id_vet = ".$_SESSION['id_vet'].""); 
			while($veterinarys = mysql_fetch_row($rs)){
				echo "<option value='$veterinarys[0]'>$veterinarys[1]</option>";
			}
		echo "</select>";
		echo "<label>Fecha</label>";
		echo "<input type='date' name='date_rec' required>";
		echo "<input name='id_pet' type='hidden' value='$id_pety'>";  
		echo "<input type='submit' name = 'rec_med_pet' value='Registrar' >";
		echo "</form>";
	}
	
	$query = mysql_query("SELECT * FROM tb_historics_pets WHERE id_pet=".$_GET['id_pet']."");
	$numrows = mysql_num_rows($query);
	
	if($numrows == 0) {
		$message = "No existe historial médico de su mascota.";
	}
	
?>

<div class="contenedor">
	<?php	
		if (!empty($message)) {
			echo "<p class=\"error\">" . "Mensaje: ".$message."<a href='my_pets.php'>Volver.</a></p>";
		}
		
		$query = mysql_query("SELECT name_pet FROM tb_pets WHERE id_pet=".$_GET['id_pet']."");
		$name_pet = mysql_fetch_row($query);
			
		$info = mysql_query("SELECT * FROM tb_historics_pets WHERE id_pet=".$_GET['id_pet']."");
			while($record_pet = mysql_fetch_row($info)){
	?>
	<section class="main">
		<article>
			<?php
				echo "<h5>Nombre: $name_pet[0].</h5>";
				echo "<h5>Fecha: $record_pet[1].</h5>";
				$query = mysql_query("SELECT name_vet FROM tb_vets WHERE id_vet=".$record_pet[4]."");
				$name_vet = mysql_fetch_row($query);
				echo "<h5>Veterinario: $name_vet[0].</h5>";
				$query = mysql_query("SELECT name_veterinary FROM tb_veterinarys WHERE id_veterinary=".$record_pet[5]."");
				$name_veterinary = mysql_fetch_row($query);
				echo "<h5>Veterinaria: $name_veterinary[0].</h5>";
				echo "<p>";
					echo $record_pet[2];
				echo "</p>";
			?>
		</article>
	</section>
<?php
			}
	include("includes/footer.php");
?>