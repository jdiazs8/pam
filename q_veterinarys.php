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
	
	$message = "";
	
	if(isset($_POST["find_veterinary"])) {
		$id_veterinary = $_POST['id_veterinary'];
	}
	
	if(isset($_POST["quality_veterinary"])) {
		$q_veterinary = $_POST['q_veterinary'];
				
		$rs = mysql_query("SELECT score_veterinary, votes_veterinary FROM tb_veterinarys WHERE id_veterinary = ".$_POST['id_veterinary']."");
		
		while($datos = mysql_fetch_row($rs)){
			$score = $datos[0];
			$votes = $datos[1];
		}
		
		$score = $score + $q_veterinary;
		$votes++;
		
		$rs = mysql_query("UPDATE tb_veterinarys SET score_veterinary = ".$score.", votes_veterinary = ".$votes." WHERE id_veterinary = ".$_POST['id_veterinary']."");
		
		if($rs) {
			$message = "Ha quedado registrado tu voto.";
		}else {
			$message = "Tuvimos problemas al registrar tu voto.";
		}
		
	}
	
?>

<div class="contenedor">
	<?php
		if (!empty($message)) {
			echo "<p class=\"error\">" . "Mensaje: ". $message . "</p>";
		}
	?>
	
	<form action="q_veterinarys.php" method="post">
		<h2>Seleccionar Veterinaria</h2>
		<label>Veterinarias</label>
		<select name="id_veterinary" required>
			<?php
				$rs = mysql_query("SELECT id_veterinary, name_veterinary FROM tb_veterinarys"); 
				while($veterinarys = mysql_fetch_row($rs)){
					echo "<option value='$veterinarys[0]'>$veterinarys[1]</option>";
				}
			?>
		</select>
		<input type="submit" name = "find_veterinary" value="Buscar">
	</form>
	
	<form action="#" method="post">
		<h2>Veterinarias</h2>
		<?php
			if(!empty($id_veterinary)) {
				$rs = mysql_query("SELECT id_veterinary, name_veterinary, nit_veterinary, score_veterinary, votes_veterinary, phone_veterinary, address_veterinary, path_pic_veterinary, id_zone FROM tb_veterinarys WHERE id_veterinary = ".$id_veterinary."");
				$numrows = mysql_num_rows($rs);
				if($numrows == 0) {
					echo "<h5>No hay veterinarias para calificar.</h5>";
				}else {
					while($veterinarys = mysql_fetch_row($rs)){
						if($veterinarys[3] == 0 || $veterinarys[4] == 0) {
							$promedio = 0;
						}else {
							$promedio = $veterinarys[3]/$veterinarys[4];
						}

						$rs_zone =  mysql_query("SELECT name_zone FROM tb_zones WHERE id_zone = ".$veterinarys[8]."");
		
						while($name_zone = mysql_fetch_row($rs_zone)) {
							$n_zone = $name_zone[0];
						}
						
						echo "<h5>Nombre: $veterinarys[1].</h5>";
						echo "<h5>NIT: $veterinarys[2].</h5>";
						echo "<h5>Teléfono: $veterinarys[5].</h5>";
						echo "<h5>Dirección: $veterinarys[6].</h5>";
						echo "<h5>Localidad: $n_zone.</h5>";
						echo "<h5>"; 
						for($i = 1; $i <= $promedio; $i++) {
							echo "<span class='icon-star-full'></span>";
						}
						
						echo "</h5>";
						echo "<a href='comments.php?id_pet=".$veterinarys[0]."'>Comentarios</a>";
						echo "<center><img src='$veterinarys[7]'></center>";
						echo "<select name='q_veterinary' required>";
							echo "<option value='1'>Malo</option>";
							echo "<option value='2'>Regular</option>";
							echo "<option value='3'>Aceptable</option>";
							echo "<option value='4'>Bueno</option>";
							echo "<option value='5'>Excelente</option>";
						echo "</select>";
						
						echo "<input type='hidden' name='id_veterinary' value='$veterinarys[0]'>";
					}
				}
			}else {
				echo "<h5>Seleccione una veterinaria.</h5>";
			}
			
			
		?>
		<input type="submit" name = "quality_veterinary" value="Calificar">
	</form>
	
<?php
	include("includes/footer.php");
?>