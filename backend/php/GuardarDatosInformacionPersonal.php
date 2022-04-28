<?php
    $peticion = file_get_contents("php://input");
    $_DATA = json_decode($peticion, true);
    $nombreFile = (string) "../json/informacionPersonal.json";
    if(file_exists($nombreFile)){
        $json = json_decode(file_get_contents($nombreFile), true);
        $key = (array) [
            $_DATA["n-documento"] => $_DATA
        ];
        array_unshift($json, $key);
        $f = fopen($nombreFile, "w+");
        fwrite($f, json_encode($json, JSON_PRETTY_PRINT));
        fclose($f);
        $obj = (object) [
            "Mensaje" => "Datos Guardados"
        ];
        echo json_encode($obj, JSON_PRETTY_PRINT);
    }
?>