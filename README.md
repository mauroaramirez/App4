## Proyecto Geolocalización 2024 - ISFT-177 - Grupo APP4

## Descripción

- Aplicación para consultar la geolocalización de dispositivos de rastreo. Para este proyecto se utilizo el dispositivo TK-STAR ModeloTK-109 IMEI 4109254148
- Se utilizo un chip de la empresa CLARO para la configuración del dispositivo y que el mismo pueda enviar y recibir peticiones.
- En la aplicación se ingresa con usuario (DNI) y contraseña
- Se permite: 
    - Dar de altas personas y dispositivos.
    - Editar las personas y dispositivos.
    - Eliminar las personas y dispositivos.
    - Vincular las personas con los dispositivos.
    - Ver la útima ubicación de un dispositivo en un mapa.
    - Ver un historial de ubicaciones de un dispositivo en un mapa.
    - Permisos limitados por usuarios.

## Estructura de carpetas del proyecto

app
└ public/
| └ controllers/
| |  └ scriptDispositivos.php
| |  └ scriptPeronas.php
| |  └ scriptSession.php
| |  └ scriptVincular.php
| └ css/
| |  └ style.css
| └ files/
| |  └ app4.sql
| └ img/
| | └ logo.png
| | └ mapa-ciudad.jpeg
| | └ mapa.webp
| └ models/
| | └ Database.php
| | └ Dispositivos.php
| | └ Personas.php
| | └ Session.php
| | └ Vincular.php
| └ utils/
| | └ utils.php
| └ video/
| | └ video-1.mp4
| └ views/
| |  └ dataTables/
| |   └ dataTableDispositivos.php
| |   └ dataTablePersonas.php
| |   └ dataTableVinculados.php
| |  └ delete/
| |   └ deleteDispositivos.php
| |   └ deletePersonas.php
| |  └ edit/
| |   └ editarDispositivos.php
| |   └ editarPersonas.php
| |  └ footer/
| |   └ footer.php
| |  └ forms/
| |   └ formDispositivo.php
| |   └ formPersonas.php
| |   └ formVincular.php
| |  └ get/
| |   └ verDispositivos.php
| |   └ verIMEI.php
| |   └ verPersonas.php
| |  └ links/
| |   └ linkPantallas.php
| |   └ linkSinPermisos.php
| |   └ dataTableVinculados.php
| |  └ static/
| |   └ img/
| |     └ mapa-ciudad.jpeg.php
| |  └ templates/
| |   └ error.html
| |   └ mapa_multiple.html
| |   └ map.html
| | └ home.php
| | └ index.php
| | └ login.php
| | └ logout.php
| | └ map.py
└ .env
└ .env.local
└ .gitignore
└ .htaccess
└ 000-default.conf
└ docker-compose-local.yml
└ docker-compose.yml
└ Dockerfile
└ Dockerfile.python
└ mysqld.cnf
└ README.md 

## Red del proyecto

El proyecto en esta configuración cuenta con su propia red, antes de levantar los servicios hay que crearla sudo docker network create mvc-r

## Variables de entorno

PROD: Crear el archivo .env e ingresar las siguientes variables.

TZ=America/Argentina/Buenos_Aires
MYSQL_ROOT_PASSWORD=Q2wevceEEd!
PMA_HOST=localhost
DATABASE="mysql:host=mysql_server;dbname=app4,app4,Q2wevceEEd!"
#PHP_PORT=4060

## Levantar los contenedores

Levantar contenedor local:

sudo docker-compose -f docker-compose-local.yaml up -d

Levantar contenedor prod:

sudo docker-compose up -d

## Accesos Web Local

http://localhost:7071 -> PhpMyAdmin

http://localhost:7070/ -> servidor apache

## Datos de usuario ROOT

- DNI: 00000000
- PASS: 111 

Alumno: Mauro, Adrian Ramirez