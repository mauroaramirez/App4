<?php
require_once './phpMail/enviarMail.php';
$configuracion = 'config.dat';
$data_user = 'Bd/data_user.dat';
$user = $_POST["visitor_email"];
$first_name = $_POST["visitor_first_name"];
$last_name = $_POST["visitor_last_name"];
$code_verif = cripto_6(8);
$flag_user = 0;
$ruta = "http://localhost:8060/activate.php?tagged=" . base64_encode($user);
//chmod($data_user, 0777);
$contenido = '
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 14px;">
            <h1>Hemos Recibido una solicitud para registrarse.</h1>
            <div align="left" >
                <p>Le damos la biendivenida : <strong>' . $user . '</strong>.</p>
                <p><strong>El siguiente codigo le sera requerido para acceder a la plataforma: </strong></p>
                <br>
                <p><strong>' . $code_verif . '</strong>.</p>
                <br>
                <p><a href=' . $ruta . '>Activar cuenta</a></p>
                <br>
                <p><strong>Muchas Gracias por su asistencia ..</strong>.</p>
            </div>
          </div>
    </body>
</html>
';
// Capturo la dirección IP del cliente para luego validar al momento de iniciar sesion
$direccion_ip = $_SERVER['REMOTE_ADDR'];

//
if (!file_exists($data_user)) {
  echo '<script>alert("archivo de configuracion no existe");</script>';
} else {
  $archivo = fopen($data_user, 'r') or die("no puedo abrir archivo de datos para lectura");
  while (!feof($archivo) && $flag_user == 0) {
    $linea = fgets($archivo);
    $datos = explode("|", $linea);
    $users = $datos[0];
    $active = $datos[4];
    if (strcmp($users, $user) == 0) {
      $flag_user = 1;
      break;
    }
  }
  fclose($archivo);
  if ($flag_user != 0) {
    echo '<script>alert("El usuario ya existe");</script>';
    echo '<script>      
              window.location="index.php";
            </script>';
  } else {
    $archivo = fopen($data_user, 'a+') or die("no puedo abrir archivo de usuarios para escritura");
    fputs($archivo, $user . "|" . $first_name . "|" . $last_name . "|" . $code_verif . "|" . $flag_user . "|" . $direccion_ip . "\n");
    fclose($archivo);

    $archivo = fopen($configuracion, 'r') or die("no puedo abrir archivo de datos");
    while (!feof($archivo)) {
      $linea = fgets($archivo);
      $datos = explode("|", $linea);
      $desde = $datos[0];
      $credencial = $datos[1];
    }
    $envio = enviarMail($user, $contenido, $asuntoMail, $adjunto = '', $desde, $credencial);
    if ($envio) {
      echo '<script>
                alert("Se ha enviado satisfactoriamente el mail");
              </script>';
      echo '<script>      
                window.location="index.php";
              </script>';
    }
  }
}

///

function cripto_1($len)
{
  $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
  if ($len > 0 && $len <= 36) {
    return substr(str_shuffle($permitted_chars), 0, $len);
  } else {
    return substr(str_shuffle($permitted_chars), 0, 8);
  }
}

function cripto_2($len)
{
  $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  if ($len > 0 && $len <= 62) {
    return substr(str_shuffle($permitted_chars), 0, $len);
  } else {
    return substr(str_shuffle($permitted_chars), 0, 8);
  }
}

function cripto_6($len)
{
  return substr(sha1(time()), 0, $len);
}
?>