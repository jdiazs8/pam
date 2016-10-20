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
?>

<div class="contenedor">
	<form action="#" method="post">
		<h2>Mis Veterinarias</h2>
		<?php
			$rs = mysql_query("SELECT id_veterinary, name_veterinary, nit_veterinary, score_veterinary, votes_veterinary, phone_veterinary, address_veterinary, path_pic_veterinary, id_zone FROM tb_veterinarys WHERE id_vet = ".$_SESSION['id_vet']."");
						
			$numrows = mysql_num_rows($rs);
			if($numrows == 0) {
				echo "<h5>No tiene veterinarias registradas.</h5>";
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
					echo "<h5>Q "; 
					for($i = 1; $i <= $promedio; $i++) {
						echo "<span class='icon-star-full'></span>";
					}
					
					echo "</h5>";
					echo "<a href='commets.php?id_pet=".$veterinarys[0]."'>Comentarios</a>";
					echo "<center><img src='$veterinarys[7]'></center>";
					echo "<input name='selected_pet' class='radio' type='radio' value='$veterinarys[0]'>";
				}
			}
		?>
		<input type="submit" name = "my_pets" value="Editar">
	</form>
	
<?php
	include("includes/footer.php");
?>