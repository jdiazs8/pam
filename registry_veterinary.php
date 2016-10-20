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
	
	if(isset($_POST["registry_veterinary"])) {
		if(!empty($_POST['name_veterinary']) && !empty($_POST['nit_veterinary']) && !empty($_FILES['archivo'])) {
			$name_veterinary = $_POST['name_veterinary'];
			$nit_veterinary = $_POST['nit_veterinary'];
			$phone_veterinary = $_POST['phone_veterinary'];
			$address_veterinary = $_POST['address_veterinary'];
			$date_up_veterinary = date("Y-m-d");
			$date_last_ud_veterinary = date("Y-m-d");
			$id_vet = $_SESSION['id_vet'];
			$id_zone = $_POST['id_zone'];
			
			if ($_POST["action"] == "upload") {
				$tamano = $_FILES["archivo"]['size'];
				$tipo = $_FILES["archivo"]['type'];
				$archivo = $_FILES["archivo"]['name'];
					
				if ($archivo != "") {
					$destino = "users/vets/".$_SESSION['id_vet']."/images/veterinarys/".$name_veterinary.".jpg";
					if (copy($_FILES['archivo']['tmp_name'],$destino)) {
						$status = "Archivo subido: ".$archivo."";
					}else {
						$status = "Error al subir el archivo";
					}
				}else {
					$status = "Error al subir archivo";
				}
			}
			
			$query = mysql_query("SELECT * FROM tb_veterinarys WHERE id_vet='".$_SESSION['id_vet']."' AND name_veterinary='".$name_veterinary."' AND nit_veterinary='".$nit_veterinary."'");
			$numrows = mysql_num_rows($query);
			if($numrows == 0) {
				$sql = "INSERT INTO tb_veterinarys(id_veterinary, name_veterinary, nit_veterinary, score_veterinary, votes_veterinary, phone_veterinary, address_veterinary, path_pic_veterinary, date_up_veterinary, date_last_ud_veterinary, id_vet, id_zone) VALUES(NULL, '$name_veterinary', $nit_veterinary, 0, 0, $phone_veterinary, '$address_veterinary', '$destino', '$date_up_veterinary', '$date_last_ud_veterinary', ".$_SESSION['id_vet'].", $id_zone)";
				$result = mysql_query($sql);
				if($result) {
					$message = "Tu veterinaria ha sido registrada.";
				}else {
					$message = "Error al ingresar datos de la informacion!";
				}
			}else {
				$message = "El nombre y/o NIT ya está registrado! Por favor, intenta con otro!";
			}
		}else {
			$message = "Todos los campos no deben de estar vacios!";
		}
	}
?>

<div class="contenedor">
	<?php
		if (!empty($message)) {
			echo "<p class=\"error\">" . "Mensaje: ". $message . "</p>";
		}
		
	?>
	<form action="registry_veterinary.php" method="post" enctype="multipart/form-data">
		<h2>Registro Veterinaria</h2>
		<label>Nombre Veterinaria</label>
		<input type="text" name="name_veterinary" required>
		<label>NIT</label>
		<input type="text" name="nit_veterinary" required>
		<label>Teléfono</label>
		<input type="text" name="phone_veterinary" required>
		<label>Dirección</label>
		<input type="text" name="address_veterinary" required>
		<label>Foto</label>
		<input name="archivo" type="file" size="35" />
		<input name="action" type="hidden" value="upload" />
		<label>Localidad</label>
		<select name="id_zone" required>
			<?php
				$rs = mysql_query("SELECT id_zone, name_zone FROM tb_zones"); 
				while($zones = mysql_fetch_row($rs)){
					echo "<option value='$zones[0]'>$zones[1]</option>";
				}
			?>
		</select>
		<input type="submit" name = "registry_veterinary" value="Registrar">
		<a href="my_veterinarys.php">Volver</a>
	</form>
<?php
	include("includes/footer.php");
?>