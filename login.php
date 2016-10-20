<?php
	session_start();
	require_once("includes/connection.php");
	include("includes/header_logout.php");
	
	if(isset($_SESSION["session_username"])) {
		header("Location: index.php");
	}
	if(isset($_POST["login"])) {
		if($_POST['id_kind_user'] == 1) {
			if(!empty($_POST['dni_login']) && !empty($_POST['pass_login'])) {
				$dni_login=$_POST['dni_login'];
				$pass_login=md5($_POST['pass_login']);
				$query = mysql_query("SELECT * FROM tb_clients WHERE dni_client = '".$dni_login."' AND pass_client = '".$pass_login."'");
				$numrows = mysql_num_rows($query);
				if($numrows != 0) {
					while($row = mysql_fetch_assoc($query)) {
						$db_dni_login = $row['dni_client'];
						$db_pass_login = $row['pass_client'];
						$db_id_client = $row['id_client'];					}
					if($dni_login == $db_dni_login && $pass_login == $db_pass_login) {
						$_SESSION['dni_client'] = $dni_login;
						$_SESSION['id_client'] = $db_id_client;
						header("Location: index.php");
					}
				}else {
					$message = "Nombre de usuario ó contraseña invalida!";
				}
			}else {
				$message = "Todos los campos son requeridos!";
			}
		}else if($_POST['id_kind_user'] == 2) {
			if(!empty($_POST['dni_login']) && !empty($_POST['pass_login'])) {
				$dni_login=$_POST['dni_login'];
				$pass_login=md5($_POST['pass_login']);
				$query = mysql_query("SELECT * FROM tb_vets WHERE dni_vet = '".$dni_login."' AND pass_vet = '".$pass_login."'");
				$numrows = mysql_num_rows($query);
				if($numrows != 0) {
					while($row = mysql_fetch_assoc($query)) {
						$db_dni_login = $row['dni_vet'];
						$db_pass_login = $row['pass_vet'];
						$db_id_vet = $row['id_vet'];
					}
					if($dni_login == $db_dni_login && $pass_login == $db_pass_login) {
						$_SESSION['dni_vet'] = $dni_login;
						$_SESSION['id_vet'] = $db_id_vet;
						header("Location: index.php");
					}
				}else {
					$message = "Nombre de usuario ó contraseña invalida!";
				}
			}else {
				$message = "Todos los campos son requeridos!";
			}
		}
	}
?>

<div class="contenedor">
	<?php
		if (!empty($message)) {
			echo "<p class=\"error\">" . "Mensaje: ". $message . "</p>";
		}
	?>
	<form action="login.php" method="post">
		<h2>Inicio de Sesión</h2>
		<select name="id_kind_user" required>
		<?php
			$rs = mysql_query("SELECT id_kind_user, name_kind_user FROM tb_kind_users"); 
			while($kind_users = mysql_fetch_row($rs)){
				echo "<option value='$kind_users[0]'>$kind_users[1]</option>";
			}
		?>
		</select>
		<label>dni</label>
		<input type="text" name="dni_login" required>
		<label>Clave</label>
		<input type="password" name="pass_login" required>
		<input type = "submit" name = "login" value = "Entrar">
	</form>
<?php
	include("includes/footer.php");
?>