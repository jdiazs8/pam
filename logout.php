<?php 
	session_start();
	unset($_SESSION['dni_vet']);
	unset($_SESSION['dni_client']);
	session_destroy();
	header("location:index.php");
?>
