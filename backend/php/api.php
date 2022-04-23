<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-type:application/json");
    $plantilla = (object) [
        "select" => (string) null,
        "genero" => (string) null,
        "estadoCivil" => (string) null
    ];
    $obj = (object) [
        "InformacionPersonal" => (string) null
    ];
    require "InformacionPersonal.php";

    echo json_encode($obj, JSON_PRETTY_PRINT);

?>