<?php
	session_start();
	if(isset($_SESSION['dni_client'])) {
		include("includes/header_login_client.php");
	}else if(isset($_SESSION["dni_vet"])) {
		include("includes/header_login_vet.php");
	}else {
		include("includes/header_logout.php");
	}
	
	if(isset($_POST["contact"])) {
		if(!empty($_POST['name_contact']) && !empty($_POST['email_contact']) && !empty($_POST['subject_contact']) && !empty($_POST['message_contact'])) {
			$name_contact = $_POST['name_contact'];
			$date_contact = date("Y-m-d");
			$email_contact = $_POST['email_contact'];
			$subject_contact = $_POST['subject_contact'];
			$message_contact = $_POST['message_contact'];
			$sql = "INSERT INTO tb_contacts(id_contact, name_contact, date_contact, email_contact, subject_contact, message_contact) VALUES(NULL, '$name_contact', '$date_contact','$email_contact', '$subject_contact', '$message_contact')";
			$result = mysql_query($sql);
	
			if($result) {
				$message = "Mensaje enviado.";
			}else {
				$message = "Error al tratar de enviar el mensaje!";
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
		<form action="contact.php" method="post" class="contact">
			<h2>Contacto</h2>
			<label>Nombre</label>
			<input type="text" name="name_contact" required>
			<label>Email</label>
			<input type="email" name="email_contact" required>
			<label>Asunto</label>
			<input type="texto" name="subject_contact" required>
			<label>Mensaje(Max 400 Caracteres)</label>
			<textarea name="message_contact" maxlength="350" required></textarea>
			<input type="submit" name = "contact" value="Enviar">
		</form>
<?php
	include("includes/footer.php");
?>