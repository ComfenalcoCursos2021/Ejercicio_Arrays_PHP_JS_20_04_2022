<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-type:application/json");
    if($_SERVER['REQUEST_METHOD'] == "GET"){
        $plantilla = (object) [
            "select" => (string) null,
            "genero" => (string) null,
            "estadoCivil" => (string) null
        ];
        $obj = (object) [
            "InformacionPersonal" => (string) null,
            "Peticion" => $_SERVER['REQUEST_METHOD']
        ];
        
        require "InformacionPersonal.php";
        echo json_encode($obj, JSON_PRETTY_PRINT);

    }else if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_SERVER['HTTP_FILE'])){
            require "BuscarDatos.php";
        }else{
            require "GuardarDatosInformacionPersonal.php";
        }
    }
   

?>