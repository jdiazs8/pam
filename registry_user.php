<?php
	session_start();
	require_once("includes/connection.php");
	include("includes/header_logout.php");
	
	if(isset($_POST["registry_user"])) {
		if(!empty($_POST['name_client']) && !empty($_POST['dni_client']) && !empty($_POST['email_client']) && !empty($_POST['pass_client']) && !empty($_POST['address_client'])) {
			$name_client = $_POST['name_client'];
			$dni_client = $_POST['dni_client'];
			$email_client = $_POST['email_client'];
			$phone_client = $_POST['phone_client'];
			$pass_client = $_POST['pass_client'];
			$status_client = true;
			$date_up_client = date("Y-m-d");
			$date_last_ud_client = date("Y-m-d");
			$address_client = $_POST['address_client'];
			$id_zone = $_POST['id_zone'];
			$query = mysql_query("SELECT * FROM tb_clients WHERE dni_client=".$dni_client." OR email_client = '".$email_client."'");
			$numrows = mysql_num_rows($query);
			if($numrows == 0) {
				$sql = "INSERT INTO tb_clients(id_client, name_client, dni_client, email_client, phone_client, pass_client, status_client, date_up_client, date_last_ud_client, address_client, id_zone, id_kind_user) VALUES(NULL, '$name_client', $dni_client, '$email_client', $phone_client, MD5('$pass_client'), $status_client, '$date_up_client', '$date_last_ud_client', '$address_client', $id_zone, 1)";
				$result = mysql_query($sql);
				if($result) {
					$rs = mysql_query("SELECT id_client FROM tb_clients WHERE dni_client = ".$dni_client.""); 
						while($clients = mysql_fetch_row($rs)){
							$id_client = $clients[0];
						}
					$folder = "users/clients/".$id_client."/images/pets";
					if (!file_exists($folder)) {
						mkdir($folder, 0777, true);
					}
					$message = "Cuenta Correctamente Creada";
				}else {
					$message = "Error al ingresar datos de la informacion!";
				}
			}else {
				$message = "El ID de usuario o correo ya existe! Por favor, intenta con otro!";
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
	<form action="registry_user.php" method="post">
		<h2>Registro Cliente</h2>
		<label>Nombre</label>
		<input type="text" name="name_client" required>
		<label>No. Identificación</label>
		<input type="text" name="dni_client" required>
		<label>Email</label>
		<input type="email" name="email_client" required>
		<label>Teléfono</label>
		<input type="text" name="phone_client" required>
		<label>Clave</label>
		<input type="password" name="pass_client" minlength=8 maxlength=20 required>
		<label>Dirección de Residencia</label>
		<input type="text" name="address_client" required>
		<label>Localidad</label>
		<select name="id_zone" required>
			<?php
				$rs = mysql_query("SELECT id_zone, name_zone FROM tb_zones"); 
				while($zones = mysql_fetch_row($rs)){
					echo "<option value='$zones[0]'>$zones[1]</option>";
				}
			?>
		</select>
		<input type="submit" name = "registry_user" value="Registrar">
	</form>
<?php
	include("includes/footer.php");
?>