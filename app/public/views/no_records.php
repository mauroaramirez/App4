<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sin registros</title>
    <link href="../css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .card-custom {
            max-width: 600px;
            margin: 0 auto;
        }

        .card-body p {
            margin-bottom: 10px;
        }
    </style>
</head>

<body class="form-background">
    <div class="container mt-5">
        <div class="card card-custom">
            <div class="card-body text-center">
                <h3 class="text-center">No se encontraron registros en las fechas ingresadas.</h3>
                <div class="card-body text-center">
                    <button class="btn btn-danger" onclick="goBack()">Ir a Consulta de IMEI</button>
                </div>
            </div>
        </div>
        <script>
            function goBack() {
                window.history.back(); // Vuelve a la página anterior
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>