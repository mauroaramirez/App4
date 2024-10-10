<?php
session_start();
require_once '../../models/Vincular.php';

use Clases\Vincular;

$vinculados = new Vincular;

$dataTable = $vinculados->selectAll();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dispositivos Vinculados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<script>
    $(document).ready(function() {
        $('table').DataTable({
            "pageLength": 5,
            "lengthMenu": [5, 10],
            "autoWidth": true,
            "scrollX": true,
            "fixedHeader": true
        });
    });
</script>

<style>
    table th,
    table td {
        text-align: center;
    }

    table td:last-child {
        white-space: nowrap;
    }
</style>

<body class="form-background">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-9">
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
                                    <td><?php echo $value['created_at'] ?></td>
                                    <td><?php echo $value['marca'] ?></td>
                                    <td><?php echo $value['modelo'] ?></td>
                                    <td><?php echo $value['imei'] ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <?php include_once '../links/linkPantallas.php' ?>
                </div>
            </div>
        </div>
    </div>
    <?php include_once '../../views/footer/footer.php'?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>