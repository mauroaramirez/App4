<?php
session_start();
require_once '../../models/Dispositivos.php';

use Clases\Dispositivos;

$dispositivos = new Dispositivos;

$dataTable = $dispositivos->selectDispositivos();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Dispositivos</title>
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
            "autoWidth": false, 
            "scrollX": true,     
            "fixedHeader": true,
            "language": {
                "search": "Buscar:", // Personaliza el texto del campo de búsqueda
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "paginate": {
                    "previous": "Anterior",
                    "next": "Siguiente"
                }
            }
        });
    });
</script>

<style>

    .table th, 
    .table td {
        text-align: center;
        vertical-align: middle;
    }

    .table th {
        text-align: center !important; /* !important para forzar el centrado */
    }

    table td:last-child {
        white-space: nowrap;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.8rem;
    }

    table.dataTable {
		border-top: 1px solid #dee2e6;
		margin-top: 10px;
	}
    

    @media (max-width: 768px) {
        .btn-sm {
            padding: 0.2rem 0.4rem;
            font-size: 0.7rem;
        }
    }
</style>

<body class="form-background">
    <div class="container-fluid mt-5">
        <div class="row mb-4 justify-content-center">
            <div class="col-12 col-md-8 col-lg-5">
                <div class="card p-4 text-left">
                    <h3 class="text-center">Listado de Dispositivos</h3>
                    <div class="table-responsive"> 
                        <table class="table table-bordered mt-2">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>IMEI</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataTable[2] as $key => $value) : ?>
                                    <tr>
                                        <td><?php echo $value['id'] ?></td>
                                        <td><?php echo $value['marca'] ?></td>
                                        <td><?php echo $value['modelo'] ?></td>
                                        <td><?php echo $value['imei'] ?></td>
                                        <td>
                                            <a href="../get/verDispositivos.php?id=<?php echo $value['id'] ?>" class="btn btn-info btn-sm">Ver</a>
                                            <a href="../edit/editarDispositivos.php?id=<?php echo $value['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                            <a href="../delete/deleteDispositivos.php?id=<?php echo $value['id'] ?>" class="btn btn-danger btn-sm">Borrar</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <?php include_once '../links/linkPantallas.php' ?>
                </div>
            </div>
        </div>
    </div>
    <?php include_once '../../views/footer/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
