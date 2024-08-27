<?php 

require_once '../config/config.php';
require_once '../config/Router.php';

use App\config\Router;

# Se cargan todas las clases utilizando los namespace
spl_autoload_register(function ($namespace) {
    $prefix = 'App\\'; // prefijo del namespace
    $base_dir = '../'; // para salir de public, que es donde esta index

    # Si la clase no usa "App" en el namespace, no la toma como valida
    $len = strlen($prefix);
    if (strncmp($prefix, $namespace, $len) !== 0) {
        return;
    }

    # Obtener el nombre de la clase quitando el prefijo App
    $relative_class = substr($namespace, $len);

    # Reemplazar los separadores de namespace por los de la estructura de directorios
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    # Si el archivo existe lo carga
    if (file_exists($file)) {
        require_once $file;
    }
});

$router = new Router;
$router->run();
