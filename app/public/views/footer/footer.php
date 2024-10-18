<style>
	/* Estilos para el footer */
	footer {
		color: white;
		position: relative;
		margin-bottom: 0;
		width: 100%;
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

	/* Para garantizar que el contenido ocupe toda la pantalla antes del footer */
	html, body {
		height: 100%;
	}

	/* Flexbox layout para mantener el footer al final */
	body {
		display: flex;
		flex-direction: column;
	}

	.container-fluid {
		flex: 1; /* Ocupa el espacio restante antes del footer */
	}
</style>

<footer>
	<h5>&copy; 2024 - Geolocalización - Prácticas Profesionalizantes II</h5>
	<a href="../../views/home.php">
		<img src="../../img/logo.png" alt="Logo de la empresa">
	</a>
</footer>
