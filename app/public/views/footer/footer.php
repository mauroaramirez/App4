<style>
	/* Estilos para el footer */
	footer {
		color: white;
		position: absolute;
		bottom: 0;
		margin-bottom: 0;
		width: 100%;
		/*background-image: url('../img/image.png');*/
		background: linear-gradient(270deg, #3B4142, #1C474E, black);
		background-size: 600% 600%;
		animation: gradientAnimation 20s ease infinite;

		background-position: center;
		background-repeat: no-repeat;
		min-height: 15vh;
		text-align: center;
		padding: 10px 0;
	}

	@keyframes gradientAnimation {
		0% {
			background-position: 0% 50%;
		}

		50% {
			background-position: 100% 50%;
		}

		100% {
			background-position: 0% 50%;
		}
	}

	footer img {
		height: 50px;
		/* Ajustar el tamaño del logo */
	}
</style>

<footer>
	<h5>&copy; 2024 - Geolocalización - Practicas Profesionalizantes II</h5>
	<a href="../../views/home.php">
		<img src="../../img/logo.png" alt="Logo de la empresa">
	</a>
</footer>