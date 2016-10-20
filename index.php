<?php
	session_start();
	if(isset($_SESSION['dni_client'])) {
		include("includes/header_login_client.php");
	}else if(isset($_SESSION["dni_vet"])) {
		include("includes/header_login_vet.php");
	}else {
		include("includes/header_logout.php");
	}
?>
		<div class="contenedor">		
			<section class="main">
				<article>
					<h2 class="titulo">Consideraciones antes de adoptar</h2>
					<h6 class="date">2016-05-12</h6>
					<img src="users/news/images/5.jpeg" />
					<p>
						Adoptar un animal de compañía, es una gran decisión. Los perros y los gatos requieren mucho tiempo y dinero, y una responsabilidad de más de 15 años en muchos casos. El tener una animal puede ser muy recompensan te, pero sólo si realmente has meditado esta decisión antes de adoptar un compañero.
					</p>
				</article>
				
				<article>
					<h2 class="titulo">Un gato para toda la vida</h2>
					<h6 class="date">2016-05-11</h6>
					<img src="users/news/images/1.jpeg" />
					<p>
						Se sabe que tener una mascota es como tener un hijo. Casi. Implica responsabilidad y dedicación. Esos animalitos que nos alegran la existencia y llenan tantos vacíos se convierten en una compañía imprescindible, por lo que conviene conocer sus ritmos y estar preparados para las necesidades de cada etapa de su crecimiento.
						<br>
						<br>
						Si se trata de un gato, la esperanza de vida es hasta de 25 años. Estos son los aspectos que debe tener en cuenta en cada fase de su desarrollo.
					</p>
				</article>
			</section>
		 
			<aside>
				<div class="widget">
					<div class="imagen"><img src="background.jpg"></div>
				</div>
				<div class="widget">
					<div class="imagen"><img src="users/news/images/7.jpeg"></div>
				</div>
				<div class="widget">
					<center><div class="imagen"><img src="users/news/images/3.jpeg"></div></center>
				</div>
				<div class="widget">
					<center><div class="imagen"><img src="users/news/images/2.jpeg"></div></center>
				</div>
			</aside>
<?php
	include("includes/footer.php");
?>