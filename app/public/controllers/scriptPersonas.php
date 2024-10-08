<?php
session_start();
require_once '../models/Personas.php';
require_once '../utils/utils.php';

use Clases\Personas;

$personas = new Personas();
$message = ""; // Variable para almacenar el mensaje de respuesta

if (isset($_POST['insertPersona'])) {

    $personas->setNombre($_POST['nombre']);
    $personas->setApellido($_POST['apellido']);
    $personas->setDni($_POST['dni']);
    $personas->setSexo($_POST['sex']);
    $personas->setEmail($_POST['email']);
    $personas->setDireccion($_POST['direccion']);
    $personas->setPais($_POST['pais']);
    $personas->setPass($_POST['pass']);

    $result = $personas->insert();

    $message = validarResonseQuery($result); 
}

if (isset($_POST['updatePersonas'])) {

    $personas->setNombre($_POST['nombre']);
    $personas->setApellido($_POST['apellido']);
    $personas->setDni($_POST['dni']);
    $personas->setSexo($_POST['sex']);
    $personas->setEmail($_POST['email']);
    $personas->setDireccion($_POST['direccion']);
    $personas->setPais($_POST['pais']);
    //$personas->setPass($_POST['pass']);

    $result = $personas->update($_POST['id']);

    $message = validarResonseQueryUpdate($result);
}

if (isset($_POST['deletePersonas'])) {

    $result = $personas->delete($_POST['id']);

    $message = validarResonseQueryDelete($result);
    
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Resultado de Operaciones</title>
</head>

<body class="form-background">
    <div class="container mt-1">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <form action="../../controllers/scriptSession.php" method="post">
                        <div class="text-center">
                            <p>
                            <?php if (!empty($message)): ?>
                                <div class="alert alert-info text-center">
                                    <?php echo $message; ?>
                                </div>
                            <?php endif; ?>
                            </p>
                            <br><a href="/views/dataTables/dataTablePersonas.php" class="btn btn-secondary">Ir a Consulta de Personas</a>
                            <br><br><a href="../views/forms/formPersonas.php" class="btn btn-secondary">Ir al Registro de Personas</a>
                            <br><br><a href="/views/index.php" class="btn btn-info">Ir a Menú Principal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

