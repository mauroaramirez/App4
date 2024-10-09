<?php

require_once '../models/Database.php';

// Valido la respuesta de un insert.
// Si el codigo de error es 00000 indica que no hubo error. Caso contrario informo el error capturado en un array 
function validarResonseQuery($result)
{
    if ($result == "00000") {
        return "Se dio de alta el nuevo registro correctamente.";
    } else {
        return "Hubo un error al insertar el nuevo registro: <br><br>";
        foreach ($result as $key => $value) {
            if (is_array($value)) {
                echo "<br>";
                foreach ($value as $innerKey => $innerValue) {
                    echo " $innerValue<br>";
                }
            } else {
                echo "$value<br>";
            }
        }
        return "<br>Intente nuevamente.";
    }
}

function validarResonseQueryDelete($result)
{
    if ($result[1] == 1) {
        return "Se elimino el registro correctamente.";
    } else {
        echo "Hubo un error al intentar eliminar el registro:";
        foreach ($result as $key => $value) {
            if (is_array($value)) {
                echo "<br>";
                foreach ($value as $innerKey => $innerValue) {
                    echo " $innerValue<br>";
                }
            } else {
                echo "$value<br>";
            }
        }
        echo "<br>Intente nuevamente.";
    }
}

function validarResonseQueryUpdate($result)
{
    if ($result[1] >= 0) {
        return "Se actualzó el registro correctamente.";
    } else {
        return "Hubo un error al insertar actualizar el registro: <br><br>";
        foreach ($result as $key => $value) {
            if (is_array($value)) {
                echo "<br>";
                foreach ($value as $innerKey => $innerValue) {
                    echo " $innerValue<br>";
                }
            } else {
                echo "$value<br>";
            }
        }
        return "<br>Intente nuevamente.";
    }
}
