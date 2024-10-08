<?php
//session_start();
require_once '../../models/Personas.php';

use Clases\Personas;

$personas = new Personas;

$personas = $personas->selectOne($_GET['id']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Persona</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../css/style.css">
    <style>
        /* Ajustar el ancho de la tarjeta */
        .card-custom {
            max-width: 600px; /* Ajusta este valor según tus necesidades */
            margin: 0 auto; /* Centra la tarjeta */
        }

        /* Reducir el espaciado entre párrafos */
        .card-body p {
            margin-bottom: 10px; /* Espaciado más pequeño */
        }
    </style>
</head>

<body class="form-background">
    <div class="container mt-5">
        <div class="card card-custom">
            <h3 class="text-center">Datos del Titular</h3>
            <div class="card-body text-center">
                <p><strong>Titular: </strong><?php echo $personas[2]['titular'] ?></p>
                <p><strong>DNI: </strong><?php echo $personas[2]['dni'] ?></p>
                <p><strong>Sexo: </strong><?php echo $personas[2]['gender'] ?></p>
                <p><strong>Email: </strong><?php echo $personas[2]['email'] ?></p>
                <p><strong>Dirección: </strong><?php echo $personas[2]['addresses'] ?></p>
                <p><strong>País: </strong><?php echo $personas[2]['country'] ?></p>
				<a href="../../views/dataTables/dataTablePersonas.php" class="btn btn-info">Ir a Consulta de Personas</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
