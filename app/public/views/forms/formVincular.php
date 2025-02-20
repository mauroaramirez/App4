<?php
session_start();

require_once '../../models/Vincular.php';
require_once '../../models/Personas.php';
require_once '../../models/Dispositivos.php';

use Clases\Personas;
use Clases\Dispositivos;

if ($_SESSION['rol_id'] == 1 || $_SESSION['rol_id'] == 2 || $_SESSION['rol_id'] == null) :

    $dispositivos = new Dispositivos;
    $personas = new Personas;

    $selectPeople = $personas->selectPeople();
    $selectDispositivos = $dispositivos->selectDispositivos();

?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../../css/style.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vincular Dispositivos</title>
    </head>

    <body class="form-background">
        <div class="container-fluid mt-5">
            <div class="row mb-4 justify-content-center">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card p-4 text-left">
                        <h3 class="text-center">Vincular Dispositivo</h3>
                        <form action="../../controllers/scriptVincular.php" method="post">
                            <table class="table">
                                <tr>
                                    <td><label for="people">Persona:</label></td>
                                    <td>
                                        <select name="people" id="people" class="form-select">
                                            <?php foreach ($selectPeople[2] as $key => $value) : ?>
                                                <option value="<?php echo $value['id'] ?>"><?php echo $value['people'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="dispositivo">IMEI - Dispositivo:</label></td>
                                    <td>
                                        <select name="dispositivo" id="dispositivo" class="form-select">
                                            <?php foreach ($selectDispositivos[2] as $key => $value) : ?>
                                                <option value="<?php echo $value['id'] ?>"><?php echo $value['imei'] . " - " . $value['marca'] . "- " . $value['modelo'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center;padding: 5px;">
                                        <input type="submit" name="vincular" class="btn btn-primary" value="Vincular">
                                    </td>
                                </tr>
                            </table>
                            <?php include_once '../links/linkPantallas.php' ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once '../../views/footer/footer.php' ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>

    </html>
<?php else : ?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sin permisos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../style.css">
    </head>

    <body class="form-background">
        <div class="container mt-5 text-center">
            <div class="card p-4">
                <?php include_once '../links/linkSinPermisos.php'; ?>
            </div>
        </div>
    </body>

    </html>
<?php endif ?>