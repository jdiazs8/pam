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
	
	echo "<div class='contenedor'>";
	$message="";
	
?>
	
	<form action="find_veterinarys.php" method="post">
		<h2>Buscar Veterinaria</h2>
		<label>Veterinarias</label>
		<select name="id_zone" required>
			<?php
				$rs = mysql_query("SELECT id_zone, name_zone FROM tb_zones"); 
				while($zones = mysql_fetch_row($rs)){
					echo "<option value='$zones[0]'>$zones[1]</option>";
				}
			?>
		</select>
		<input type="submit" name = "find_veterinary" value="Buscar">
	</form>
	
	<?php
	if(isset($_POST['find_veterinary'])) {
		$id_zone = $_POST['id_zone'];
			
		$rs = mysql_query("SELECT id_veterinary, name_veterinary, nit_veterinary, score_veterinary, votes_veterinary, phone_veterinary, address_veterinary, path_pic_veterinary, id_zone FROM tb_veterinarys WHERE id_zone = ".$id_zone."");
			
		$numrows = mysql_num_rows($rs);
			
		if($numrows == 0) {
			$message = "No hay veterinarias registradas en esta zona.";
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
				echo "<section class='picture_album'>";
					echo "<article>";		
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
						echo "<a href='comments.php?id_pet=".$veterinarys[0]."'>Comentarios</a><br>";
						echo "<img src='$veterinarys[7]'>";
					echo "</article>";
				echo "</section>";
			}
		}
	}	
	
	if (!empty($message)) {
		echo "<p class=\"error\">" . "Mensaje: ". $message . "</p>";
	}
	
	include("includes/footer.php");
	
?>