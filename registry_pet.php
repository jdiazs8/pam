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
	
	if(isset($_POST["registry_pet"])) {
		if(!empty($_POST['name_pet']) && !empty($_POST['id_kind_pet'])) {
			$name_pet = $_POST['name_pet'];
			$breed_pet = $_POST['breed_pet'];
			$gender_pet = $_POST['gender_pet'];
			$birthdate_pet = $_POST['birthdate_pet'];
			$id_client = $_SESSION['id_client'];
			$date_up_pet = date("Y-m-d");
			$date_last_ud_pet = date("Y-m-d");
			$id_kind_pet = $_POST['id_kind_pet'];
			
			if ($_POST["action"] == "upload") {
				$tamano = $_FILES["archivo"]['size'];
				$tipo = $_FILES["archivo"]['type'];
				$archivo = $_FILES["archivo"]['name'];
						
				if ($archivo != "") {
					$destino = "users/clients/".$_SESSION['id_client']."/images/pets/".$name_pet.".jpg";
					if (copy($_FILES['archivo']['tmp_name'],$destino)) {
						$status = "Archivo subido: ".$archivo."";
					}else {
						$status = "Error al subir el archivo";
					}
				}else {
					$status = "Error al subir archivo";
				}
			}
			
			$query = mysql_query("SELECT * FROM tb_pets WHERE id_client='".$id_client."' AND name_pet='".$name_pet."' AND id_kind_pet='".$id_kind_pet."'");
			$numrows = mysql_num_rows($query);
			if($numrows == 0) {
				$sql = "INSERT INTO tb_pets(id_pet, name_pet, breed_pet, gender_pet, birthdate_pet, path_pic_pet, date_up_pet, date_last_ud_pet, id_client, id_kind_pet) VALUES(NULL, '$name_pet', '$breed_pet', '$gender_pet', '$birthdate_pet', '$destino', '$date_up_pet', '$date_last_ud_pet', $id_client, $id_kind_pet)";
				$result = mysql_query($sql);
				if($result) {
					$message = "Tu mascota ha sido registrada.";
				}else {
					$message = "Error al ingresar datos de la informacion!";
				}
			}else {
				$message = "El nombre de la mascota ya existe! Por favor, intenta con otro!";
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
	<form action="registry_pet.php" method="post" enctype="multipart/form-data">
		<h2>Registro Mascota</h2>
		<label>Nombre</label>
		<input type="text" name="name_pet" required>
		<label>Tipo de Mascota</label>
		<select name="id_kind_pet" required>
			<?php
				$rs = mysql_query("SELECT id_kind_pet, name_kind_pet FROM tb_kind_pets"); 
				while($kind_pets = mysql_fetch_row($rs)){
					echo "<option value='$kind_pets[0]'>$kind_pets[1]</option>";
				}
			?>
		</select>
		<label>Raza</label>
		<input type="text" name="breed_pet" required>
		<label>Género</label>
		<select name="gender_pet" required>
			<option value='M'>Macho</option>
			<option value='H'>Hembra</option>
		</select>
		<label>Fecha de Nacimiento</label>
		<input type="date" name="birthdate_pet" required>
		<label>Foto</label>
		<input name="archivo" type="file" size="35" />
		<input name="action" type="hidden" value="upload" />    
		<input type="submit" name = "registry_pet" value="Registrar">
		<a href="my_pets.php">Volver</a>
	</form>
<?php
	include("includes/footer.php");
?>