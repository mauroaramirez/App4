<?php
session_start();
require_once '../../models/Vincular.php';

use Clases\Vincular;

if ($_SESSION['rol_id'] == 1) :

    $vinculados = new Vincular;

    //$dataTable = $vinculados->selectOne($_GET['id']);
    $dataTable = $vinculados->selectAll();

?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dispositivos Vinculados</title>
        <!-- Vincular Bootstrap y el archivo CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../../css/style.css">
    </head>

    <body class="form-background">
        <div class="container mt-1">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card p-4">
                        <h3 class="text-center">Dispositivos Vinculados</h3>
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>Titular</th>
                                    <th>Email</th>
                                    <th>Fecha Alta</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>IMEI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataTable[2] as $key => $value) : ?>
                                    <tr>
                                        <td><?php echo $value['titular'] ?></td>
                                        <td><?php echo $value['email'] ?></td>
                                        <td><?php echo $value['fecha_alta'] ?></td>
                                        <td><?php echo $value['marca'] ?></td>
                                        <td><?php echo $value['modelo'] ?></td>
                                        <td><?php echo $value['imei'] ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vincular Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
<?php endif ?>
