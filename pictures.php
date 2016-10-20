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
	
	$rs = mysql_query("SELECT name_picture_client, path_picture_client, date_picture_client FROM tb_pictures_clients WHERE public_picture_client = 1 LIMIT 30");
			
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
		echo "<h2 class='titulo'>No registra fotos.</h2>";
	}
	
	$rs = mysql_query("SELECT name_picture_vet, path_picture_vet, date_picture_vet FROM tb_pictures_vets WHERE public_picture_vet = 1 LIMIT 30");
			
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
		echo "<h2 class='titulo'>No registra fotos veterinarias.</h2>";
	}
	
	include("includes/footer.php");
?>