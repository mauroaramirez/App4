<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);
$user_encriptado = $_GET['tagged'];
$usuario = base64_decode($user_encriptado);

$ok = 0;
$archivo = fopen('Bd/data_user.dat', 'r+') or die("Error de apertura de archivo, consulte con el administrador...");
$archivo_new = fopen('Bd/data_user.tmp', 'a+') or die("Error de apertura de archivo tmp, consulte con el administrador...");
// Capturo la dirección IP del cliente para luego validar al momento de iniciar sesion
$direccion_ip_cliente = $_SERVER['REMOTE_ADDR'];

while (!feof($archivo)) {
    $linea = fgets($archivo);
    if (strlen($linea) > 1) {
        $datos = explode("|", $linea);
        $user = $datos[0];
        $first_name = $datos[1];
        $last_name = $datos[2];
        $code_verif = $datos[3];
        $active = trim($datos[4]);
        $direccion_ip = trim($datos[5]);

        if (strcmp($usuario, $user) == 0) {
            if ($active == '0') {
                $ok = 1;
                $active = 1;
            } else {
                $ok = 2;
            }
        }
        fputs($archivo_new, $user . "|" . $first_name . "|" . $last_name . "|" . $code_verif . "|" . $active . "|" . $direccion_ip . "\n");
    }
}
// si es igual usuario y no esta activo empiezo el proceso de cambiar el valor
fclose($archivo);
fclose($archivo_new);

// Eliminar el archivo data_user para luego dejar activo solamente data_user.tmp
$ubicacion_archivo = "Bd/data_user.dat";

if (file_exists($ubicacion_archivo)) {
    $delete_archivo = unlink($ubicacion_archivo);
    if ($delete_archivo) {
        echo '<script>alert("El archivo fue eliminado correctamente.");</script>';
    } else {
        echo '<script>alert("No se pudo eliminar el archivo");</script>';
    }
} else {
    echo '<script>alert("El archivo no existe");</script>';
}

rename("Bd/data_user.tmp", "Bd/data_user.dat");

//Luego de cambiar el nombre le doy permisos para lectura y escritura
chmod($ubicacion_archivo, 0777);

if ($ok == 1) {
    echo '<script type="text/javascript">
    alert("El usuario se activo satisfactoriamente......");
    window.location.href="index.php";
    </script>';
} elseif ($ok == 2) {
    echo '<script type="text/javascript">
    alert("El usuario se encontraba activo......");
    window.location.href="index.php";
    </script>';
} else {
    echo '<script type="text/javascript">
    alert("No se encontro el usuario requerido......");
    window.location.href="index.php";
    </script>';
}
?>