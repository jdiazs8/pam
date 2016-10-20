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
					<h2 class="titulo">Un gato para toda la vida</h2>
					<h6 class="date">2016-05-11</h6>
					<img src="users/news/images/4.jpeg" />
					<img src="users/news/images/7.jpeg" />
					<p>
						Se sabe que tener una mascota es como tener un hijo. Casi. Implica responsabilidad y dedicación. Esos animalitos que nos alegran la existencia y llenan tantos vacíos se convierten en una compañía imprescindible, por lo que conviene conocer sus ritmos y estar preparados para las necesidades de cada etapa de su crecimiento.
						<br>
						<br>
						Si se trata de un gato, la esperanza de vida es hasta de 25 años. Estos son los aspectos que debe tener en cuenta en cada fase de su desarrollo.
						<br>
						<br>
						Cachorros: hasta los 12 meses
						<br>
						<br>
						En esta etapa, los gatos pequeños requieren mayor atención y cuidado: al estar en pleno proceso de crecimiento, su organismo es más sensible a factores externos e internos. Por eso la alimentación debe ser especial. En el mercado se encuentran alimentos concentrados específicos para las necesidades de estos cachorros. Debido a que los gatos a esa edad tienden a comer unas 20 veces al día en pequeñas raciones, se les debe mantener comida servida. Tenga en cuenta que el animalito debe permanecer al menos dos meses con la madre para evitar complicaciones nutricionales y emocionales.
						<br>
						<br>
						La actividad física también debe ser mayor que en otras etapas. Se puede incentivar por medio de juguetes y rascadores. De igual forma, durante los primeros seis meses debe llevarlo seguido al veterinario para completar su plan vacunal y de desparasitación.
						<br>
						<br>
						El aspecto emocional no es un asunto menor. Castigar físicamente a los gatos los vuelve agresivos. Es mejor reprenderlos con un bufido o soplándoles la cara, pero nunca con golpes. Conserve la arenera en un lugar discreto y tranquilo, ya que los ruidos fuertes pueden estresarlos bastante. En caso de que quiera esterilizarlos, se recomienda consultar previamente a un médico veterinario.
						<br>
						<br>
						Adultos: 1 a 8 años
						<br>
						<br>
						La alimentación cambia después del primer año de vida. Comenzada ya la madurez, se requiere un concentrado de alta calidad que evite complicaciones como los cálculos renales. Igualmente, se recomienda tener cuidado con las dietas caseras. Es mejor consultar antes con el veterinario.
						<br>
						<br>
						Los gatos de esta edad propenden al sobrepeso, por eso es indispensable mantenerles una rutina de actividades físicas para evitarlo. Finalmente, se recomienda llevarlos a chequeo médico y vacunarlos anualmente, y desparasitarlos cada 3 o 4 meses.

						Adultos Mayores: Más de 8 años
						<br>
						<br>
						A los felinos que superan esta edad hay que suministrarles alimentos bajos en grasa, puesto que el sobrepeso continúa siendo un factor de cuidado. Así mismo, las visitas al veterinario deben ser más frecuentes, y se recomienda prestar atención a cambios sutiles de ánimo o de comportamiento, pues pueden significar problemas en el organismo.
						<br>
						<br>
						Estilos de crianza:
						<br>
						<br>
						También es importante ser conscientes de las condiciones y el estilo de vida del gato para asegurar su adecuado desarrollo. Siga estas pautas:
						<br>
						<br>
						Indoor: Este tipo de gatos permanece más tiempo dentro de la casa. Entre las ventajas de esta condición están que viven en un ambiente de virus controlado y el riesgo de pulgas disminuye. Sin embargo, el encierro hace que tiendan a sufrir más estrés, y por la falta de ejercicio pueden sufrir de obesidad, por lo cual se debe cuidar más su alimentación. En casa se pueden suplir sus instintos felinos: una manera es estimularles la actividad de cazar con plumas, palitos o cañas de pescar con ratones de plástico.
						<br>
						<br>
						Outdoor: Pasan más tiempo al aire libre, lo que les evita el estrés y les permite desarrollar sus condiciones innatas. Tenga en cuenta que debido a esto tienden a tener mayor contacto con otros de su especie, por lo que pueden contraer enfermedades virales y pulgas con mayor facilidad.
						<br>
						<br>
						Esterilizados: Cuando los gatos son castrados, debido a la reducción de las hormonas, desarrollan un temperamento más tranquilo. Sin embargo, se debe regular mucho la alimentación, puesto que se engordan fácilmente.
						<br>
						<br>
						No esterilizados: Estos tienen toda su actividad hormonal, por lo que su temperamento es más fuerte, y al querer relacionarse con otros felinos pueden tratar de escapar. Se recomienda mantener un espacio en casa donde puedan ejercitarse.
						<br>
						<br>
						Asesoría: Laura Sierra, médica veterinaria del Centro Dr. Gato.
						<br>
						<br>
						CARRUSEL.
					</p>
				</article>
			</section>	
<?php
	include("includes/footer.php");
?>