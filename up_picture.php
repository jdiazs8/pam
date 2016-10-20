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
	
	//SELECT * FROM tabla ORDER BY date DESC LIMIT 10
	if(isset($_POST["up_pic"])) {
		$status = "";
		
		if ($_POST["action"] == "upload" && !empty($_FILES['archivo'])) {
			$name_pic = $_POST['name_pic'];
			$date_pic = date("Y-m-d");
			$public_pic = $_POST['public_pic'];
			$tamano = $_FILES["archivo"]['size'];
			$tipo = $_FILES["archivo"]['type'];
			$archivo = $_FILES["archivo"]['name'];
			
			if(isset($_SESSION['dni_client'])) {
				$query = mysql_query("SELECT name_picture_client FROM tb_pictures_clients WHERE name_picture_client='".$name_pic."' AND id_client = ".$_SESSION['id_client']."");
			}else if(isset($_SESSION['dni_vet'])) {
				$query = mysql_query("SELECT name_picture_vet FROM tb_pictures_vets WHERE name_picture_vet='".$name_pic."' AND id_vet= ".$_SESSION['id_vet']."");
			}
			
			$numrows = mysql_num_rows($query);
			
			if($numrows == 0) {
				if ($archivo != "") {
					if(isset($_SESSION['dni_client'])) {
						$destino = "users/clients/".$_SESSION['id_client']."/images/".$name_pic.".jpg";
					}else if(isset($_SESSION['dni_vet'])) {
						$destino = "users/vets/".$_SESSION['id_vet']."/images/".$name_pic.".jpg";
					}
					if (copy($_FILES['archivo']['tmp_name'],$destino)) {
						$status = "Archivo subido: ".$archivo.".";
					} else {
						$status = "Error al subir el archivo.";
					}
				} else {
					$status = "Error al subir archivo.";
				}
				if(isset($_SESSION['dni_client'])) {
					$sql = "INSERT INTO tb_pictures_clients(id_picture_client, name_picture_client, date_picture_client, path_picture_client, public_picture_client, id_client) VALUES(NULL, '$name_pic', '$date_pic', '$destino', $public_pic, ".$_SESSION['id_client'].")";
				}else if(isset($_SESSION['dni_vet'])) {
					$sql = "INSERT INTO tb_pictures_vets(id_picture_vet, name_picture_vet, date_picture_vet, path_picture_vet, public_picture_vet, id_vet) VALUES(NULL, '$name_pic', '$date_pic', '$destino', $public_pic, ".$_SESSION['id_vet'].")";
				}
				
				$result = mysql_query($sql);
				
				if($result) {
					$message = "La foto fue guardada.";
				}else {
					$message = "Error al subir la foto.";
				}
			}else {
				$message = "El nombre de la foto ya existe.";
			}
		}else {
			$message = "Debe adjuntar un archivo.";
		}
	}
?>
		<div class="contenedor">
			<?php
				if (!empty($message)) {
					echo "<p class=\"error\">" . "Mensaje: ".$message." ". $status . "</p>";
				}
			?>
			<form action="up_picture.php" method="post" enctype="multipart/form-data">
				<label>Nombre</label>
				<input type="text" name="name_pic" required>
				<input name="archivo" type="file" size="35" />
				<label>¿Desea hacer pública la imagen?</label><br><br>
				<center><label>Si</label></center>
				<input name="public_pic" type="radio" class="radio" value="1" >
				<center><label>No</label></center>
				<input name="public_pic" type="radio" class="radio" value="0" >
				<input name="up_pic" type="submit" value="Subir Archivo" />
				<input name="action" type="hidden" value="upload" />    
			</form>	
<?php
	if(isset($_SESSION['dni_client'])) {
		$rs = mysql_query("SELECT name_picture_client, path_picture_client, date_picture_client FROM tb_pictures_clients WHERE id_client = ".$_SESSION['id_client']."");
	}else if(isset($_SESSION['dni_vet'])) {
		$rs = mysql_query("SELECT name_picture_vet, path_picture_vet, date_picture_vet FROM tb_pictures_vets WHERE id_vet = ".$_SESSION['id_vet']."");
	}
	if($rs) {
		while($pictures = mysql_fetch_row($rs)){
			echo "<section class='picture_album'>";
				echo "<article>";
					echo "<h2 class='titulo'>$pictures[0]</h2>";
					echo "<h6 class='date'>$pictures[2]</h6>";
					echo "<img src='$pictures[1]' />";
				echo "</article>";
			echo "</section>";
		}
	}else {
		echo "<h2 class='titulo'>No tienes fotos en tu album.</h2>";
	}
	
	include("includes/footer.php");
?>