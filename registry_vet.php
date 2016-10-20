<?php
	require_once("includes/connection.php");
	include("includes/header_logout.php");
	
	if(isset($_POST["registry_vet"])) {
		if(!empty($_POST['name_vet']) && !empty($_POST['dni_vet']) && !empty($_POST['email_vet']) && !empty($_POST['pass_vet'])) {
			$name_vet = $_POST['name_vet'];
			$dni_vet = $_POST['dni_vet'];
			$email_vet = $_POST['email_vet'];
			$phone_vet = $_POST['phone_vet'];
			$pass_vet = $_POST['pass_vet'];
			$pro_pass_vet = $_POST['pro_pass_vet'];
			$status_vet = true;
			$date_up_vet = date("Y-m-d");
			$date_last_ud_vet = date("Y-m-d");
			$query = mysql_query("SELECT * FROM tb_vets WHERE dni_vet=".$dni_vet." OR email_vet = '".$email_vet."' OR pro_pass_vet = '".$pro_pass_vet."'");
			$numrows = mysql_num_rows($query);
			if($numrows == 0) {
				$sql = "INSERT INTO tb_vets(id_vet, name_vet, dni_vet, email_vet, phone_vet, pass_vet, pro_pass_vet, status_vet, date_up_vet, date_last_ud_vet, id_kind_user) VALUES(NULL, '$name_vet', $dni_vet, '$email_vet', $phone_vet, MD5('$pass_vet'), '$pro_pass_vet', $status_vet, '$date_up_vet', '$date_last_ud_vet', 2)";
				$result = mysql_query($sql);
				if($result) {
					$rs = mysql_query("SELECT id_vet FROM tb_vets WHERE dni_vet = ".$dni_vet.""); 
						while($vets = mysql_fetch_row($rs)){
							$id_vet = $vets[0];
						}
					$carpeta = "users/vets/".$id_vet."/images/veterinarys";
					if (!file_exists($carpeta)) {
						mkdir($carpeta, 0777, true);
					}
					$message = "Cuenta Correctamente Creada";
				}else {
					$message = "Error al ingresar datos de la informacion!";
				}
			}else {
				$message = "El ID, tarjeta profesional o correo de usuario ya existe! Por favor, intenta con otro!";
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
	<form action="registry_vet.php" method="post">
		<h2>Registro Veterinario</h2>
		<label>Nombre</label>
		<input type="text" name="name_vet" required>
		<label>No. Identificación</label>
		<input type="text" name="dni_vet" required>
		<label>Email</label>
		<input type="email" name="email_vet" required>
		<label>Teléfono</label>
		<input type="text" name="phone_vet" required>
		<label>Clave</label>
		<input type="password" name="pass_vet" minlength=8 maxlength=20 required>
		<label>Tarjeta Profesional</label>
		<input type="text" name="pro_pass_vet" required>
		<input type="submit" name = "registry_vet" value="Registrar">
	</form>
<?php
	include("includes/footer.php");
?>